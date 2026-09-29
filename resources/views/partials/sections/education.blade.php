<section id="education" class="bg-muted/30 py-32">
    <div class="container mx-auto px-6">
        <div class="mb-16 text-center">
            <div class="mb-4 text-sm font-medium tracking-wider text-muted-foreground">{{ __('education.label') }}</div>
            <h2 class="text-balance font-bold leading-tight tracking-tighter text-4xl md:text-5xl lg:text-6xl">
                {{ __('education.heading') }}
            </h2>
        </div>

        <div class="mx-auto grid max-w-5xl gap-6 md:grid-cols-2">
            @php
                $studies = [
                    [
                        'school' => __('education.columbia.school'),
                        'degree' => __('education.columbia.degree'),
                        'period' => __('education.columbia.period'),
                    ],
                    [
                        'school' => __('education.ead.school'),
                        'degree' => __('education.ead.degree'),
                        'period' => __('education.ead.period'),
                    ],
                ];
            @endphp

            @foreach ($studies as $study)
                <article class="rounded-2xl border border-border bg-card p-8 transition-all duration-300 hover:border-primary/20 hover:shadow-xl">
                    <div class="mb-4 flex items-center gap-2 text-sm text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/>
                        </svg>
                        <span>{{ $study['period'] }}</span>
                    </div>

                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mt-1 text-primary">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
                        </svg>
                        <div>
                            <h3 class="mb-1 text-xl font-bold">{{ $study['school'] }}</h3>
                            <p class="font-medium text-primary">{{ $study['degree'] }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
