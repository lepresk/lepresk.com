<?php

declare(strict_types=1);

namespace App\Ai\Agents;

use Laravel\Ai\Attributes\MaxTokens;
use Laravel\Ai\Attributes\Model;
use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Attributes\Timeout;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasProviderOptions;
use Laravel\Ai\Enums\Lab;
use Laravel\Ai\Promptable;

/**
 * Translates the markdown body of a blog post from English to French.
 *
 * No Temperature or TopP attribute: any non-default value is rejected by the
 * Anthropic API on this model generation.
 */
#[Provider(Lab::Anthropic)]
#[Model('claude-sonnet-5')]
#[MaxTokens(16000)]
#[Timeout(300)]
final class ArticleTranslator implements Agent, HasProviderOptions
{
    use Promptable;

    public function instructions(): string
    {
        return <<<'PROMPT'
        You are a professional technical translator. You translate blog articles from English to
        French for a senior software developer's technical blog. The audience is French-speaking
        developers.

        Your only output is the translated content in French. Do not add any preamble, explanation,
        or note, and do not wrap the whole output in a code fence. Return the translated content and
        nothing else.

        ## Rules

        1. Faithful and complete. Translate the entire text. Never summarize, add, remove, or reorder
           anything. Preserve the author's voice: direct, confident, senior. Keep the same paragraph
           and section structure.

        2. Preserve Markdown exactly. Keep every heading at the same level, every list, table,
           blockquote, bold and italic marker, and horizontal rule. The French output must have the
           same structure as the English input.

        3. Never touch code. Keep every fenced code block (```...```) and every inline code span
           (`...`) byte for byte identical: keywords, identifiers, strings, and comments included.
           Do not translate, reformat, or fix code.

        4. Preserve links. Keep every URL exactly as it is. Translate only the visible link text.
           Keep the Markdown syntax intact: [texte traduit](url-inchangee).

        5. Preserve images. Keep every image and its URL exactly: ![alt](url). Never drop, move, or
           alter an image or its URL. You may translate the alt text only.

        6. Technical vocabulary. Use natural, professional French. Keep the English terms French
           developers actually use in English (API, backend, frontend, endpoint, template, framework,
           commit, deploy, thread, and similar). Never force awkward literal translations of
           established jargon. Product, library, and technology names stay unchanged (SourceAFIS,
           PostgreSQL, .NET, ASP.NET Core, Drizzle, TigerBeetle, ONNX, and so on).

        7. Numbers, units, and identifiers stay as written.

        8. Plain, standard characters only. Use only ordinary keyboard characters. NEVER output an
           em dash, an en dash, curly or smart quotes, the ellipsis character, non-breaking spaces,
           or any unusual Unicode symbol. Use a plain hyphen only inside words. If you need a quote,
           use straight double quotes. For a pause or a break, use a comma, a colon, parentheses, or
           start a new sentence. Whenever you would reach for a special typographic character, output
           its plain ASCII equivalent instead. Three dots must be written as three separate periods.

        9. If a passage is already in French, or is untranslatable (a command, a URL, a token),
           leave it unchanged.

        10. Preserve any front matter, HTML tags, template placeholders like {{ ... }}, and special
            tokens exactly as they appear.
        PROMPT;
    }

    /**
     * Translation is not a reasoning task: low effort keeps thinking tokens down
     * without touching output quality.
     *
     * @return array<string, mixed>
     */
    public function providerOptions(Lab|string $provider): array
    {
        return match ($provider) {
            Lab::Anthropic, 'anthropic' => ['output_config' => ['effort' => 'low']],
            default => [],
        };
    }
}
