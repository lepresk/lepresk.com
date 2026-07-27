<footer class="border-t border-border bg-background py-12">
    <div class="container mx-auto px-6">
        <div class="flex flex-col items-center justify-between gap-6 md:flex-row">
            <!-- Social Links -->
            <div class="flex items-center gap-4">
                <a href="https://facebook.com/lepresk" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-full border border-border transition-colors hover:border-primary hover:bg-primary hover:text-primary-foreground" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                    </svg>
                </a>
                <a href="https://x.com/lepresk1" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-full border border-border transition-colors hover:border-primary hover:bg-primary hover:text-primary-foreground" aria-label="X (Twitter)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4l11.733 16h4.267l-11.733 -16z"/><path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772"/>
                    </svg>
                </a>
                <a href="https://youtube.com/@lepresk" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-full border border-border transition-colors hover:border-primary hover:bg-primary hover:text-primary-foreground" aria-label="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/>
                    </svg>
                </a>
                <a href="https://linkedin.com/in/lepres-kikounga-438911133" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-full border border-border transition-colors hover:border-primary hover:bg-primary hover:text-primary-foreground" aria-label="LinkedIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/>
                    </svg>
                </a>
                <a href="https://t.me/lepresk" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-full border border-border transition-colors hover:border-primary hover:bg-primary hover:text-primary-foreground" aria-label="Telegram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 2 11 13"/><path d="m22 2-7 20-4-9-9-4z"/>
                    </svg>
                </a>
            </div>

            <!-- Language Switcher -->
            <div class="flex items-center gap-2">
                <a href="{{ route('language.switch', 'en') }}" rel="nofollow" class="text-sm font-medium transition-colors {{ app()->getLocale() === 'en' ? 'text-primary' : 'text-muted-foreground hover:text-primary' }}">EN</a>
                <span class="text-sm text-muted-foreground">|</span>
                <a href="{{ route('language.switch', 'fr') }}" rel="nofollow" class="text-sm font-medium transition-colors {{ app()->getLocale() === 'fr' ? 'text-primary' : 'text-muted-foreground hover:text-primary' }}">FR</a>
            </div>

            <!-- Copyright -->
            <div class="text-center text-sm">
                <span class="text-muted-foreground">&copy; {{ date('Y') }} </span>
                <span class="font-semibold text-primary">Lepresk</span>
                <span class="text-muted-foreground">. {{ __('footer.copyright') }}</span>
            </div>

            <!-- Crafted By -->
            <div class="text-center text-sm md:text-right">
                <span class="text-muted-foreground">{{ __('footer.crafted') }} </span>
                <span class="text-red-500">❤️</span>
                <span class="text-muted-foreground"> {{ __('footer.by') }} </span>
                <span class="font-semibold text-primary">Lepresk</span>
            </div>
        </div>
    </div>
</footer>
