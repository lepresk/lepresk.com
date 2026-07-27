@extends('layouts.app')

@section('title', 'Blog | Lepres Kikounga')

@section('description', __('blog.subtitle'))

@section('content')
    <div class="min-h-screen pt-24">
        <div class="container mx-auto px-6">
            <div class="mb-16 text-center">
                <h1 class="mb-6 text-balance font-bold leading-tight tracking-tighter text-5xl md:text-6xl">Blog</h1>
                <p class="mx-auto max-w-2xl text-pretty text-lg text-muted-foreground">
                    {{ __('blog.subtitle') }}
                </p>
            </div>

            <div class="grid gap-8 pb-12 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                    <a href="{{ route('blog.show', $post->slug) }}" class="group relative block overflow-hidden rounded-2xl border border-border bg-background transition-all duration-300 hover:shadow-2xl hover:border-primary/20">
                        <div class="relative aspect-16/10 overflow-hidden bg-muted">
                            @if($post->featured_image)
                                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="h-full w-full bg-linear-to-br from-primary/10 to-primary/5"></div>
                            @endif
                            <div class="absolute inset-0 bg-linear-to-t from-background via-transparent to-transparent opacity-60"></div>
                            @if($post->categories->isNotEmpty())
                                <div class="absolute bottom-4 left-4">
                                    <span class="rounded-full bg-primary/90 px-3 py-1 text-xs font-medium text-primary-foreground backdrop-blur-sm">
                                        {{ $post->categories->first()->name }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <div class="mb-3 flex items-center gap-4 text-xs text-muted-foreground">
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/>
                                    </svg>
                                    {{ $post->published_at->isoFormat('D MMMM YYYY') }}
                                </div>
                                @if($post->read_time)
                                    <span>•</span>
                                    <span>{{ $post->read_time }}</span>
                                @endif
                            </div>

                            <h2 class="mb-3 text-xl font-bold leading-snug transition-colors group-hover:text-primary">
                                {{ $post->title }}
                            </h2>

                            @if($post->excerpt)
                                <p class="text-sm text-muted-foreground leading-relaxed line-clamp-3">{{ $post->excerpt }}</p>
                            @endif

                            <div class="mt-4 flex items-center gap-2 text-sm font-medium text-primary">
                                {{ __('blog.read_article') }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:translate-x-1">
                                    <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="pb-24">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
