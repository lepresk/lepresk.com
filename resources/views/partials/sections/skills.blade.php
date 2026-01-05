<section id="competences" class="py-32 bg-muted/30">
    <div class="container mx-auto px-6">
        <div class="mb-16 text-center">
            <div class="mb-4 text-sm font-medium tracking-wider text-muted-foreground">COMPÉTENCES</div>
            <h2 class="mb-4 text-balance font-bold leading-tight tracking-tighter text-4xl md:text-5xl">
                Technologies maîtrisées
            </h2>
        </div>

        <div class="mx-auto grid max-w-6xl gap-6 md:grid-cols-2 lg:grid-cols-3">
            @php
                $skillCategories = [
                    [
                        'title' => 'Backend Development',
                        'icon' => 'server',
                        'skills' => ['PHP / Laravel', 'Node.js', 'Express.js', '.NET / C#', 'AdonisJS']
                    ],
                    [
                        'title' => 'Frontend Development',
                        'icon' => 'code',
                        'skills' => ['React / Next.js', 'TypeScript', 'Tailwind CSS', 'Vue.js']
                    ],
                    [
                        'title' => 'Mobile Development',
                        'icon' => 'smartphone',
                        'skills' => ['Flutter', 'Android / Kotlin', 'React Native', 'Cross-platform']
                    ],
                    [
                        'title' => 'Database & Infrastructure',
                        'icon' => 'database',
                        'skills' => ['PostgreSQL', 'MySQL', 'MongoDB', 'Redis', 'Docker']
                    ],
                    [
                        'title' => 'CMS & Platforms',
                        'icon' => 'globe',
                        'skills' => ['WordPress', 'Strapi', 'Contentful', 'Custom CMS']
                    ],
                    [
                        'title' => 'Architecture & Tools',
                        'icon' => 'blocks',
                        'skills' => ['Microservices', 'CI/CD', 'AWS', 'Git', 'REST APIs']
                    ]
                ];
            @endphp

            @foreach ($skillCategories as $index => $category)
                <div class="group rounded-2xl border border-border bg-card p-6 transition-all duration-500 hover:border-primary hover:shadow-lg hover:backdrop-blur-xl hover:bg-card/80 skill-card translate-y-8 opacity-0">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="rounded-lg bg-primary/10 p-2 text-primary transition-colors group-hover:bg-primary group-hover:text-primary-foreground">
                            @if ($category['icon'] === 'server')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="8" x="2" y="2" rx="2" ry="2"/><rect width="20" height="8" x="2" y="14" rx="2" ry="2"/><line x1="6" x2="6.01" y1="6" y2="6"/><line x1="6" x2="6.01" y1="18" y2="18"/>
                                </svg>
                            @elseif ($category['icon'] === 'code')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>
                                </svg>
                            @elseif ($category['icon'] === 'smartphone')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/>
                                </svg>
                            @elseif ($category['icon'] === 'database')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5V19A9 3 0 0 0 21 19V5"/><path d="M3 12A9 3 0 0 0 21 12"/>
                                </svg>
                            @elseif ($category['icon'] === 'globe')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="7" height="7" x="14" y="3" rx="1"/><path d="M10 21V8a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H3"/>
                                </svg>
                            @endif
                        </div>
                        <h3 class="font-bold text-lg">{{ $category['title'] }}</h3>
                    </div>
                    <ul class="space-y-2">
                        @foreach ($category['skills'] as $skill)
                            <li class="flex items-center gap-2 text-sm text-muted-foreground">
                                <div class="h-1.5 w-1.5 rounded-full bg-primary"></div>
                                {{ $skill }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>
