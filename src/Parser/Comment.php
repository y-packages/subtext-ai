<?php

namespace YakNet\Subtext\Parser;

readonly class Comment
{
    public function __construct(
        public string $text,
        public int $line,
        public string $type, // 'single', 'multi', 'docblock'
        public ?string $context = null // The line of code following the comment
    ) {}

    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'line' => $this->line,
            'type' => $this->type,
            'context' => $this->context,
        ];
    }
}
