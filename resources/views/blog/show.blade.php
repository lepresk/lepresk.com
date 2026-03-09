@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' | Lepres Kikounga')

@section('description', $post->meta_description ?: $post->excerpt)

@push('head')
    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="{{ $post->og_title ?: $post->title }}">
    <meta property="og:description" content="{{ $post->og_description ?: ($post->meta_description ?: $post->excerpt) }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ route('blog.show', $post->slug) }}">

    @if($post->og_image)
        <meta property="og:image" content="{{ url(Storage::url($post->og_image)) }}">
    @elseif($post->featured_image)
        <meta property="og:image" content="{{ url(Storage::url($post->featured_image)) }}">
    @endif

    <meta property="article:published_time" content="{{ $post->published_at->toIso8601String() }}">
    <meta property="article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">

    @if($post->meta_keywords)
        <meta name="keywords" content="{{ $post->meta_keywords }}">
    @endif

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->og_title ?: $post->title }}">
    <meta name="twitter:description" content="{{ $post->og_description ?: ($post->meta_description ?: $post->excerpt) }}">

    @if($post->og_image)
        <meta name="twitter:image" content="{{ url(Storage::url($post->og_image)) }}">
    @else
        <meta name="twitter:image" content="{{ url(Storage::url($post->featured_image)) }}">
    @endif

    {{-- Structured Data (BlogPosting Schema) --}}
    @php
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => $post->excerpt,
            'datePublished' => $post->published_at->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Person',
                'name' => 'Lepres Kikounga',
            ],
            'publisher' => [
                '@type' => 'Person',
                'name' => 'Lepres Kikounga',
            ],
        ];

        if ($post->featured_image) {
            $structuredData['image'] = url(Storage::url($post->featured_image));
        }

        if ($post->categories->isNotEmpty()) {
            $structuredData['articleSection'] = $post->categories->first()->name;
        }

        if ($post->tags->isNotEmpty()) {
            $structuredData['keywords'] = $post->tags->pluck('name')->join(', ');
        }
    @endphp
    <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
@endpush

@section('content')
    <div class="min-h-screen pt-24">
        <article class="container mx-auto px-6 pb-24">
            <div class="mx-auto max-w-4xl">
                <a href="{{ route('blog.index') }}" class="mb-8 inline-flex items-center gap-2 text-sm font-medium text-muted-foreground transition-colors hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>
                    </svg>
                    Retour aux articles
                </a>

                <div class="mb-8">
                    @if($post->categories->isNotEmpty())
                        <span class="mb-4 inline-block rounded-full bg-primary/10 px-4 py-1 text-sm font-medium text-primary">
                            {{ $post->categories->first()->name }}
                        </span>
                    @endif
                    <h1 class="mb-6 text-balance font-bold leading-tight tracking-tighter text-4xl md:text-5xl lg:text-6xl">
                        {{ $post->title }}
                    </h1>
                    <div class="flex items-center gap-6 text-sm text-muted-foreground">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/>
                            </svg>
                            {{ $post->published_at->isoFormat('D MMMM YYYY') }}
                        </div>
                        @if($post->read_time)
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                </svg>
                                {{ $post->read_time }}
                            </div>
                        @endif
                    </div>
                </div>

                @if($post->featured_image)
                    <div class="relative mb-12 aspect-21/9 overflow-hidden rounded-2xl">
                        <img src="{{ url(Storage::url($post->featured_image)) }}" alt="{{ $post->title }}" class="h-full w-full object-cover">
                    </div>
                @endif

                <div class="prose prose-lg prose-slate dark:prose-invert max-w-none">
                    {!! Str::markdown($post->content) !!}
                </div>

                @if($post->tags->isNotEmpty())
                    <div class="mt-12 pt-8 border-t border-border">
                        <h3 class="mb-4 text-sm font-semibold text-muted-foreground">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                                <span class="rounded-full bg-muted px-3 py-1 text-sm text-muted-foreground">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </article>
    </div>
@endsection
