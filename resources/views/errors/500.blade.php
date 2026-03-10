@extends('layouts.app')

@section('title', __('error.500.title'))

@section('description', __('error.500.description'))

@push('head')
    <meta name="robots" content="noindex, nofollow">
@endpush

@section('content')
    <div class="flex min-h-screen items-center justify-center pt-16">
        <div class="mx-auto max-w-2xl px-6 py-24 text-center">

            {{-- SVG Illustration: Broken gear / circuit --}}
            <div class="animate-fade-in-up mx-auto mb-8 w-64">
                <svg viewBox="0 0 280 220" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                    {{-- Main gear (broken) --}}
                    <g transform="translate(140, 110)">
                        {{-- Gear teeth --}}
                        <path d="M-8,-50 L8,-50 L10,-40 L-10,-40 Z" class="fill-destructive/20 stroke-destructive" stroke-width="1.5" />
                        <path d="M-8,50 L8,50 L10,40 L-10,40 Z" class="fill-destructive/20 stroke-destructive" stroke-width="1.5" />
                        <path d="M-50,-8 L-50,8 L-40,10 L-40,-10 Z" class="fill-destructive/20 stroke-destructive" stroke-width="1.5" />
                        <path d="M50,-8 L50,8 L40,10 L40,-10 Z" class="fill-destructive/20 stroke-destructive" stroke-width="1.5" />

                        {{-- Diagonal teeth --}}
                        <path d="M-32,-36 L-24,-42 L-18,-34 L-26,-28 Z" class="fill-destructive/20 stroke-destructive" stroke-width="1.5" />
                        <path d="M32,36 L24,42 L18,34 L26,28 Z" class="fill-destructive/20 stroke-destructive" stroke-width="1.5" />
                        <path d="M32,-36 L24,-42 L18,-34 L26,-28 Z" class="fill-destructive/20 stroke-destructive" stroke-width="1.5" />
                        <path d="M-32,36 L-24,42 L-18,34 L-26,28 Z" class="fill-destructive/20 stroke-destructive" stroke-width="1.5" />

                        {{-- Outer circle --}}
                        <circle cx="0" cy="0" r="35" class="stroke-destructive" stroke-width="2" fill="none" />
                        {{-- Inner circle --}}
                        <circle cx="0" cy="0" r="14" class="fill-destructive/10 stroke-destructive" stroke-width="2" />

                        {{-- Crack / break line --}}
                        <path d="M-5,-35 L-2,-20 L4,-12 L-1,-5 L3,8 L-2,18 L5,35" class="stroke-destructive" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                    </g>

                    {{-- Small gear (top-left) --}}
                    <g transform="translate(70, 55)">
                        <circle cx="0" cy="0" r="18" class="stroke-muted-foreground" stroke-width="1.5" fill="none" />
                        <circle cx="0" cy="0" r="6" class="fill-muted/50 stroke-muted-foreground" stroke-width="1" />
                        <path d="M-4,-20 L4,-20 L5,-16 L-5,-16 Z" class="fill-muted-foreground/30 stroke-muted-foreground" stroke-width="1" />
                        <path d="M-4,20 L4,20 L5,16 L-5,16 Z" class="fill-muted-foreground/30 stroke-muted-foreground" stroke-width="1" />
                        <path d="M-20,-4 L-20,4 L-16,5 L-16,-5 Z" class="fill-muted-foreground/30 stroke-muted-foreground" stroke-width="1" />
                        <path d="M20,-4 L20,4 L16,5 L16,-5 Z" class="fill-muted-foreground/30 stroke-muted-foreground" stroke-width="1" />
                    </g>

                    {{-- Warning sparks --}}
                    <g class="text-destructive">
                        {{-- Spark 1 --}}
                        <line x1="185" y1="70" x2="200" y2="58" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <line x1="200" y1="58" x2="195" y2="68" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <line x1="195" y1="68" x2="210" y2="55" stroke="currentColor" stroke-width="2" stroke-linecap="round" />

                        {{-- Spark 2 --}}
                        <line x1="95" y1="155" x2="80" y2="165" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <line x1="80" y1="165" x2="88" y2="158" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <line x1="88" y1="158" x2="72" y2="172" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </g>

                    {{-- Circuit lines (decorative) --}}
                    <path d="M20 180 L50 180 L50 160" stroke="currentColor" stroke-width="1" class="text-border" stroke-linecap="round" />
                    <circle cx="50" cy="160" r="2" class="fill-muted-foreground" />
                    <path d="M260 180 L230 180 L230 160" stroke="currentColor" stroke-width="1" class="text-border" stroke-linecap="round" />
                    <circle cx="230" cy="160" r="2" class="fill-muted-foreground" />
                    <path d="M20 40 L40 40 L40 55" stroke="currentColor" stroke-width="1" class="text-border" stroke-linecap="round" />
                    <circle cx="40" cy="40" r="2" class="fill-muted-foreground" />

                    {{-- Warning triangle --}}
                    <g transform="translate(220, 40)">
                        <path d="M0,-15 L13,10 L-13,10 Z" class="stroke-destructive fill-destructive/10" stroke-width="1.5" stroke-linejoin="round" />
                        <line x1="0" y1="-6" x2="0" y2="2" class="stroke-destructive" stroke-width="2" stroke-linecap="round" />
                        <circle cx="0" cy="6" r="1.5" class="fill-destructive" />
                    </g>
                </svg>
            </div>

            {{-- Error code --}}
            <div class="animate-fade-in-up mb-4" style="animation-delay: 0.1s">
                <span class="text-8xl font-bold text-destructive/20 select-none">500</span>
            </div>

            {{-- Heading --}}
            <h1 class="animate-fade-in-up mb-4 text-3xl font-bold tracking-tight md:text-4xl" style="animation-delay: 0.2s">
                {{ __('error.500.heading') }}
            </h1>

            {{-- Description --}}
            <p class="animate-fade-in-up mb-10 text-lg text-muted-foreground" style="animation-delay: 0.3s">
                {{ __('error.500.description') }}
            </p>

            {{-- Action buttons --}}
            <div class="animate-fade-in-up flex flex-col items-center justify-center gap-4 sm:flex-row" style="animation-delay: 0.4s">
                <button onclick="window.location.reload()" class="inline-flex items-center gap-2 rounded-full bg-destructive px-6 py-3 text-sm font-medium text-destructive-foreground transition-all hover:scale-105 hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/>
                    </svg>
                    {{ __('error.500.try_again') }}
                </button>
                <a href="/" class="inline-flex items-center gap-2 rounded-full border border-border px-6 py-3 text-sm font-medium text-foreground transition-all hover:bg-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>
                    </svg>
                    {{ __('error.500.go_home') }}
                </a>
            </div>
        </div>
    </div>
@endsection
