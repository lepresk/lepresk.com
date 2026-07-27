<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Cache\BlogCache;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

final class BlogController
{
    public function index(): Response
    {
        /** @var int $page */
        $page = request()->input('page', 1);

        /** @var string $html */
        $html = Cache::rememberForever(
            BlogCache::indexKey(App::getLocale(), $page),
            fn (): string => view('blog.index', [
                'posts' => Post::published()
                    ->with(['categories', 'tags'])
                    ->latestPublished()
                    ->paginate(12),
            ])->render(),
        );

        return $this->cachedResponse($html);
    }

    public function show(string $slug): Response
    {
        /** @var string $html */
        $html = Cache::rememberForever(
            BlogCache::postKey(App::getLocale(), $slug),
            fn (): string => view('blog.show', [
                'post' => Post::published()
                    ->with(['categories', 'tags'])
                    ->whereSlug($slug)
                    ->firstOrFail(),
            ])->render(),
        );

        return $this->cachedResponse($html);
    }

    public function preview(Request $request, int $id): View
    {
        abort_unless($request->hasValidSignature(), 403);

        $post = Post::query()
            ->with(['categories', 'tags'])
            ->findOrFail($id);

        return view('blog.show', ['post' => $post, 'preview' => true]);
    }

    /**
     * The html is cached on our side, not in the reader's browser: both
     * languages answer on the same URL and the host strips Vary, so a stored
     * response would outlive a language switch.
     */
    private function cachedResponse(string $html): Response
    {
        return response($html)
            ->header('Cache-Control', 'private, no-cache');
    }
}
