<section id="services" class="relative overflow-hidden bg-gradient-to-br from-cyan-100 via-emerald-100 to-blue-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 py-32">
    <!-- Decorative patterns -->
    <div class="absolute inset-0">
        <!-- Top left - circles -->
        <svg class="absolute top-10 left-10 w-48 h-48 text-cyan-400/30" viewBox="0 0 200 200" fill="none">
            <circle cx="100" cy="100" r="80" stroke="currentColor" stroke-width="3"/>
            <circle cx="100" cy="100" r="60" stroke="currentColor" stroke-width="2"/>
            <circle cx="100" cy="100" r="40" stroke="currentColor" stroke-width="1.5"/>
        </svg>
        <!-- Top right - squares -->
        <svg class="absolute top-20 right-20 w-40 h-40 text-emerald-400/30" viewBox="0 0 200 200" fill="none">
            <rect x="40" y="40" width="120" height="120" stroke="currentColor" stroke-width="3" rx="15"/>
            <rect x="60" y="60" width="80" height="80" stroke="currentColor" stroke-width="2" rx="10"/>
        </svg>
        <!-- Middle left - triangles -->
        <svg class="absolute top-1/2 left-1/4 w-44 h-44 text-blue-400/30" viewBox="0 0 200 200" fill="none">
            <path d="M100 10 L190 190 L10 190 Z" stroke="currentColor" stroke-width="3" fill="none"/>
            <path d="M100 40 L160 160 L40 160 Z" stroke="currentColor" stroke-width="2" fill="none"/>
        </svg>
        <!-- Middle right - filled circles -->
        <svg class="absolute top-1/3 right-1/3 w-36 h-36 text-cyan-400/40" viewBox="0 0 200 200" fill="none">
            <circle cx="100" cy="100" r="70" fill="currentColor" opacity="0.3"/>
            <circle cx="100" cy="100" r="40" fill="currentColor" opacity="0.5"/>
        </svg>
        <!-- Bottom right - cross -->
        <svg class="absolute bottom-20 right-10 w-52 h-52 text-emerald-400/30" viewBox="0 0 200 200" fill="none">
            <line x1="10" y1="100" x2="190" y2="100" stroke="currentColor" stroke-width="3"/>
            <line x1="100" y1="10" x2="100" y2="190" stroke="currentColor" stroke-width="3"/>
            <circle cx="100" cy="100" r="80" stroke="currentColor" stroke-width="2" fill="none"/>
        </svg>
        <!-- Bottom left - hexagon -->
        <svg class="absolute bottom-32 left-20 w-40 h-40 text-blue-400/30" viewBox="0 0 200 200" fill="none">
            <path d="M100 10 L170 50 L170 150 L100 190 L30 150 L30 50 Z" stroke="currentColor" stroke-width="3" fill="none"/>
            <path d="M100 40 L150 70 L150 130 L100 160 L50 130 L50 70 Z" stroke="currentColor" stroke-width="2" fill="none"/>
        </svg>
        <!-- Top center - dots pattern -->
        <svg class="absolute top-1/4 left-1/2 w-32 h-32 text-emerald-400/35" viewBox="0 0 200 200" fill="none">
            <circle cx="50" cy="50" r="8" fill="currentColor"/>
            <circle cx="100" cy="50" r="8" fill="currentColor"/>
            <circle cx="150" cy="50" r="8" fill="currentColor"/>
            <circle cx="50" cy="100" r="8" fill="currentColor"/>
            <circle cx="150" cy="100" r="8" fill="currentColor"/>
            <circle cx="50" cy="150" r="8" fill="currentColor"/>
            <circle cx="100" cy="150" r="8" fill="currentColor"/>
            <circle cx="150" cy="150" r="8" fill="currentColor"/>
        </svg>
        <!-- Bottom center - star -->
        <svg class="absolute bottom-1/4 right-1/4 w-36 h-36 text-cyan-400/30" viewBox="0 0 200 200" fill="none">
            <path d="M100 20 L120 80 L180 80 L130 120 L150 180 L100 140 L50 180 L70 120 L20 80 L80 80 Z" stroke="currentColor" stroke-width="2" fill="none"/>
        </svg>
        <!-- Middle bottom - diamond -->
        <svg class="absolute bottom-40 left-1/3 w-28 h-28 text-blue-400/35" viewBox="0 0 200 200" fill="none">
            <path d="M100 20 L180 100 L100 180 L20 100 Z" stroke="currentColor" stroke-width="3" fill="none"/>
            <path d="M100 50 L150 100 L100 150 L50 100 Z" stroke="currentColor" stroke-width="2" fill="none"/>
        </svg>
    </div>

    <div class="container relative mx-auto px-6 z-10">
        <div class="mb-16 text-center">
            <div class="mb-4 text-sm font-medium tracking-wider text-muted-foreground">{{ __('services.label') }}</div>
            <h2 class="mb-4 text-balance font-bold leading-tight tracking-tighter text-4xl md:text-5xl">
                {{ __('services.heading') }}
            </h2>
            <p class="mx-auto max-w-2xl text-pretty text-muted-foreground">
                {{ __('services.description') }}
            </p>
        </div>

        <div class="mx-auto max-w-7xl">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 lg:gap-10">
            @php
                $services = [
                    [
                        'icon' => 'layout-dashboard',
                        'title' => __('services.technical_strategy.title'),
                        'subtitle' => __('services.technical_strategy.subtitle'),
                        'description' => __('services.technical_strategy.description')
                    ],
                    [
                        'icon' => 'users',
                        'title' => __('services.engineering_leadership.title'),
                        'subtitle' => __('services.engineering_leadership.subtitle'),
                        'description' => __('services.engineering_leadership.description')
                    ],
                    [
                        'icon' => 'blocks',
                        'title' => __('services.system_design.title'),
                        'subtitle' => __('services.system_design.subtitle'),
                        'description' => __('services.system_design.description')
                    ],
                    [
                        'icon' => 'wrench',
                        'title' => __('services.fullstack_development.title'),
                        'subtitle' => __('services.fullstack_development.subtitle'),
                        'description' => __('services.fullstack_development.description')
                    ],
                    [
                        'icon' => 'lightbulb',
                        'title' => __('services.technical_consulting.title'),
                        'subtitle' => __('services.technical_consulting.subtitle'),
                        'description' => __('services.technical_consulting.description')
                    ]
                ];
            @endphp

            @foreach ($services as $index => $service)
                <div data-service-card data-index="{{ $index }}" class="group rounded-2xl border border-border bg-card p-8 transition-all duration-700 hover:border-primary/40 hover:shadow-2xl hover:shadow-primary/5 dark:bg-slate-900/60 dark:hover:bg-slate-900/80 dark:border-slate-800/50 dark:hover:border-primary/60 service-card translate-y-12 opacity-0 {{ $index === 3 ? 'lg:col-start-2' : '' }}" style="transition-delay: {{ $index * 150 }}ms">
                    <div class="mb-6 inline-flex rounded-xl bg-muted p-4 transition-transform group-hover:scale-110 dark:bg-slate-800/60 dark:group-hover:bg-primary/20">
                        @if ($service['icon'] === 'layout-dashboard')
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-foreground dark:text-slate-300 dark:group-hover:text-primary">
                                <rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/>
                            </svg>
                        @elseif ($service['icon'] === 'users')
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-foreground dark:text-slate-300 dark:group-hover:text-primary">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        @elseif ($service['icon'] === 'blocks')
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-foreground dark:text-slate-300 dark:group-hover:text-primary">
                                <rect width="7" height="7" x="14" y="3" rx="1"/><path d="M10 21V8a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H3"/>
                            </svg>
                        @elseif ($service['icon'] === 'wrench')
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-foreground dark:text-slate-300 dark:group-hover:text-primary">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-foreground dark:text-slate-300 dark:group-hover:text-primary">
                                <path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"/><path d="M9 18h6"/><path d="M10 22h4"/>
                            </svg>
                        @endif
                    </div>
                    <h3 class="mb-2 text-2xl font-bold">{{ $service['title'] }}</h3>
                    <p class="mb-4 text-sm font-medium text-muted-foreground">{{ $service['subtitle'] }}</p>
                    <p class="text-pretty text-muted-foreground leading-relaxed">{{ $service['description'] }}</p>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</section>
