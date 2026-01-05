@extends('layouts.app')

@section('title', 'Blog | Lepres Kikounga')

@section('description', 'Réflexions et insights sur le leadership technique, l\'architecture logicielle et la stratégie d\'ingénierie')

@section('content')
    <div class="min-h-screen pt-24">
        <div class="container mx-auto px-6">
            <div class="mb-16 text-center">
                <h1 class="mb-6 text-balance font-bold leading-tight tracking-tighter text-5xl md:text-6xl">Blog</h1>
                <p class="mx-auto max-w-2xl text-pretty text-lg text-muted-foreground">
                    Réflexions et insights sur le leadership technique, l'architecture logicielle et la stratégie d'ingénierie
                </p>
            </div>

            @php
                $allArticles = [
                    [
                        'slug' => 'react-server-components-architecture',
                        'title' => 'React Server Components: Architecture et Bonnes Pratiques',
                        'excerpt' => 'Comment structurer une application moderne avec React Server Components, avec exemples de code concrets.',
                        'date' => '2025-01-20',
                        'readTime' => '15 min',
                        'category' => 'Development',
                        'image' => '/images/software-architecture-diagram.png'
                    ],
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
                    ],
                    [
                        'slug' => 'building-high-performance-teams',
                        'title' => 'Building High-Performance Engineering Teams',
                        'excerpt' => 'Strategies for creating and nurturing teams that consistently deliver exceptional results.',
                        'date' => '2024-11-22',
                        'readTime' => '9 min',
                        'category' => 'Leadership',
                        'image' => '/images/high-performance-team-meeting.jpg'
                    ],
                    [
                        'slug' => 'microservices-vs-monoliths',
                        'title' => 'Microservices vs Monoliths: Making the Right Choice',
                        'excerpt' => 'A pragmatic guide to choosing between microservices and monolithic architecture for your project.',
                        'date' => '2024-11-05',
                        'readTime' => '15 min',
                        'category' => 'Architecture',
                        'image' => '/images/software-architecture-diagram.png'
                    ],
                    [
                        'slug' => 'effective-code-reviews',
                        'title' => 'The Art of Effective Code Reviews',
                        'excerpt' => 'Best practices for conducting code reviews that improve quality without slowing down velocity.',
                        'date' => '2024-10-18',
                        'readTime' => '7 min',
                        'category' => 'Development',
                        'image' => '/images/code-review-collaboration.jpg'
                    ],
                    [
                        'slug' => 'engineering-metrics-that-matter',
                        'title' => 'Engineering Metrics That Actually Matter',
                        'excerpt' => 'Moving beyond vanity metrics to measure what truly impacts engineering effectiveness.',
                        'date' => '2024-10-02',
                        'readTime' => '11 min',
                        'category' => 'Strategy',
                        'image' => '/images/data-analytics-dashboard.png'
                    ],
                    [
                        'slug' => 'continuous-integration-best-practices',
                        'title' => 'Continuous Integration Best Practices',
                        'excerpt' => 'Implementing CI/CD pipelines that accelerate development while maintaining quality standards.',
                        'date' => '2024-09-14',
                        'readTime' => '10 min',
                        'category' => 'DevOps',
                        'image' => '/images/ci-cd-pipeline-visualization.jpg'
                    ],
                    [
                        'slug' => 'engineering-culture-transformation',
                        'title' => 'Transforming Engineering Culture',
                        'excerpt' => 'Practical steps for evolving engineering culture to support growth and innovation.',
                        'date' => '2024-08-28',
                        'readTime' => '13 min',
                        'category' => 'Leadership',
                        'image' => '/images/team-culture-workshop.jpg'
                    ]
                ];
            @endphp

            <div class="grid gap-8 pb-24 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($allArticles as $article)
                    <a href="/blog/{{ $article['slug'] }}" class="group relative block overflow-hidden rounded-2xl border border-border bg-background transition-all duration-300 hover:shadow-2xl hover:border-primary/20">
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

                            <h2 class="mb-3 text-xl font-bold leading-snug transition-colors group-hover:text-primary">
                                {{ $article['title'] }}
                            </h2>

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
        </div>
    </div>
@endsection
