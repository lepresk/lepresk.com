<?php

declare(strict_types=1);

namespace App\Cache;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

/**
 * The rendered html of the public blog, cached per locale.
 *
 * Rendering an article means parsing its markdown, which costs tens of
 * milliseconds and never changes between two visits. Keys carry the locale
 * because both languages answer on the same URL.
 *
 * This is the only place that knows how those keys are built, so the
 * controller, the observer and the admin flush button cannot drift apart.
 */
final class BlogCache
{
    /**
     * Beyond that, the index is deep enough that nobody browses it.
     */
    private const int CACHED_INDEX_PAGES = 20;

    public static function indexKey(string $locale, int $page): string
    {
        return "blog.index.{$locale}.page:{$page}";
    }

    public static function postKey(string $locale, string $slug): string
    {
        return "blog.show.{$locale}.{$slug}";
    }

    /**
     * Forget one post in every locale, and the index it appears on.
     *
     * Called whenever a post changes: created, edited, translated, deleted.
     */
    public static function forgetPost(Post $post): void
    {
        foreach (self::locales() as $locale) {
            foreach ($post->slugsInAllLocales() as $slug) {
                Cache::forget(self::postKey($locale, $slug));
            }
        }

        self::forgetIndex();
    }

    public static function forgetIndex(): void
    {
        foreach (self::locales() as $locale) {
            for ($page = 1; $page <= self::CACHED_INDEX_PAGES; $page++) {
                Cache::forget(self::indexKey($locale, $page));
            }
        }
    }

    /**
     * Forget every post, for the admin flush button.
     */
    public static function flush(): void
    {
        Post::query()->withTrashed()->get()->each(fn (Post $post) => self::forgetPost($post));

        self::forgetIndex();
    }

    /**
     * @return array<int, string>
     */
    private static function locales(): array
    {
        /** @var array<int, string> $locales */
        $locales = config('app.available_locales', []);

        return $locales;
    }
}
