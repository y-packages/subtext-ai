<?php

namespace YakNet\Subtext;

use YakNet\Subtext\Parser\CommentParser;
use YakNet\Subtext\AI\GeminiAnalyzer;

class Subtext
{
    /**
     * Run the Subtext scanner on the calling file.
     * 
     * @param bool $enable If true, outputs comments as JSON and exits.
     * @param bool $ai If true, also provides AI analysis (requires GEMINI_API_KEY).
     */
    public static function run(bool $enable = false, bool $ai = false): void
    {
        if (!$enable) return;

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
        $callerFile = $backtrace[0]['file'] ?? null;

        if (!$callerFile || !file_exists($callerFile)) return;

        $parser = new CommentParser();
        $comments = $parser->parse($callerFile);

        $response = [
            'file' => basename($callerFile),
            'count' => count($comments),
            'comments' => array_map(fn($c) => $c->toArray(), $comments),
        ];

        if ($ai) {
            $apiKey = $_ENV['GEMINI_API_KEY'] ?? getenv('GEMINI_API_KEY');
            $analyzer = new GeminiAnalyzer($apiKey);
            $response['ai_analysis'] = $analyzer->analyze($comments);
        }

        header('Content-Type: application/json');
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}
