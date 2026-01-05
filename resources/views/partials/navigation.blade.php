<nav id="navigation" class="fixed top-0 z-40 w-full transition-all duration-300">
    <div class="container mx-auto flex items-center justify-between px-6 py-6">
        <a href="/" class="text-2xl font-bold tracking-tighter">
            LK<span class="text-primary">.</span>
        </a>

        <div class="hidden items-center gap-8 lg:flex">
            <a href="/#accueil" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="accueil">
                Accueil
            </a>
            <a href="/#a-propos" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="a-propos">
                À propos
            </a>
            <a href="/#experience" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="experience">
                Expérience
            </a>
            <a href="/#services" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="services">
                Services
            </a>
            <a href="/#competences" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="competences">
                Compétences
            </a>
            <a href="/#projets" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="projets">
                Projets
            </a>
            <a href="/blog" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full">
                Blog
            </a>
            <a href="/#contact" class="nav-link relative text-sm font-medium transition-colors after:absolute after:bottom-0 after:left-0 after:h-px after:bg-primary after:transition-all hover:text-primary text-muted-foreground after:w-0 hover:after:w-full" data-section="contact">
                Contact
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
    <div id="mobile-menu" class="fixed inset-0 z-50 bg-background/95 backdrop-blur-xl transition-all duration-300 lg:hidden opacity-0 invisible">
        <div id="mobile-menu-content" class="flex h-full flex-col items-center justify-center gap-8 transition-all duration-500 -translate-y-8">
            <a href="/#accueil" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="accueil">
                Accueil
            </a>
            <a href="/#a-propos" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="a-propos">
                À propos
            </a>
            <a href="/#experience" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="experience">
                Expérience
            </a>
            <a href="/#services" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="services">
                Services
            </a>
            <a href="/#competences" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="competences">
                Compétences
            </a>
            <a href="/#projets" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="projets">
                Projets
            </a>
            <a href="/blog" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground">
                Blog
            </a>
            <a href="/#contact" class="mobile-nav-link text-2xl font-medium transition-all duration-300 hover:scale-110 hover:text-primary text-muted-foreground" data-section="contact">
                Contact
            </a>
        </div>
    </div>
</nav>
