<?php

declare(strict_types=1);

use App\Ai\Agents\ArticleTranslator;
use Laravel\Ai\Enums\Lab;

it('caches the instructions rather than the article', function (): void {
    $options = (new ArticleTranslator)->providerOptions(Lab::Anthropic);

    expect($options['system'][0]['cache_control'])->toBe(['type' => 'ephemeral'])
        ->and($options['system'][0]['text'])->toBe((new ArticleTranslator)->instructions());
});

it('sends no option to another provider', function (): void {
    expect((new ArticleTranslator)->providerOptions(Lab::OpenAI))->toBe([]);
});

it('never mentions a forbidden typographic character in its own instructions', function (): void {
    $instructions = (new ArticleTranslator)->instructions();

    foreach (["\u{2014}", "\u{2013}", "\u{2018}", "\u{2019}", "\u{201C}", "\u{201D}", "\u{2026}", "\u{00A0}"] as $character) {
        expect($instructions)->not->toContain($character);
    }
});
