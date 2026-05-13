<?php

namespace YakNet\Subtext\AI;

use Gemini;
use YakNet\Subtext\Parser\Comment;

class GeminiAnalyzer
{
    private ?\Gemini\Client $client = null;

    public function __construct(private readonly ?string $apiKey)
    {
        if ($this->apiKey) {
            try {
                $this->client = \Gemini::client($this->apiKey);
            } catch (\Throwable) {
                $this->client = null;
            }
        }
    }

    /**
     * @param Comment[] $comments
     */
    public function analyze(array $comments): ?string
    {
        if (!$this->apiKey) {
            return "AI Analysis failed: GEMINI_API_KEY is missing.";
        }

        if (!$this->client) {
            return "AI Analysis failed: Gemini Client could not be initialized.";
        }

        if (empty($comments)) {
            return "No comments found to analyze.";
        }

        $commentTexts = array_map(fn($c) => "[Line {$c->line}] {$c->text}", $comments);
        $allComments = implode("\n", $commentTexts);

        $prompt = <<<PROMPT
You are a 'Developer Psychologist' and Technical Architect.
I will provide you with a list of internal comments from a PHP source file.
Your task is to analyze these comments and provide:
1. **The Developer's Story**: What was the developer thinking? Are they stressed, happy, or rushed?
2. **Technical Debt**: Are there any dangerous TODOs or hacks mentioned?
3. **Security Risks**: Do you see any passwords, keys, or internal info?
4. **Summary**: A brief overview of the "Subtext" of this file.

Comments:
{$allComments}

Please provide the report in a professional but insightful tone. Use Markdown.
PROMPT;

        try {
            // Stable model: gemini-1.5-flash
            $result = $this->client->generativeModel('gemini-1.5-flash')->generateContent($prompt);
            return $result->text();
        } catch (\Throwable $e) {
            return "AI Analysis failed: " . $e->getMessage();
        }
    }
}
