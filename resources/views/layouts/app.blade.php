<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', 'Lepres Kikounga | VP of Engineering & Tech Advisor')</title>

    <meta name="description" content="@yield('description', 'Portfolio de Lepres Kikounga - VP of Engineering avec 8+ ans d\'expérience. Ex-CTO at Cowema. Spécialisé en architecture système, leadership technique et stratégie technologique.')">
    <meta name="keywords" content="VP of Engineering, CTO, Tech Advisor, Engineering Leadership, System Architecture, Laravel, React, Flutter, .NET, Next.js">
    <meta name="author" content="Lepres Kikounga">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Lepres Kikounga | VP of Engineering & Tech Advisor')">
    <meta property="og:description" content="8+ years leading engineering teams and building scalable systems">
    <meta property="og:site_name" content="Lepres Kikounga Portfolio">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="icon" href="/icon-light-32x32.png" media="(prefers-color-scheme: light)">
    <link rel="icon" href="/icon-dark-32x32.png" media="(prefers-color-scheme: dark)">
    <link rel="icon" href="/icon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-icon.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>
<body class="font-sans antialiased">
    @include('partials.navigation')

    <main class="relative">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 z-50 flex h-12 w-12 items-center justify-center rounded-full bg-primary text-primary-foreground shadow-lg transition-all duration-300 hover:scale-110 hover:shadow-xl opacity-0 pointer-events-none" aria-label="Retour en haut">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m18 15-6-6-6 6"/>
        </svg>
    </button>

    @stack('scripts')
</body>
</html>
