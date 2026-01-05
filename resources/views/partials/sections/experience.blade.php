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
                            'period' => 'March 2025 – Present',
                            'achievements' => [
                                'Lead 17+ engineers (Backend, Frontend, Mobile, DevOps)',
                                'Executive member driving technical strategy',
                                'Scaled team from 7 to 17+ engineers',
                                'Established engineering processes and structure',
                                'Integrated Academy talent with mentorship',
                                'Lead R&D and product development',
                                'Oversee enterprise systems delivery'
                            ],
                            'technologies' => ['Technical Strategy', 'People Management', 'Process Design', 'R&D Leadership', 'Cross-functional Alignment', 'Hiring & Onboarding']
                        ],
                        [
                            'title' => 'Engineering Manager',
                            'company' => 'Akieni',
                            'location' => 'Brazzaville',
                            'period' => 'April 2024 – February 2025',
                            'achievements' => [
                                'Lead engineering team from 0 to 7+ engineers (Backend, Frontend, DevOps, Mobile)',
                                'Delivered critical enterprise system after 2+ years stalled',
                                'Reduced infrastructure costs by 21% through AWS migration and optimization',
                                'Achieved 99.9% uptime with Kubernetes-based high-availability architecture',
                                'Built integration middleware connecting government services',
                                'Mentored 2 junior developers to mid-level within 18 months'
                            ],
                            'technologies' => ['Django', 'SpringBoot', 'React', 'Redux', 'GraphQL', 'Next.js']
                        ],
                        [
                            'title' => 'Technical Officer, Data and Operations',
                            'company' => 'WHO Regional Office for Africa',
                            'location' => 'Brazzaville',
                            'period' => 'September 2023 – March 2024',
                            'achievements' => [
                                'Maintained internal tools for 47 WHO Africa member states',
                                'Database management and optimization (SQL Server)',
                                'Developed data collection tools',
                                'Reduced report generation time by 40% with automated pipelines',
                                'Built interactive PowerBI dashboards',
                                'Provided technical support across the region'
                            ],
                            'technologies' => ['ASP.NET Core', 'Blazor', 'SQL Server', 'PowerBI']
                        ],
                        [
                            'title' => 'CTO & Co-Founder',
                            'company' => 'COWEMA',
                            'location' => 'Brazzaville',
                            'period' => 'March 2020 – May 2023',
                            'achievements' => [
                                'Co-founded and scaled e-commerce platform from 0 to 30K+ users',
                                'Built tech stack and shipped Marketplace + VEC apps',
                                'Developed internal tools for reporting and back-office operations',
                                'Recruited and mentored 3 junior devs to senior level'
                            ],
                            'technologies' => ['Laravel', 'Flutter', 'Kotlin', 'CakePHP', 'MariaDB']
                        ],
                        [
                            'title' => 'Freelance Developer',
                            'company' => 'Self-employed',
                            'location' => 'Pointe-Noire',
                            'period' => '2016 – 2020',
                            'achievements' => [
                                'Delivered 20+ projects for local and international clients',
                                'Built Lord-Market marketplace app (10K+ downloads)',
                                'Developed mobile and web solutions across various industries',
                                'Established client base leading to COWEMA founding'
                            ],
                            'technologies' => ['PHP', 'Java', 'MySQL', 'VB.NET', 'C#.NET', 'Android', 'WordPress']
                        ]
                    ];
                @endphp

                @foreach ($experiences as $index => $exp)
                    <div data-index="{{ $index }}" class="timeline-item relative transition-all duration-700 translate-y-8 opacity-0" style="transition-delay: {{ $index * 100 }}ms">
                        <div class="flex flex-col gap-8 lg:flex-row {{ $index % 2 === 1 ? 'lg:flex-row-reverse' : '' }}">
                            <div class="absolute left-8 top-0 z-10 h-4 w-4 -translate-x-1/2 rounded-full bg-primary ring-4 ring-background lg:left-1/2"></div>

                            <div class="flex-1">
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
