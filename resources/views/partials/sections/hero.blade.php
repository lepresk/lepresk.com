<section id="home" class="relative flex min-h-screen items-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-background via-background to-primary/5"></div>

    <canvas id="hero-canvas" class="absolute inset-0 h-full w-full opacity-60"></canvas>

    <div class="container relative z-10 mx-auto px-6">
        <div class="mx-auto grid max-w-7xl items-center gap-12 lg:grid-cols-2">
            <div>
                <div class="mb-6 overflow-hidden">
                    <p class="animate-fade-in-up text-xl font-bold uppercase tracking-wide text-primary md:text-2xl">
                        {{ __('hero.greeting') }}
                    </p>
                </div>

                <div class="mb-4 overflow-hidden">
                    <h1 class="animate-fade-in-up font-bold leading-none tracking-tighter [animation-delay:100ms] text-6xl md:text-8xl lg:text-9xl">
                        Lepres K.
                    </h1>
                </div>

                <div class="mb-8 overflow-hidden">
                    <p class="animate-fade-in-up text-2xl text-muted-foreground [animation-delay:200ms] md:text-3xl">
                        {{ __('hero.role') }}
                        <br>
                        <span class="font-semibold text-foreground">{{ __('hero.tagline') }}</span>
                    </p>
                </div>

                <div class="mb-12 overflow-hidden">
                    <p class="animate-fade-in-up max-w-2xl text-pretty text-muted-foreground [animation-delay:300ms] md:text-lg">
                        {{ __('hero.description') }}
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-4 overflow-hidden">
                    <a href="#services" class="animate-fade-in-up group inline-flex items-center gap-2 rounded-full bg-primary px-8 py-4 font-medium text-primary-foreground transition-all hover:gap-4 [animation-delay:400ms]">
                        {{ __('hero.cta_primary') }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:translate-x-1">
                            <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                        </svg>
                    </a>

                    <a href="#contact" class="animate-fade-in-up inline-flex items-center gap-2 rounded-full border-2 border-primary/30 bg-primary/10 px-8 py-4 font-medium text-foreground transition-all hover:border-primary hover:bg-primary/20 hover:shadow-lg [animation-delay:450ms]">
                        {{ __('hero.cta_secondary') }}
                    </a>

                    <div class="animate-fade-in-up flex gap-4 [animation-delay:500ms]">
                        <a href="https://linkedin.com/in/lepresk" target="_blank" rel="noopener noreferrer" class="flex h-12 w-12 items-center justify-center rounded-full border border-border transition-colors hover:border-primary hover:bg-primary hover:text-primary-foreground" aria-label="LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/>
                            </svg>
                        </a>
                        <a href="https://x.com/lepresk1" target="_blank" rel="noopener noreferrer" class="flex h-12 w-12 items-center justify-center rounded-full border border-border transition-colors hover:border-primary hover:bg-primary hover:text-primary-foreground" aria-label="X (Twitter)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4l11.733 16h4.267l-11.733 -16z"/><path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772"/>
                            </svg>
                        </a>
                        <a href="https://github.com/lepresk" target="_blank" rel="noopener noreferrer" class="flex h-12 w-12 items-center justify-center rounded-full border border-border transition-colors hover:border-primary hover:bg-primary hover:text-primary-foreground" aria-label="GitHub">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/>
                            </svg>
                        </a>
                        <a href="https://youtube.com/@lepresk" target="_blank" rel="noopener noreferrer" class="flex h-12 w-12 items-center justify-center rounded-full border border-border transition-colors hover:border-primary hover:bg-primary hover:text-primary-foreground" aria-label="YouTube">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="relative hidden md:block">
                <div class="relative mx-auto h-[500px] w-[400px] md:h-[600px] md:w-[470px] lg:h-[700px] lg:w-[550px]">
                    <div class="absolute rounded-full border-[3px] border-primary" style="width: 480px; height: 480px; left: 50%; top: 120px; transform: translateX(-50%);"></div>
                    <div class="absolute rounded-full border-[2px] border-primary/40" style="width: 500px; height: 500px; left: 50%; top: 120px; transform: translateX(-50%);"></div>
                    <div class="absolute rounded-full bg-primary" style="width: 460px; height: 460px; left: 50%; top: 120px; transform: translateX(-50%);"></div>
                    <div class="absolute rounded-full border-4 border-primary/30 bg-background" style="width: 100px; height: 100px; left: 30px; bottom: 0px;"></div>

                    <div class="absolute" style="width: 520px; height: 730px; left: 50%; top: -10px; transform: translateX(-50%); clip-path: ellipse(260px 368px at 50% 51%);">
                        <img src="/images/profile.webp" alt="Lepres Kikounga" width="520" height="730" class="h-full w-full object-cover object-top">
                    </div>

                    <div class="absolute right-0 top-[200px] flex flex-col gap-3">
                        @for ($i = 0; $i < 8; $i++)
                            <div class="h-2 w-2 rounded-full bg-muted-foreground/30"></div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-12 left-1/2 -translate-x-1/2 animate-bounce">
        <div class="h-16 w-px bg-gradient-to-b from-transparent via-foreground/50 to-transparent"></div>
    </div>
</section>
