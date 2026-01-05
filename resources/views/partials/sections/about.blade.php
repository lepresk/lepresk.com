<section id="a-propos" class="py-32 bg-muted/30">
    <div class="container mx-auto px-6">
        <div class="grid gap-16 lg:grid-cols-2">
            <div>
                <div class="mb-4 text-sm font-medium tracking-wider text-muted-foreground">ABOUT</div>
                <h2 class="mb-8 text-balance font-bold leading-tight tracking-tighter text-4xl md:text-5xl lg:text-6xl">
                    Building teams & systems that scale
                </h2>
                <div class="space-y-4 text-pretty text-muted-foreground leading-relaxed">
                    <p>
                        Currently VP of Engineering at Akieni, I lead 11+ engineers across DevOps, Backend, Frontend, and UI/UX.
                        I've migrated legacy infrastructure to reduce cloud costs by 21%, achieved 99.9% uptime with Kubernetes,
                        and delivered critical government systems previously stalled for 2+ years.
                    </p>
                    <p>
                        As former CTO and Co-Founder of Cowema, I built the entire tech stack from scratch, recruited and
                        trained junior developers to senior level within a year, and scaled the platform to 30K+ users.
                    </p>
                    <p>
                        My focus is on sustainable architecture, team growth, and delivering measurable business impact through
                        technology. I work across the full stack—from defining technical strategy to hands-on system design in
                        Laravel, Node.js, React, Flutter, and cloud infrastructure.
                    </p>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                @php
                    $stats = [
                        [
                            'value' => '8+',
                            'label' => 'Years in Tech Leadership',
                            'gradient' => 'bg-gradient-to-br from-blue-500 to-blue-600'
                        ],
                        [
                            'value' => '11+',
                            'label' => 'Engineers Managed',
                            'gradient' => 'bg-gradient-to-br from-purple-500 to-purple-600'
                        ],
                        [
                            'value' => '$1.5K/mo',
                            'label' => 'Cloud Cost Saved',
                            'gradient' => 'bg-gradient-to-br from-emerald-500 to-emerald-600'
                        ],
                        [
                            'value' => '99.9%',
                            'label' => 'Uptime Achieved',
                            'gradient' => 'bg-gradient-to-br from-orange-500 to-orange-600'
                        ]
                    ];
                @endphp

                @foreach ($stats as $index => $stat)
                    <div class="group relative overflow-hidden rounded-3xl shadow-md transition-all duration-500 hover:shadow-lg hover:scale-105 stat-card translate-y-8 opacity-0" style="transition-delay: {{ $index * 100 }}ms">
                        <div class="absolute inset-0 {{ $stat['gradient'] }}"></div>

                        <div class="relative p-8 flex flex-col items-start">
                            <div class="mb-6 text-white">
                                @if ($index === 0)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                @elseif ($index === 1)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                                @elseif ($index === 2)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2"/></svg>
                                @endif
                            </div>

                            <div class="mb-3 font-bold text-white text-5xl tabular-nums leading-none tracking-tight">
                                {{ $stat['value'] }}
                            </div>

                            <div class="text-base text-white/90 leading-tight font-medium">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
