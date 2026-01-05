@extends('layouts.app')

@section('title', 'Projet | Lepres Kikounga')

@section('content')
    <div class="min-h-screen pt-24">
        <article class="container mx-auto px-6 pb-24">
            <div class="mx-auto max-w-6xl">
                <a href="/#projets" class="mb-8 inline-flex items-center gap-2 text-sm font-medium text-muted-foreground transition-colors hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>
                    </svg>
                    Retour aux projets
                </a>

                @php
                    $projects = [
                        'lord-market' => [
                            'title' => 'Lord Market',
                            'category' => 'Mobile',
                            'tags' => ['Flutter', 'Android', 'CakePHP'],
                            'image' => '/images/mobile-marketplace-app-interface.jpg',
                            'description' => 'Marketplace mobile cross-platform',
                            'content' => "Lord Market est une application de marketplace mobile développée avec Flutter et CakePHP. L'application permet aux utilisateurs d'acheter et de vendre des produits directement depuis leur téléphone.\n\n## Fonctionnalités principales\n\n- Recherche de produits avec filtres avancés\n- Système de messagerie intégré\n- Paiement sécurisé\n- Gestion des commandes\n- Notifications push\n\n## Technologies utilisées\n\n- Flutter pour le frontend mobile\n- CakePHP pour l'API backend\n- MySQL pour la base de données\n- Firebase pour les notifications\n\n## Résultats\n\nL'application compte plus de 10 000 téléchargements et une note moyenne de 4.5 étoiles sur le Play Store."
                        ],
                        'shopamusic' => [
                            'title' => 'Shopamusic',
                            'category' => 'Web',
                            'tags' => ['React', 'Node.js', 'WordPress'],
                            'image' => '/images/music-streaming-platform.png',
                            'description' => 'Plateforme de streaming musical',
                            'content' => "Shopamusic est une plateforme de streaming musical innovante qui permet aux artistes africains de partager leur musique avec le monde.\n\n## Fonctionnalités\n\n- Streaming audio haute qualité\n- Playlists personnalisées\n- Recommandations intelligentes\n- Interface utilisateur moderne et responsive\n- Système de gestion pour les artistes\n\n## Stack technique\n\n- React pour l'interface utilisateur\n- Node.js pour l'API\n- WordPress pour le CMS\n- AWS S3 pour le stockage des fichiers audio\n\n## Impact\n\nPlus de 30 000 utilisateurs actifs mensuels et 500+ artistes inscrits."
                        ],
                        'solution-capa' => [
                            'title' => 'Solution CAPA',
                            'category' => 'Mobile & Desktop',
                            'tags' => ['.NET', 'Android', 'PHP'],
                            'image' => '/images/medical-app-interface.png',
                            'description' => 'App médicale pour suivi de grossesse',
                            'content' => "Solution CAPA est une application médicale complète pour le suivi de grossesse, développée pour le ministère de la Santé.\n\n## Fonctionnalités\n\n- Suivi des consultations prénatales\n- Gestion des dossiers patients\n- Système d'alertes et rappels\n- Rapports et statistiques\n- Synchronisation multi-plateforme\n\n## Technologies\n\n- .NET pour l'application desktop\n- Android natif pour l'application mobile\n- PHP pour le backend\n- SQL Server pour la base de données\n\n## Résultats\n\nUtilisé dans plus de 50 centres de santé avec plus de 5 000 dossiers patients gérés."
                        ],
                        'cowema-annonce' => [
                            'title' => 'Cowema Annonce',
                            'category' => 'Mobile',
                            'tags' => ['Flutter', 'PHP', 'Laravel'],
                            'image' => '/images/classifieds-app-interface.jpg',
                            'description' => 'Plateforme de petites annonces',
                            'content' => "Cowema Annonce est une plateforme de petites annonces qui connecte acheteurs et vendeurs au Congo.\n\n## Fonctionnalités\n\n- Publication d'annonces avec photos\n- Recherche géolocalisée\n- Messagerie sécurisée\n- Système de favoris\n- Notifications en temps réel\n\n## Technologies\n\n- Flutter pour l'application mobile\n- Laravel pour l'API\n- MySQL pour la base de données\n- Redis pour le cache\n\n## Impact\n\nPlateforme avec 30 000+ utilisateurs et 50 000+ annonces publiées."
                        ],
                        'freeze' => [
                            'title' => 'Freeze',
                            'category' => 'Desktop',
                            'tags' => ['.NET', 'WPF', 'C#'],
                            'image' => '/images/pos-system-interface.jpg',
                            'description' => 'Logiciel de gestion de caisse et stock',
                            'content' => "Freeze est un système de point de vente (POS) et de gestion de stock complet pour les petites et moyennes entreprises.\n\n## Fonctionnalités\n\n- Gestion des ventes et factures\n- Contrôle du stock en temps réel\n- Rapports financiers détaillés\n- Gestion multi-utilisateurs\n- Interface tactile optimisée\n- Impression des reçus\n\n## Technologies\n\n- WPF pour l'interface utilisateur\n- C# pour la logique métier\n- SQL Server pour la base de données\n- Crystal Reports pour les rapports\n\n## Déploiement\n\nUtilisé par plus de 100 commerces avec un taux de satisfaction de 95%."
                        ]
                    ];

                    $project = $projects[$slug] ?? null;
                @endphp

                @if(!$project)
                    <div class="py-24 text-center">
                        <h1 class="mb-4 text-4xl font-bold">Projet non trouvé</h1>
                        <p class="text-muted-foreground">Ce projet n'existe pas ou a été supprimé.</p>
                    </div>
                @else
                    <div class="mb-8">
                        <span class="mb-4 inline-block rounded-full bg-primary/10 px-4 py-1 text-sm font-medium text-primary">
                            {{ $project['category'] }}
                        </span>
                        <h1 class="mb-6 text-balance font-bold leading-tight tracking-tighter text-4xl md:text-5xl lg:text-6xl">
                            {{ $project['title'] }}
                        </h1>
                        <p class="mb-6 text-xl text-muted-foreground">{{ $project['description'] }}</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($project['tags'] as $tag)
                                <span class="rounded-full bg-primary/10 px-4 py-1.5 text-sm font-medium text-primary">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="relative mb-12 aspect-[21/9] overflow-hidden rounded-2xl">
                        <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" class="h-full w-full object-cover">
                    </div>

                    <div class="prose prose-lg prose-slate dark:prose-invert max-w-none">
                        {!! Str::markdown($project['content']) !!}
                    </div>
                @endif
            </div>
        </article>
    </div>
@endsection
