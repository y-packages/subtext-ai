<?php

namespace YakNet\Subtext\Parser;

class CommentParser
{
    /**
     * @return Comment[]
     */
    public function parse(string $filePath): array
    {
        if (!file_exists($filePath)) {
            return [];
        }

        $content = file_get_contents($filePath);
        $tokens = token_get_all($content);
        $comments = [];

        foreach ($tokens as $index => $token) {
            if (is_array($token) && ($token[0] === T_COMMENT || $token[0] === T_DOC_COMMENT)) {
                $text = $token[1];
                $line = $token[2];
                $type = $this->determineType($text);
                
                // Get context (next non-whitespace token)
                $context = $this->getNextCodeLine($tokens, $index);

                $comments[] = new Comment(
                    text: $this->cleanText($text),
                    line: $line,
                    type: $type,
                    context: $context
                );
            }
        }

        return $comments;
    }

    private function determineType(string $text): string
    {
        if (str_starts_with($text, '/**')) return 'docblock';
        if (str_starts_with($text, '/*')) return 'multi';
        return 'single';
    }

    private function cleanText(string $text): string
    {
        $text = preg_replace('/^\/\*\*?|\*\/|\/\/|#/', '', $text);
        return trim(preg_replace('/^\s*\* ?/m', '', $text));
    }

    private function getNextCodeLine(array $tokens, int $currentIndex): ?string
    {
        for ($i = $currentIndex + 1; $i < count($tokens); $i++) {
            $token = $tokens[$i];
            if (is_array($token)) {
                if ($token[0] === T_WHITESPACE) continue;
                if ($token[0] === T_COMMENT || $token[0] === T_DOC_COMMENT) continue;
                return trim($token[1]);
            }
            // If it's a string (like ';', '{', etc.)
            return trim($token);
        }
        return null;
    }
}
