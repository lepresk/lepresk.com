@extends('layouts.app')

@section('title', 'Article | Lepres Kikounga')

@section('content')
    <div class="min-h-screen pt-24">
        <article class="container mx-auto px-6 pb-24">
            <div class="mx-auto max-w-4xl">
                <a href="/blog" class="mb-8 inline-flex items-center gap-2 text-sm font-medium text-muted-foreground transition-colors hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>
                    </svg>
                    Retour aux articles
                </a>

                @php
                    $articles = [
                        'scaling-engineering-teams-lessons-learned' => [
                            'title' => 'Scaling Engineering Teams: Lessons Learned',
                            'category' => 'Leadership',
                            'date' => '2025-01-15',
                            'readTime' => '8 min',
                            'image' => '/images/engineering-team-collaboration.png',
                            'content' => "## Introduction\n\nScaling engineering teams is one of the most challenging aspects of technical leadership. Over the years, I've had the opportunity to grow teams from small groups to 50+ engineers, and I've learned valuable lessons along the way.\n\n## Key Principles\n\n### 1. Hire for Culture Add, Not Culture Fit\n\nWhile it's important that new hires align with core values, diversity of thought and experience is crucial for innovation.\n\n### 2. Invest in Onboarding\n\nA structured onboarding process can reduce ramp-up time by 50% and significantly improve retention.\n\n### 3. Create Clear Career Paths\n\nEngineers need to see how they can grow within the organization, both technically and in leadership.\n\n## Conclusion\n\nScaling teams is a continuous learning process. The key is to remain adaptable while maintaining core principles."
                        ],
                        'modern-architecture-patterns-2025' => [
                            'title' => 'Modern Architecture Patterns for 2025',
                            'category' => 'Architecture',
                            'date' => '2024-12-28',
                            'readTime' => '12 min',
                            'image' => '/images/software-architecture-diagram.png',
                            'content' => "## Introduction\n\nThe landscape of software architecture continues to evolve. In 2025, we're seeing a shift towards more distributed, event-driven systems.\n\n## Emerging Patterns\n\n### Event-Driven Architecture\n\nEvent-driven systems allow for better scalability and decoupling of services.\n\n### Microservices Evolution\n\nWe're moving beyond basic microservices to more sophisticated patterns like service mesh and event sourcing.\n\n## Best Practices\n\n- Start simple and evolve\n- Monitor everything\n- Plan for failure\n- Automate operations\n\n## Conclusion\n\nThe future of architecture is distributed, event-driven, and heavily automated."
                        ],
                        'technical-debt-strategic-approach' => [
                            'title' => 'Technical Debt: A Strategic Approach',
                            'category' => 'Strategy',
                            'date' => '2024-12-10',
                            'readTime' => '10 min',
                            'image' => '/images/technical-strategy-planning.jpg',
                            'content' => "## Understanding Technical Debt\n\nTechnical debt isn't inherently bad - it's a tool that needs to be managed strategically.\n\n## When to Take on Debt\n\n- Time-to-market is critical\n- Testing a hypothesis\n- Working with uncertain requirements\n\n## Managing the Debt\n\n### Documentation\n\nAlways document what shortcuts were taken and why.\n\n### Regular Reviews\n\nSchedule quarterly technical debt reviews.\n\n### Prioritization\n\nNot all debt needs to be paid immediately. Focus on high-impact areas.\n\n## Conclusion\n\nTechnical debt is a strategic tool when managed properly."
                        ]
                    ];

                    $article = $articles[$slug] ?? null;
                @endphp

                @if(!$article)
                    <div class="py-24 text-center">
                        <h1 class="mb-4 text-4xl font-bold">Article non trouvé</h1>
                        <p class="text-muted-foreground">Cet article n'existe pas ou a été supprimé.</p>
                    </div>
                @else
                    <div class="mb-8">
                        <span class="mb-4 inline-block rounded-full bg-primary/10 px-4 py-1 text-sm font-medium text-primary">
                            {{ $article['category'] }}
                        </span>
                        <h1 class="mb-6 text-balance font-bold leading-tight tracking-tighter text-4xl md:text-5xl lg:text-6xl">
                            {{ $article['title'] }}
                        </h1>
                        <div class="flex items-center gap-6 text-sm text-muted-foreground">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($article['date'])->isoFormat('D MMMM YYYY') }}
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                </svg>
                                {{ $article['readTime'] }}
                            </div>
                        </div>
                    </div>

                    <div class="relative mb-12 aspect-[21/9] overflow-hidden rounded-2xl">
                        <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="h-full w-full object-cover">
                    </div>

                    <div class="prose prose-lg prose-slate dark:prose-invert max-w-none">
                        {!! Str::markdown($article['content']) !!}
                    </div>
                @endif
            </div>
        </article>
    </div>
@endsection
