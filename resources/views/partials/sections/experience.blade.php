<section id="experience" class="py-32 bg-background">
    <div class="container mx-auto px-6">
        <div class="mb-16 text-center">
            <div class="mb-4 text-sm font-medium tracking-wider text-muted-foreground">EXPERIENCE</div>
            <h2 class="text-balance font-bold leading-tight tracking-tighter text-4xl md:text-5xl lg:text-6xl">
                Professional Journey
            </h2>
        </div>

        <div class="relative mx-auto max-w-5xl">
            <div class="absolute left-8 top-0 bottom-0 w-px bg-border lg:left-1/2"></div>

            <div class="space-y-12">
                @php
                    $experiences = [
                        [
                            'title' => 'VP of Engineering',
                            'company' => 'Akieni',
                            'location' => 'Brazzaville',
                            'period' => 'April 2025 – Present',
                            'achievements' => [
                                'Manage 11+ engineers across DevOps, Backend, Frontend, UI/UX',
                                'Reduced cloud costs by $1,500/month (~21%) through AWS migration',
                                'Achieved 99.9% uptime with Kubernetes-based HA infrastructure',
                                'Led architecture for E-payment System and Biometric One Database Platform'
                            ],
                            'technologies' => ['AdonisJS', 'NestJS', 'React.js', 'PostgreSQL', 'RabbitMQ', 'Kubernetes']
                        ],
                        [
                            'title' => 'Engineering Manager',
                            'company' => 'Akieni',
                            'location' => 'Brazzaville',
                            'period' => 'April 2024 – March 2025',
                            'achievements' => [
                                'Delivered CAMU (Universal Health Insurance System) after 2+ years stalled',
                                'Built CNSS GED middleware with Django and Next.js',
                                'Mentored 2 junior developers to mid-level',
                                'Supervised 5 developers and 2 DevOps engineers'
                            ],
                            'technologies' => ['Django', 'SpringBoot', 'React', 'Redux', 'GraphQL', 'Next.js']
                        ],
                        [
                            'title' => 'Technical Officer, Data and Operations',
                            'company' => 'WHO Regional Office for Africa',
                            'location' => 'Brazzaville',
                            'period' => 'September 2023 – March 2024',
                            'achievements' => [
                                'Maintained TAR2 internal platform for 47 country offices',
                                'Reduced report generation time by 40% with automated pipelines',
                                'Built interactive PowerBI dashboards'
                            ],
                            'technologies' => ['ASP.NET Core', 'Blazor', 'PowerBI']
                        ],
                        [
                            'title' => 'CTO & Co-Founder',
                            'company' => 'COWEMA',
                            'location' => 'Brazzaville',
                            'period' => 'March 2020 – May 2023',
                            'achievements' => [
                                'Built full tech stack from scratch',
                                'Scaled platform to 30K+ users',
                                'Recruited and trained 3 junior devs to senior level within a year',
                                'Shipped Marketplace and VEC vendor management apps'
                            ],
                            'technologies' => ['Laravel', 'Flutter', 'Kotlin', 'CakePHP', 'MariaDB']
                        ]
                    ];
                @endphp

                @foreach ($experiences as $index => $exp)
                    <div data-index="{{ $index }}" class="timeline-item relative transition-all duration-700 translate-y-8 opacity-0" style="transition-delay: {{ $index * 100 }}ms">
                        <div class="flex flex-col gap-8 lg:flex-row {{ $index % 2 === 1 ? 'lg:flex-row-reverse' : '' }}">
                            <div class="absolute left-8 top-0 z-10 h-4 w-4 -translate-x-1/2 rounded-full bg-primary ring-4 ring-background lg:left-1/2"></div>

                            <div class="flex-1 {{ $index % 2 === 1 ? 'lg:text-right' : '' }}">
                                <div class="ml-12 lg:ml-0">
                                    <div class="group rounded-2xl border border-border bg-card p-8 transition-all duration-300 hover:border-primary/20 hover:bg-card/50 hover:shadow-xl hover:backdrop-blur-sm {{ $index % 2 === 1 ? 'lg:ml-8' : 'lg:mr-8' }}">
                                        <div class="mb-4 flex items-center gap-2 text-sm text-muted-foreground">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/>
                                            </svg>
                                            <span>{{ $exp['period'] }}</span>
                                        </div>

                                        <div class="mb-2 flex items-start gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mt-1 text-primary">
                                                <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><rect width="20" height="14" x="2" y="6" rx="2"/>
                                            </svg>
                                            <div>
                                                <h3 class="mb-1 text-xl font-bold">{{ $exp['title'] }}</h3>
                                                <p class="text-primary font-medium">{{ $exp['company'] }} • {{ $exp['location'] }}</p>
                                            </div>
                                        </div>

                                        <ul class="mt-4 space-y-2 text-sm text-muted-foreground leading-relaxed">
                                            @foreach ($exp['achievements'] as $achievement)
                                                <li class="flex gap-2">
                                                    <span class="text-primary">•</span>
                                                    <span>{{ $achievement }}</span>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <div class="mt-6 flex flex-wrap gap-2">
                                            @foreach ($exp['technologies'] as $tech)
                                                <span class="rounded-full bg-primary/10 px-3 py-1 text-xs font-medium text-primary">
                                                    {{ $tech }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="hidden flex-1 lg:block"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
