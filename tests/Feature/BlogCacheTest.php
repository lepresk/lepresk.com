<?php

declare(strict_types=1);

use App\Cache\BlogCache;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

function publishedPost(string $slug = 'a-post'): Post
{
    $post = Post::factory()->published()->create();

    $post->replaceTranslations('title', ['en' => 'A post']);
    $post->replaceTranslations('slug', ['en' => $slug]);
    $post->replaceTranslations('content', ['en' => '# A post']);
    $post->save();

    return $post;
}

it('serves an article from the cache instead of querying again', function (): void {
    $post = publishedPost('cached-post');

    $this->get(route('blog.show', 'cached-post'))->assertOk();

    expect(Cache::has(BlogCache::postKey('en', 'cached-post')))->toBeTrue();

    DB::enableQueryLog();

    $this->get(route('blog.show', 'cached-post'))->assertOk();

    expect(DB::getQueryLog())->toBeEmpty();
});

it('caches each language separately', function (): void {
    $post = publishedPost('two-locales');
    $post->setTranslation('slug', 'fr', 'deux-locales');
    $post->setTranslation('title', 'fr', 'Un article');
    $post->setTranslation('content', 'fr', '# Un article');
    $post->save();

    $this->get(route('blog.show', 'two-locales'))->assertOk();
    $this->get(route('blog.show', ['slug' => 'deux-locales', 'lang' => 'fr']))->assertOk();

    expect(Cache::has(BlogCache::postKey('en', 'two-locales')))->toBeTrue()
        ->and(Cache::has(BlogCache::postKey('fr', 'deux-locales')))->toBeTrue();
});

it('drops the cached html when the article changes', function (): void {
    $post = publishedPost('edited-post');

    $this->get(route('blog.show', 'edited-post'))->assertOk();
    $this->get(route('blog.index'))->assertOk();

    expect(Cache::has(BlogCache::postKey('en', 'edited-post')))->toBeTrue()
        ->and(Cache::has(BlogCache::indexKey('en', 1)))->toBeTrue();

    $post->setTranslation('content', 'en', '# Edited');
    $post->save();

    expect(Cache::has(BlogCache::postKey('en', 'edited-post')))->toBeFalse()
        ->and(Cache::has(BlogCache::indexKey('en', 1)))->toBeFalse();
});

it('drops the cached html of every locale when a translation lands', function (): void {
    $post = publishedPost('translated-post');

    $this->get(route('blog.show', 'translated-post'))->assertOk();

    expect(Cache::has(BlogCache::postKey('en', 'translated-post')))->toBeTrue();

    $post->setTranslation('slug', 'fr', 'article-traduit');
    $post->setTranslation('content', 'fr', '# Article traduit');
    $post->save();

    expect(Cache::has(BlogCache::postKey('en', 'translated-post')))->toBeFalse()
        ->and(Cache::has(BlogCache::postKey('fr', 'article-traduit')))->toBeFalse();
});

it('drops the cached html when an article leaves the blog', function (string $method): void {
    $post = publishedPost('deleted-post');

    $this->get(route('blog.show', 'deleted-post'))->assertOk();

    expect(Cache::has(BlogCache::postKey('en', 'deleted-post')))->toBeTrue();

    $post->{$method}();

    expect(Cache::has(BlogCache::postKey('en', 'deleted-post')))->toBeFalse();
})->with(['delete', 'forceDelete']);

it('serves a new article as soon as it is published', function (): void {
    publishedPost('first-post');

    $this->get(route('blog.index'))->assertOk()->assertSee('first-post', escape: false);

    $second = publishedPost('second-post');

    $this->get(route('blog.index'))
        ->assertOk()
        ->assertSee('second-post', escape: false);

    expect($second->slug)->toBe('second-post');
});
