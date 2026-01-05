<section id="projects" class="bg-muted/30 py-32">
    <div class="container mx-auto px-6">
        <div class="mb-16 text-center">
            <div class="mb-4 text-sm font-medium tracking-wider text-muted-foreground">{{ __('projects.label') }}</div>
            <h2 class="mb-4 text-balance font-bold leading-tight tracking-tighter text-4xl md:text-5xl">
                {{ __('projects.heading') }}
            </h2>
            <p class="mx-auto max-w-2xl text-pretty text-muted-foreground">
                {{ __('projects.description') }}
            </p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @php
                $projects = \App\Models\Work::published()
                    ->with(['categories', 'tags'])
                    ->orderBy('order')
                    ->take(6)
                    ->get();
            @endphp

            @foreach ($projects as $index => $project)
                <a href="{{ route('projects.show', $project->slug) }}" data-project-card data-index="{{ $index }}" class="group relative overflow-hidden rounded-2xl border border-border bg-background transition-all duration-700 hover:shadow-2xl hover:backdrop-blur-xl hover:bg-background/80 hover:border-primary/30 project-card translate-y-12 opacity-0" style="transition-delay: {{ $index * 100 }}ms">
                    <div class="relative aspect-[4/3] overflow-hidden bg-muted">
                        @if($project->featured_image)
                            <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="h-full w-full bg-gradient-to-br from-primary/10 to-primary/5"></div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-background via-background/50 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    </div>

                    <div class="p-6">
                        @if($project->categories->isNotEmpty())
                            <div class="mb-2 text-xs font-medium text-muted-foreground">{{ $project->categories->first()->name }}</div>
                        @endif
                        <h3 class="mb-2 text-xl font-bold">{{ $project->title }}</h3>
                        @if($project->description)
                            <p class="mb-4 text-sm text-muted-foreground">{{ $project->description }}</p>
                        @endif

                        @if($project->tags->isNotEmpty())
                            <div class="flex flex-wrap gap-2">
                                @foreach ($project->tags as $tag)
                                    <span class="rounded-full bg-muted px-3 py-1 text-xs font-medium">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="absolute right-4 top-4 flex h-10 w-10 items-center justify-center rounded-full bg-background opacity-0 shadow-lg transition-all group-hover:opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
