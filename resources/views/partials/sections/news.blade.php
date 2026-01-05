<section id="actualites" class="py-32">
    <div class="container mx-auto px-6">
        <div class="mb-16 flex items-end justify-between">
            <div>
                <div class="mb-4 text-sm font-medium tracking-wider text-muted-foreground">ACTUALITÉS</div>
                <h2 class="mb-4 text-balance font-bold leading-tight tracking-tighter text-4xl md:text-5xl">
                    Dernières publications
                </h2>
                <p class="max-w-2xl text-pretty text-muted-foreground">
                    Réflexions sur le leadership technique, l'architecture et la stratégie d'ingénierie
                </p>
            </div>
            <a href="/blog" class="hidden items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80 md:flex">
                Voir tous les articles
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @php
                $articles = [
                    [
                        'slug' => 'scaling-engineering-teams-lessons-learned',
                        'title' => 'Scaling Engineering Teams: Lessons Learned',
                        'excerpt' => 'Key insights from growing engineering teams from 5 to 50+ members while maintaining velocity and quality.',
                        'date' => '2025-01-15',
                        'readTime' => '8 min',
                        'category' => 'Leadership',
                        'image' => '/images/engineering-team-collaboration.png'
                    ],
                    [
                        'slug' => 'modern-architecture-patterns-2025',
                        'title' => 'Modern Architecture Patterns for 2025',
                        'excerpt' => 'Exploring microservices, event-driven architectures, and the shift towards distributed systems.',
                        'date' => '2024-12-28',
                        'readTime' => '12 min',
                        'category' => 'Architecture',
                        'image' => '/images/software-architecture-diagram.png'
                    ],
                    [
                        'slug' => 'technical-debt-strategic-approach',
                        'title' => 'Technical Debt: A Strategic Approach',
                        'excerpt' => 'How to balance innovation with maintenance and make data-driven decisions about technical debt.',
                        'date' => '2024-12-10',
                        'readTime' => '10 min',
                        'category' => 'Strategy',
                        'image' => '/images/technical-strategy-planning.jpg'
                    ]
                ];
            @endphp

            @foreach ($articles as $index => $article)
                <a href="/blog/{{ $article['slug'] }}" data-article-card data-index="{{ $index }}" class="group relative block overflow-hidden rounded-2xl border border-border bg-background transition-all duration-700 hover:shadow-2xl hover:border-primary/20 hover:backdrop-blur-xl hover:bg-background/80 article-card translate-y-12 opacity-0" style="transition-delay: {{ $index * 100 }}ms">
                    <div class="relative aspect-[16/10] overflow-hidden bg-muted">
                        <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-transparent opacity-60"></div>
                        <div class="absolute bottom-4 left-4">
                            <span class="rounded-full bg-primary/90 px-3 py-1 text-xs font-medium text-primary-foreground backdrop-blur-sm">
                                {{ $article['category'] }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="mb-3 flex items-center gap-4 text-xs text-muted-foreground">
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($article['date'])->isoFormat('D MMMM YYYY') }}
                            </div>
                            <span>•</span>
                            <span>{{ $article['readTime'] }}</span>
                        </div>

                        <h3 class="mb-3 text-xl font-bold leading-snug transition-colors group-hover:text-primary">
                            {{ $article['title'] }}
                        </h3>

                        <p class="text-sm text-muted-foreground leading-relaxed">{{ $article['excerpt'] }}</p>

                        <div class="mt-4 flex items-center gap-2 text-sm font-medium text-primary">
                            Lire l'article
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:translate-x-1">
                                <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8 text-center md:hidden">
            <a href="/blog" class="inline-flex items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80">
                Voir tous les articles
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>
