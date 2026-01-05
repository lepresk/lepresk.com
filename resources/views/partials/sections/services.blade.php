<section id="services" class="bg-gradient-to-br from-blue-50/50 via-cyan-50/30 to-background dark:from-background dark:via-background dark:to-background py-32">
    <div class="container mx-auto px-6">
        <div class="mb-16 text-center">
            <div class="mb-4 text-sm font-medium tracking-wider text-muted-foreground">SERVICES</div>
            <h2 class="mb-4 text-balance font-bold leading-tight tracking-tighter text-4xl md:text-5xl">
                How I can help
            </h2>
            <p class="mx-auto max-w-2xl text-pretty text-muted-foreground">
                Strategic guidance and hands-on execution for your technical challenges
            </p>
        </div>

        <div class="grid gap-8 md:grid-cols-1 lg:grid-cols-2 lg:gap-12">
            @php
                $services = [
                    [
                        'icon' => 'layout-dashboard',
                        'title' => 'Technical Strategy',
                        'subtitle' => 'Architecture & Planning',
                        'description' => 'Define scalable tech architecture, choose the right stack, and plan roadmaps that align with business goals. From microservices to monoliths, I help you make decisions that last.'
                    ],
                    [
                        'icon' => 'users',
                        'title' => 'Engineering Leadership',
                        'subtitle' => 'Team Building & Management',
                        'description' => "Build high-performing engineering teams through structured hiring, mentorship programs, and clear processes. I've scaled teams from 0 to 11+ engineers and trained juniors to senior level."
                    ],
                    [
                        'icon' => 'blocks',
                        'title' => 'System Design & Migration',
                        'subtitle' => 'Infrastructure & DevOps',
                        'description' => 'Migrate legacy systems, optimize cloud infrastructure, and implement CI/CD pipelines. Experience with AWS, Kubernetes, RabbitMQ, and reducing operational costs while improving uptime.'
                    ],
                    [
                        'icon' => 'wrench',
                        'title' => 'Full-Stack Development',
                        'subtitle' => 'Laravel, Node.js, React, Flutter',
                        'description' => 'Hands-on development when needed. Built e-payment systems, biometric platforms, health insurance systems, and marketplace apps serving 30K+ users. Backend to mobile, I ship complete solutions.'
                    ]
                ];
            @endphp

            @foreach ($services as $index => $service)
                <div data-service-card data-index="{{ $index }}" class="group rounded-2xl border border-border bg-card p-8 transition-all duration-700 hover:border-primary/40 hover:shadow-2xl hover:shadow-primary/5 dark:bg-slate-900/60 dark:hover:bg-slate-900/80 dark:border-slate-800/50 dark:hover:border-primary/60 service-card translate-y-12 opacity-0" style="transition-delay: {{ $index * 150 }}ms">
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
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-foreground dark:text-slate-300 dark:group-hover:text-primary">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
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
</section>
