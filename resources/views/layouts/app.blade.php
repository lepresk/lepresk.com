<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', __('meta.home.title'))</title>

    <meta name="description" content="@yield('description', __('meta.home.description'))">
    <meta name="keywords" content="VP of Engineering, CTO, Tech Advisor, Engineering Leadership, System Architecture, Laravel, React, Flutter, .NET, Next.js">
    <meta name="author" content="Lepres Kikounga">

    <!-- Hreflang Tags -->
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}" />
    <link rel="alternate" hreflang="fr" href="{{ url()->current() }}" />
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}" />

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="{{ app()->getLocale() === 'fr' ? 'fr_FR' : 'en_US' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', __('meta.home.title'))">
    <meta property="og:description" content="@yield('description', __('meta.home.description'))">
    <meta property="og:site_name" content="Lepres Kikounga Portfolio">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Favicons -->
    <link rel="icon" href="/favicons/cropped-logo-1-32x32.png" sizes="32x32">
    <link rel="icon" href="/favicons/cropped-logo-1-192x192.png" sizes="192x192">
    <link rel="apple-touch-icon" href="/favicons/cropped-logo-1-180x180.png">
    <meta name="msapplication-TileImage" content="/favicons/cropped-logo-1-270x270.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    @php
        echo json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => 'Lepres Kikounga',
            'jobTitle' => __('hero.role'),
            'description' => __('meta.home.description'),
            'url' => url('/'),
            'sameAs' => [
                'https://linkedin.com/in/lepres-kikounga-438911133',
                'https://linkedin.com/in/lepresk',
                'https://github.com/lepresk',
                'https://youtube.com/@lepresk',
                'https://facebook.com/lepresk',
                'https://t.me/lepresk'
            ],
            'inLanguage' => ['en', 'fr']
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    @endphp
    </script>

    @stack('head')
</head>
<body class="font-sans antialiased">
    @include('partials.navigation')

    <main class="relative">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 z-50 flex h-12 w-12 items-center justify-center rounded-full bg-primary text-primary-foreground shadow-lg transition-all duration-300 hover:scale-110 hover:shadow-xl opacity-0 pointer-events-none" aria-label="{{ __('back_to_top') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m18 15-6-6-6 6"/>
        </svg>
    </button>

    @stack('scripts')
</body>
</html>
