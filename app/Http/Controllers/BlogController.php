<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

final class BlogController
{
    public function index(): Response
    {
        /** @var int $page */
        $page = request()->input('page', 1);

        $posts = Cache::rememberForever("blog.index.page:{$page}", fn () => Post::published()
            ->with(['categories', 'tags'])
            ->latestPublished()
            ->paginate(12));

        /** @var \Illuminate\View\View $view */
        $view = view('blog.index', ['posts' => $posts]);

        return response($view)
            ->header('Cache-Control', 'private, no-cache');
    }

    public function show(string $slug): Response
    {
        /** @var Post $post */
        $post = Cache::rememberForever("post.slug:{$slug}", fn () => Post::published()
            ->with(['categories', 'tags'])
            ->whereSlug($slug)
            ->firstOrFail());

        /** @var \Illuminate\View\View $view */
        $view = view('blog.show', ['post' => $post]);

        return response($view)
            ->header('Cache-Control', 'private, no-cache');
    }

    public function preview(Request $request, int $id): View
    {
        abort_unless($request->hasValidSignature(), 403);

        $post = Post::query()
            ->with(['categories', 'tags'])
            ->findOrFail($id);

        return view('blog.show', ['post' => $post, 'preview' => true]);
    }
}
