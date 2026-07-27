<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Str;

final class CalculateReadTime
{
    private const int WORDS_PER_MINUTE = 200;

    /**
     * Estimate how long the given markdown content takes to read.
     */
    public function __invoke(string $content): string
    {
        $minutes = (int) max(1, ceil($this->countWords($content) / self::WORDS_PER_MINUTE));

        return "{$minutes} min";
    }

    private function countWords(string $content): int
    {
        $text = mb_trim(strip_tags(Str::markdown($content)));

        if ($text === '') {
            return 0;
        }

        return count(preg_split('/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY) ?: []);
    }
}
