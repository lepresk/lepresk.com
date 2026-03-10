<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

final class PostObserver
{
    public function saved(Post $post): void
    {
        $this->flushCache($post);
    }

    public function deleted(Post $post): void
    {
        $this->flushCache($post);
    }

    private function flushCache(Post $post): void
    {
        Cache::forget("post.slug:{$post->slug}");

        for ($i = 1; $i <= 20; $i++) {
            Cache::forget("blog.index.page:{$i}");
        }
    }
}
