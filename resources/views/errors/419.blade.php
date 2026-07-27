@extends('layouts.app')

@section('title', __('error.419.title'))

@section('description', __('error.419.description'))

@push('head')
    <meta name="robots" content="noindex, nofollow">
@endpush

@section('content')
    <div class="flex min-h-screen items-center justify-center pt-16">
        <div class="mx-auto max-w-2xl px-6 py-24 text-center">

            {{-- SVG Illustration: an hourglass that ran out --}}
            <div class="animate-fade-in-up mx-auto mb-8 w-64">
                <svg viewBox="0 0 280 220" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                    {{-- Orbit rings, same family as the other error pages --}}
                    <ellipse cx="140" cy="130" rx="120" ry="40" stroke="currentColor" stroke-width="1" class="text-border" stroke-dasharray="6 4" />
                    <ellipse cx="140" cy="130" rx="80" ry="26" stroke="currentColor" stroke-width="1" class="text-border" stroke-dasharray="4 4" />

                    {{-- Hourglass frame --}}
                    <line x1="105" y1="70" x2="175" y2="70" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" class="text-primary" />
                    <line x1="105" y1="190" x2="175" y2="190" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" class="text-primary" />
                    <path d="M112 70 Q112 120 140 130 Q168 120 168 70" stroke="currentColor" stroke-width="2" fill="none" class="text-primary" />
                    <path d="M112 190 Q112 140 140 130 Q168 140 168 190" stroke="currentColor" stroke-width="2" fill="none" class="text-primary" />

                    {{-- Sand: top empty, bottom full --}}
                    <path d="M120 178 Q140 158 160 178 Z" class="fill-primary/40" />
                    <path d="M124 182 L156 182 L156 188 L124 188 Z" class="fill-primary/30" />
                    <circle cx="140" cy="145" r="1.5" class="fill-primary/60" />
                    <circle cx="140" cy="160" r="1.5" class="fill-primary/50" />

                    {{-- Stars --}}
                    <circle cx="30" cy="30" r="2" class="fill-primary" />
                    <circle cx="250" cy="40" r="1.5" class="fill-muted-foreground" />
                    <circle cx="60" cy="80" r="1" class="fill-muted-foreground" />
                    <circle cx="45" cy="180" r="1.5" class="fill-primary/60" />
                    <circle cx="230" cy="170" r="1" class="fill-muted-foreground" />
                    <circle cx="270" cy="100" r="2" class="fill-primary/40" />
                    <circle cx="15" cy="140" r="1" class="fill-muted-foreground" />
                </svg>
            </div>

            {{-- Error code --}}
            <div class="animate-fade-in-up mb-4" style="animation-delay: 0.1s">
                <span class="text-8xl font-bold text-primary/20 select-none">419</span>
            </div>

            {{-- Heading --}}
            <h1 class="animate-fade-in-up mb-4 text-3xl font-bold tracking-tight md:text-4xl" style="animation-delay: 0.2s">
                {{ __('error.419.heading') }}
            </h1>

            {{-- Description --}}
            <p class="animate-fade-in-up mb-10 text-lg text-muted-foreground" style="animation-delay: 0.3s">
                {{ __('error.419.description') }}
            </p>

            {{-- Action buttons --}}
            <div class="animate-fade-in-up flex flex-col items-center justify-center gap-4 sm:flex-row" style="animation-delay: 0.4s">
                <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-6 py-3 text-sm font-medium text-primary-foreground transition-all hover:scale-105 hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/>
                    </svg>
                    {{ __('error.419.reload') }}
                </a>
                <a href="/" class="inline-flex items-center gap-2 rounded-full border border-primary px-6 py-3 text-sm font-medium text-primary transition-all hover:bg-primary/10">
                    {{ __('error.419.go_home') }}
                </a>
            </div>
        </div>
    </div>
@endsection
