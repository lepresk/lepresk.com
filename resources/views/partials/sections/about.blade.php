<section id="about" class="py-32 bg-muted/30">
    <div class="container mx-auto px-6">
        <div class="grid gap-16 lg:grid-cols-2">
            <div>
                <div class="mb-4 text-sm font-medium tracking-wider text-muted-foreground">{{ __('about.label') }}</div>
                <h2 class="mb-8 text-balance font-bold leading-tight tracking-tighter text-4xl md:text-5xl lg:text-6xl">
                    {{ __('about.heading') }}
                </h2>
                <div class="space-y-4 text-pretty text-muted-foreground leading-relaxed">
                    <p>
                        {{ __('about.description_1') }}
                    </p>
                    <p>
                        {{ __('about.description_2') }}
                    </p>
                    <p>
                        {{ __('about.description_3') }}
                    </p>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2 items-start">
                @php
                    $stats = [
                        [
                            'value' => '10',
                            'label' => __('about.stat_years'),
                            'gradient' => 'bg-gradient-to-br from-blue-500 to-blue-600',
                            'icon' => 'medal'
                        ],
                        [
                            'value' => '18+',
                            'label' => __('about.stat_engineers'),
                            'gradient' => 'bg-gradient-to-br from-purple-500 to-purple-600',
                            'icon' => 'users-three'
                        ],
                        [
                            'value' => '30K+',
                            'label' => __('about.stat_users'),
                            'gradient' => 'bg-gradient-to-br from-emerald-500 to-emerald-600',
                            'icon' => 'users'
                        ],
                        [
                            'value' => '10+',
                            'label' => __('about.stat_projects'),
                            'gradient' => 'bg-gradient-to-br from-orange-500 to-orange-600',
                            'icon' => 'briefcase'
                        ]
                    ];
                @endphp

                @foreach ($stats as $index => $stat)
                    <div class="group relative overflow-hidden rounded-3xl shadow-md transition-all duration-500 hover:shadow-lg hover:scale-105 stat-card translate-y-8 opacity-0 min-h-[280px] flex flex-col" style="transition-delay: {{ $index * 100 }}ms">
                        <div class="absolute inset-0 {{ $stat['gradient'] }}"></div>

                        <!-- Decorative pattern SVG -->
                        @if ($stat['icon'] === 'medal')
                            <svg width="100%" height="100%" viewBox="0 0 200 200" class="absolute inset-0 opacity-[0.08]">
                                <circle cx="150" cy="50" r="60" stroke="white" stroke-width="2" fill="none" />
                                <circle cx="180" cy="80" r="40" stroke="white" stroke-width="1.5" fill="none" />
                                <circle cx="120" cy="150" r="30" stroke="white" stroke-width="1" fill="none" />
                                <circle cx="160" cy="120" r="5" fill="white" />
                                <circle cx="140" cy="80" r="4" fill="white" />
                            </svg>
                        @elseif ($stat['icon'] === 'users-three')
                            <svg width="100%" height="100%" viewBox="0 0 200 200" class="absolute inset-0 opacity-[0.08]">
                                <path d="M10 100 L50 80 L90 120 L130 60 L170 90 L200 70" stroke="white" stroke-width="2.5" fill="none" />
                                <path d="M20 130 L60 110 L100 150 L140 90 L180 120" stroke="white" stroke-width="2" fill="none" />
                                <circle cx="50" cy="80" r="4" fill="white" />
                                <circle cx="130" cy="60" r="4" fill="white" />
                                <circle cx="170" cy="90" r="4" fill="white" />
                                <polygon points="180,30 185,40 175,40" fill="white" />
                            </svg>
                        @elseif ($stat['icon'] === 'users')
                            <svg width="100%" height="100%" viewBox="0 0 200 200" class="absolute inset-0 opacity-[0.08]">
                                <rect x="30" y="140" width="25" height="25" stroke="white" stroke-width="2" fill="none" />
                                <rect x="70" y="50" width="20" height="20" stroke="white" stroke-width="1.5" fill="none" transform="rotate(45 80 60)" />
                                <rect x="140" y="110" width="30" height="30" stroke="white" stroke-width="2" fill="none" />
                                <circle cx="160" cy="40" r="15" stroke="white" stroke-width="1.5" fill="none" />
                                <polygon points="40,60 50,70 30,70" fill="white" opacity="0.7" />
                                <polygon points="120,170 130,180 110,180" fill="white" opacity="0.7" />
                            </svg>
                        @else
                            <svg width="100%" height="100%" viewBox="0 0 200 200" class="absolute inset-0 opacity-[0.08]">
                                <path d="M20 180 L20 100 L60 100 L60 140 L100 140 L100 60 L140 60 L140 120 L180 120 L180 40" stroke="white" stroke-width="3" fill="none" stroke-linejoin="round" />
                                <path d="M30 100 L50 80 L70 100 L90 70 L110 90 L130 60 L150 80 L170 50" stroke="white" stroke-width="2" fill="none" />
                                <circle cx="110" cy="90" r="3" fill="white" />
                                <circle cx="150" cy="80" r="3" fill="white" />
                                <circle cx="90" cy="70" r="3" fill="white" />
                            </svg>
                        @endif

                        <div class="relative p-8 flex flex-col items-start">
                            <div class="mb-6 text-white">
                                @if ($stat['icon'] === 'medal')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M216,96A88,88,0,1,0,72,163.83V240a8,8,0,0,0,11.58,7.16L128,225l44.43,22.21A8.07,8.07,0,0,0,176,248a8,8,0,0,0,8-8V163.83A87.85,87.85,0,0,0,216,96ZM56,96a72,72,0,1,1,72,72A72.08,72.08,0,0,1,56,96Zm112,131.06-36.43-18.21a8,8,0,0,0-7.16,0L88,227.06V174.37a87.89,87.89,0,0,0,80,0ZM128,152A56,56,0,1,0,72,96,56.06,56.06,0,0,0,128,152Zm0-96A40,40,0,1,1,88,96,40,40,0,0,1,128,56Z"></path></svg>
                                @elseif ($stat['icon'] === 'users-three')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"></path></svg>
                                @elseif ($stat['icon'] === 'users')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z"></path></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M216,56H176V48a24,24,0,0,0-24-24H104A24,24,0,0,0,80,48v8H40A16,16,0,0,0,24,72V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V72A16,16,0,0,0,216,56ZM96,48a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96ZM216,72v41.61A184,184,0,0,1,128,136a184.07,184.07,0,0,1-88-22.38V72Zm0,128H40V131.64A200.19,200.19,0,0,0,128,152a200.25,200.25,0,0,0,88-20.36V200ZM104,112a8,8,0,0,1,8-8h32a8,8,0,0,1,0,16H112A8,8,0,0,1,104,112Z"></path></svg>
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
