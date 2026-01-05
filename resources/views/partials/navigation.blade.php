<nav id="navigation" class="fixed top-0 z-40 w-full transition-all duration-300">
    <div class="container mx-auto flex items-center justify-between px-6 py-6">
        <a href="/" class="text-2xl font-bold tracking-tighter">
            LK<span class="text-primary">.</span>
        </a>

        <div class="hidden items-center gap-8 lg:flex">
            <a href="/#home" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="home">
                {{ __('nav.home') }}
            </a>
            <a href="/#about" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="about">
                {{ __('nav.about') }}
            </a>
            <a href="/#experience" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="experience">
                {{ __('nav.experience') }}
            </a>
            <a href="/#services" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="services">
                {{ __('nav.services') }}
            </a>
            <a href="/#skills" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="skills">
                {{ __('nav.skills') }}
            </a>
            <a href="/#projects" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="projects">
                {{ __('nav.projects') }}
            </a>
            <a href="/blog" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full">
                {{ __('nav.blog') }}
            </a>
            <a href="/#contact" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="contact">
                {{ __('nav.contact') }}
            </a>

            <!-- Theme Toggle -->
            <button id="theme-toggle" class="flex h-10 w-10 items-center justify-center rounded-full border border-border bg-background/50 backdrop-blur-sm transition-all hover:bg-accent hover:border-primary" aria-label="Toggle theme">
                <svg id="theme-icon-sun" class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/>
                </svg>
                <svg id="theme-icon-moon" class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>
                </svg>
            </button>
        </div>

        <div class="flex items-center gap-4 lg:hidden">
            <!-- Theme Toggle Mobile -->
            <button id="theme-toggle-mobile" class="flex h-10 w-10 items-center justify-center rounded-full border border-border bg-background/50 backdrop-blur-sm transition-all hover:bg-accent hover:border-primary" aria-label="Toggle theme">
                <svg id="theme-icon-sun-mobile" class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/>
                </svg>
                <svg id="theme-icon-moon-mobile" class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>
                </svg>
            </button>

            <!-- Menu Toggle -->
            <button id="menu-toggle" aria-label="Toggle menu" class="relative z-50 rounded-lg p-2 transition-colors hover:bg-muted">
                <svg id="menu-icon" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/>
                </svg>
                <svg id="close-icon" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed top-0 left-0 right-0 bottom-0 z-50 min-h-screen w-full bg-background/95 backdrop-blur-xl transition-all duration-300 lg:hidden opacity-0 invisible overflow-hidden">
        <!-- Close Button -->
        <button id="mobile-menu-close" class="absolute top-6 right-6 z-[60] flex h-10 w-10 items-center justify-center rounded-full border border-border bg-background/80 backdrop-blur-sm transition-colors hover:bg-accent hover:border-primary" aria-label="Close menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
            </svg>
        </button>

        <div id="mobile-menu-content" class="flex min-h-screen w-full flex-col items-center justify-center gap-8 transition-all duration-500 -translate-y-8 overflow-y-auto py-20">
            <a href="/#home" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="home">
                {{ __('nav.home') }}
            </a>
            <a href="/#about" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="about">
                {{ __('nav.about') }}
            </a>
            <a href="/#experience" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="experience">
                {{ __('nav.experience') }}
            </a>
            <a href="/#services" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="services">
                {{ __('nav.services') }}
            </a>
            <a href="/#skills" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="skills">
                {{ __('nav.skills') }}
            </a>
            <a href="/#projects" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="projects">
                {{ __('nav.projects') }}
            </a>
            <a href="/blog" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground">
                {{ __('nav.blog') }}
            </a>
            <a href="/#contact" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="contact">
                {{ __('nav.contact') }}
            </a>

            <!-- Language Switcher Mobile -->
            <div class="flex items-center gap-3 mt-8">
                <form action="{{ route('language.switch', 'en') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-lg font-medium transition-colors cursor-pointer {{ app()->getLocale() === 'en' ? 'text-primary' : 'text-muted-foreground hover:text-primary' }}">
                        EN
                    </button>
                </form>
                <span class="text-lg text-muted-foreground">|</span>
                <form action="{{ route('language.switch', 'fr') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-lg font-medium transition-colors cursor-pointer {{ app()->getLocale() === 'fr' ? 'text-primary' : 'text-muted-foreground hover:text-primary' }}">
                        FR
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
