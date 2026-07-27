<?php

declare(strict_types=1);

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Attributes\MaxTokens;
use Laravel\Ai\Attributes\Model;
use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Attributes\Timeout;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasProviderOptions;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Enums\Lab;
use Laravel\Ai\Promptable;

/**
 * Translates the short metadata of a blog post in a single structured call.
 */
#[Provider(Lab::Anthropic)]
#[Model('claude-sonnet-5')]
#[MaxTokens(4096)]
#[Timeout(120)]
final class ArticleMetadataTranslator implements Agent, HasProviderOptions, HasStructuredOutput
{
    use Promptable;

    public function instructions(): string
    {
        return <<<'PROMPT'
        You are a professional technical translator. You translate blog article metadata from English
        to French for a senior software developer's technical blog. The audience is French-speaking
        developers.

        Translate every field you are given, faithfully and completely, keeping the author's direct
        and confident voice. Return an empty string for a field that was given to you empty.

        Keep the English terms French developers actually use in English (API, backend, frontend,
        endpoint, template, framework, commit, deploy, thread, and similar). Product, library, and
        technology names stay unchanged. Numbers, units, and identifiers stay as written. Keep any
        inline code, URL, or token exactly as it appears.

        Use only ordinary keyboard characters. NEVER output an em dash, an en dash, curly or smart
        quotes, the ellipsis character, non-breaking spaces, or any unusual Unicode symbol. If you
        need a quote, use straight double quotes. For a pause, use a comma, a colon, parentheses, or
        start a new sentence. Three dots must be written as three separate periods.

        The excerpt is a teaser printed on a card of fixed size, not prose to render at any
        length. French runs longer than English, so tighten it: your excerpt must never exceed the
        length of the English one. Cut the least useful clause rather than let it grow.

        The meta_keywords field is a comma separated list: keep it a comma separated list.

        The slug field is not a translation. Build a short french URL slug for the article:

        - keep only the words that carry the subject, usually three to six of them
        - drop filler words: articles, prepositions, and elided particles such as de, du, des,
          le, la, les, un, une, en, avec, dans, pour, sur, et, au, aux, d, l, qu
        - drop anything parenthetical, numeric qualifiers, and subtitle noise that does not help
          someone recognise the article from the URL alone
        - lowercase, words separated by single hyphens, no accent, no apostrophe, no other
          punctuation, ASCII only
        - aim for under 60 characters

        For "Fingerprint Verification in ASP.NET Core with SourceAFIS (1:1 Matching)" a good slug
        is verification-empreintes-aspnet-core-sourceafis, not
        verification-dempreintes-digitales-en-aspnet-core-avec-sourceafis-correspondance-11.
        PROMPT;
    }

    /**
     * @return array<string, \Illuminate\JsonSchema\Types\Type>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'title' => $schema->string()->required(),
            'slug' => $schema->string()->required(),
            'excerpt' => $schema->string(),
            'meta_title' => $schema->string(),
            'meta_description' => $schema->string(),
            'meta_keywords' => $schema->string(),
            'og_title' => $schema->string(),
            'og_description' => $schema->string(),
        ];
    }

    /**
     * Thinking is turned off for two reasons: these fields are a handful of short
     * strings, and the package only forces the structured output tool when no
     * thinking option is set, which the API rejects while thinking is on.
     *
     * @return array<string, mixed>
     */
    public function providerOptions(Lab|string $provider): array
    {
        return match ($provider) {
            Lab::Anthropic, 'anthropic' => ['thinking' => ['type' => 'disabled']],
            default => [],
        };
    }
}
