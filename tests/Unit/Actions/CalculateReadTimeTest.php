<?php

declare(strict_types=1);

use App\Actions\CalculateReadTime;

beforeEach(function (): void {
    $this->calculateReadTime = new CalculateReadTime;
});

it('rounds up to the next minute', function (int $words, string $expected): void {
    $content = implode(' ', array_fill(0, $words, 'mot'));

    expect(($this->calculateReadTime)($content))->toBe($expected);
})->with([
    'one word' => [1, '1 min'],
    'exactly one minute' => [200, '1 min'],
    'just over one minute' => [201, '2 min'],
    'three minutes' => [600, '3 min'],
    'rounded up' => [601, '4 min'],
]);

it('never returns less than one minute', function (): void {
    expect(($this->calculateReadTime)(''))->toBe('1 min')
        ->and(($this->calculateReadTime)('   '))->toBe('1 min');
});

it('ignores markdown syntax and html tags', function (): void {
    $content = <<<'MARKDOWN'
        # Titre

        Un **paragraphe** avec un [lien](https://example.com) et de l'`inline code`.

        <div class="note">Une note</div>
        MARKDOWN;

    expect(($this->calculateReadTime)($content))->toBe('1 min');
});

it('counts accented words', function (): void {
    $content = implode(' ', array_fill(0, 300, 'déployé'));

    expect(($this->calculateReadTime)($content))->toBe('2 min');
});
