@extends('layouts.app')

@section('title', __('error.404.title'))

@section('description', __('error.404.description'))

@push('head')
    <meta name="robots" content="noindex, nofollow">
@endpush

@section('content')
    <div class="flex min-h-screen items-center justify-center pt-16">
        <div class="mx-auto max-w-2xl px-6 py-24 text-center">

            {{-- SVG Illustration: Abstract "lost in space" --}}
            <div class="animate-fade-in-up mx-auto mb-8 w-64">
                <svg viewBox="0 0 280 220" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                    {{-- Background orbit rings --}}
                    <ellipse cx="140" cy="130" rx="120" ry="40" stroke="currentColor" stroke-width="1" class="text-border" stroke-dasharray="6 4" />
                    <ellipse cx="140" cy="130" rx="80" ry="26" stroke="currentColor" stroke-width="1" class="text-border" stroke-dasharray="4 4" />

                    {{-- Planet --}}
                    <circle cx="140" cy="130" r="45" class="fill-primary/10 stroke-primary" stroke-width="2" />
                    <path d="M115 115 Q140 100 165 115" stroke="currentColor" stroke-width="1.5" class="text-primary/40" fill="none" />
                    <path d="M110 135 Q140 120 170 135" stroke="currentColor" stroke-width="1.5" class="text-primary/40" fill="none" />
                    <path d="M115 150 Q140 140 165 150" stroke="currentColor" stroke-width="1" class="text-primary/30" fill="none" />

                    {{-- Floating astronaut (lost) --}}
                    <g class="text-muted-foreground" transform="translate(200, 60) rotate(15)">
                        {{-- Helmet --}}
                        <circle cx="0" cy="0" r="12" stroke="currentColor" stroke-width="2" fill="none" />
                        <circle cx="0" cy="0" r="8" class="fill-primary/20" />
                        {{-- Body --}}
                        <rect x="-8" y="12" width="16" height="18" rx="4" stroke="currentColor" stroke-width="1.5" fill="none" />
                        {{-- Arms reaching out --}}
                        <line x1="-8" y1="18" x2="-18" y2="12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <line x1="8" y1="18" x2="18" y2="12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        {{-- Legs --}}
                        <line x1="-4" y1="30" x2="-8" y2="42" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <line x1="4" y1="30" x2="8" y2="42" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </g>

                    {{-- Tether (broken) --}}
                    <path d="M188 72 Q170 90 155 95" stroke="currentColor" stroke-width="1" class="text-muted-foreground" stroke-dasharray="3 3" />
                    <circle cx="155" cy="95" r="2" class="fill-destructive" />

                    {{-- Stars --}}
                    <circle cx="30" cy="30" r="2" class="fill-primary" />
                    <circle cx="250" cy="40" r="1.5" class="fill-muted-foreground" />
                    <circle cx="60" cy="80" r="1" class="fill-muted-foreground" />
                    <circle cx="45" cy="180" r="1.5" class="fill-primary/60" />
                    <circle cx="230" cy="170" r="1" class="fill-muted-foreground" />
                    <circle cx="270" cy="100" r="2" class="fill-primary/40" />
                    <circle cx="15" cy="140" r="1" class="fill-muted-foreground" />

                    {{-- Small moon --}}
                    <circle cx="70" cy="50" r="8" class="fill-muted/80 stroke-muted-foreground" stroke-width="1" />
                    <circle cx="67" cy="48" r="2" class="fill-muted-foreground/30" />
                    <circle cx="73" cy="53" r="1.5" class="fill-muted-foreground/20" />
                </svg>
            </div>

            {{-- Error code --}}
            <div class="animate-fade-in-up mb-4" style="animation-delay: 0.1s">
                <span class="text-8xl font-bold text-primary/20 select-none">404</span>
            </div>

            {{-- Heading --}}
            <h1 class="animate-fade-in-up mb-4 text-3xl font-bold tracking-tight md:text-4xl" style="animation-delay: 0.2s">
                {{ __('error.404.heading') }}
            </h1>

            {{-- Description --}}
            <p class="animate-fade-in-up mb-10 text-lg text-muted-foreground" style="animation-delay: 0.3s">
                {{ __('error.404.description') }}
            </p>

            {{-- Action buttons --}}
            <div class="animate-fade-in-up flex flex-col items-center justify-center gap-4 sm:flex-row" style="animation-delay: 0.4s">
                <a href="/" class="inline-flex items-center gap-2 rounded-full bg-primary px-6 py-3 text-sm font-medium text-primary-foreground transition-all hover:scale-105 hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>
                    </svg>
                    {{ __('error.404.go_home') }}
                </a>
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 rounded-full border border-primary px-6 py-3 text-sm font-medium text-primary transition-all hover:bg-primary/10">
                    {{ __('error.404.go_blog') }}
                </a>
                <a href="/#contact" class="inline-flex items-center gap-2 rounded-full px-6 py-3 text-sm font-medium text-muted-foreground transition-colors hover:text-primary">
                    {{ __('error.404.go_contact') }}
                </a>
            </div>
        </div>
    </div>
@endsection
