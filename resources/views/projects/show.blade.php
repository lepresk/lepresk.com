@extends('layouts.app')

@section('title', ($work->meta_title ?: $work->title) . ' | Lepres Kikounga')

@section('description', $work->meta_description ?: $work->description)

@push('head')
    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="{{ $work->og_title ?: $work->title }}">
    <meta property="og:description" content="{{ $work->og_description ?: ($work->meta_description ?: $work->description) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('projects.show', $work->slug) }}">

    @if($work->og_image)
        <meta property="og:image" content="{{ url(Storage::url($work->og_image)) }}">
    @elseif($work->featured_image)
        <meta property="og:image" content="{{ url(Storage::url($work->featured_image)) }}">
    @endif

    @if($work->meta_keywords)
        <meta name="keywords" content="{{ $work->meta_keywords }}">
    @endif

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $work->og_title ?: $work->title }}">
    <meta name="twitter:description" content="{{ $work->og_description ?: ($work->meta_description ?: $work->description) }}">

    @if($work->og_image)
        <meta name="twitter:image" content="{{ url(Storage::url($work->og_image)) }}">
    @elseif($work->featured_image)
        <meta name="twitter:image" content="{{ url(Storage::url($work->featured_image)) }}">
    @endif

    {{-- Structured Data (CreativeWork Schema) --}}
    <script type="application/ld+json">
    @php
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'CreativeWork',
            'name' => $work->title,
            'description' => $work->description,
            'datePublished' => $work->published_at->toIso8601String(),
            'dateModified' => $work->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Person',
                'name' => 'Lepres Kikounga',
            ],
            'creator' => [
                '@type' => 'Person',
                'name' => 'Lepres Kikounga',
            ],
        ];

        if ($work->featured_image) {
            $structuredData['image'] = url(Storage::url($work->featured_image));
        }

        if ($work->tags->isNotEmpty()) {
            $structuredData['keywords'] = $work->tags->pluck('name')->join(', ');
        }
    @endphp
    {!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
    <div class="min-h-screen pt-24">
        <article class="container mx-auto px-6 pb-24">
            <div class="mx-auto max-w-6xl">
                <a href="/#projets" class="mb-8 inline-flex items-center gap-2 text-sm font-medium text-muted-foreground transition-colors hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>
                    </svg>
                    Retour aux projets
                </a>

                <div class="mb-8">
                    @if($work->categories->isNotEmpty())
                        <span class="mb-4 inline-block rounded-full bg-primary/10 px-4 py-1 text-sm font-medium text-primary">
                            {{ $work->categories->first()->name }}
                        </span>
                    @endif
                    <h1 class="mb-6 text-balance font-bold leading-tight tracking-tighter text-4xl md:text-5xl lg:text-6xl">
                        {{ $work->title }}
                    </h1>
                    @if($work->description)
                        <p class="mb-6 text-xl text-muted-foreground">{{ $work->description }}</p>
                    @endif
                    @if($work->tags->isNotEmpty())
                        <div class="flex flex-wrap gap-2">
                            @foreach ($work->tags as $tag)
                                <span class="rounded-full bg-primary/10 px-4 py-1.5 text-sm font-medium text-primary">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if($work->featured_image)
                    <div class="relative mb-12 aspect-21/9 overflow-hidden rounded-2xl">
                        <img src="{{ Storage::url($work->featured_image) }}" alt="{{ $work->title }}" class="h-full w-full object-cover">
                    </div>
                @endif

                <div class="prose prose-lg prose-slate dark:prose-invert max-w-none mb-12">
                    {!! Str::markdown($work->content) !!}
                </div>

                @if($work->image_gallery && count($work->image_gallery) > 0)
                    <div class="mt-12 pt-8 border-t border-border">
                        <h3 class="mb-6 text-2xl font-bold">Gallery</h3>
                        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($work->image_gallery as $image)
                                <div class="relative aspect-4/3 overflow-hidden rounded-xl bg-muted">
                                    <img src="{{ Storage::url($image) }}" alt="{{ $work->title }}" class="h-full w-full object-cover transition-transform duration-300 hover:scale-110">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </article>
    </div>
@endsection
