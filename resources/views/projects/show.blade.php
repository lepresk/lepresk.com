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
                        'cowema-marketplace' => [
                            'title' => 'COWEMA Marketplace',
                            'category' => 'Mobile & Web',
                            'tags' => ['Flutter', 'Laravel', 'PostgreSQL'],
                            'image' => '/images/classifieds-app-interface.jpg',
                            'description' => 'E-commerce marketplace serving 30K+ users across Central Africa',
                            'content' => "## The Challenge\n\nIn 2020, e-commerce in Central Africa was fragmented. People relied on WhatsApp groups and Facebook Marketplace to buy and sell—no reliable platform, no payment protection, no search functionality. I co-founded COWEMA to solve this.\n\n## What We Built\n\nA full-stack marketplace platform with mobile apps (Flutter) and web dashboard (Laravel). Users could list products, search with filters, message sellers, and complete transactions—all in one place. We built the entire tech stack from scratch in 6 months.\n\n## Technical Approach\n\n- **Mobile apps**: Flutter for cross-platform (iOS & Android) with a single codebase\n- **Backend**: Laravel API with JWT authentication and role-based access control\n- **Database**: PostgreSQL for transactional data, Redis for caching and real-time features\n- **Search**: Implemented full-text search with indexed queries for product discovery\n- **Messaging**: Real-time chat using WebSockets for buyer-seller communication\n- **Infrastructure**: Deployed on AWS with auto-scaling for traffic spikes\n\n## Key Decisions\n\n1. **Why Flutter?** Needed to ship fast on both platforms with limited team. Flutter let us maintain one codebase.\n2. **Why Laravel?** Rapid API development with built-in auth, queues, and migrations. Allowed us to iterate quickly.\n3. **PostgreSQL over MySQL**: Better JSON support for product attributes and complex queries.\n\n## Results\n\n- Scaled to **30,000+ users** within 2 years\n- **50,000+ product listings** across categories\n- Trained 3 junior developers to senior level during the project\n- Built a vendor management app (VEC) as a companion product\n- Platform handled peak traffic of 5,000+ concurrent users\n\n## What I Learned\n\nScaling from 0 to 30K users teaches you things you can't learn from books. Database optimization matters more than you think. User onboarding is harder than building features. And most importantly: a small team that ships fast beats a large team that plans forever."
                        ],
                        'cowema-vec' => [
                            'title' => 'COWEMA VEC',
                            'category' => 'Mobile',
                            'tags' => ['Flutter', 'Laravel', 'REST API'],
                            'image' => '/images/mobile-marketplace-app-interface.jpg',
                            'description' => 'Vendor management app for marketplace sellers',
                            'content' => "## The Problem\n\nCOWEMA Marketplace sellers were managing hundreds of products from their phones using the customer app—not ideal. They needed dedicated tools: bulk uploads, inventory tracking, sales analytics, order management.\n\n## The Solution\n\nBuilt VEC (Vendor E-Commerce), a companion app specifically for sellers. Think of it as a mobile Shopify dashboard integrated with our marketplace.\n\n## Features\n\n- **Product Management**: Bulk upload products with images, categories, and variants\n- **Inventory Tracking**: Real-time stock levels with low-stock alerts\n- **Order Management**: Process orders, update shipping status, communicate with buyers\n- **Analytics**: Sales trends, top products, revenue tracking\n- **Notifications**: Instant alerts for new orders and customer messages\n\n## Technical Stack\n\n- **Frontend**: Flutter (shared UI components with main marketplace app)\n- **Backend**: Same Laravel API as marketplace, with vendor-specific endpoints\n- **Authentication**: OAuth with role-based permissions (vendors can only see their data)\n- **File Uploads**: S3 for product images with CDN caching\n\n## Implementation Highlights\n\n```dart\n// Shared Flutter widgets between marketplace and VEC\nclass ProductCard extends StatelessWidget {\n  final Product product;\n  final bool isVendorView;\n  \n  // Different actions based on user type\n}\n```\n\n- Reused 60% of codebase between customer and vendor apps\n- Built in 3 months with 2 developers\n- API endpoints secured with vendor-specific middleware\n\n## Impact\n\n- **500+ active vendors** using the app daily\n- Reduced product listing time from 5 minutes to 30 seconds\n- Vendors increased their listings by 3x on average\n- 95% positive feedback from vendor community\n\n## Lessons\n\nBuilding for power users (vendors) is different from building for consumers. They need speed, bulk actions, and keyboard shortcuts. Mobile-first doesn't mean mobile-only—many vendors wanted desktop access. Version 2 should have been web-based."
                        ],
                        'lord-market' => [
                            'title' => 'Lord-Market',
                            'category' => 'Mobile',
                            'tags' => ['Flutter', 'CakePHP', 'MySQL'],
                            'image' => '/images/mobile-marketplace-app-interface.jpg',
                            'description' => 'Mobile marketplace app with real-time messaging',
                            'content' => "## Background\n\nBefore COWEMA, I built Lord-Market as a freelance project in 2018—one of my first full-stack mobile apps. A client needed a marketplace for their local community with integrated chat.\n\n## The Build\n\nSimple concept: people post items for sale, buyers browse and message sellers. The challenge was real-time messaging on a tight budget.\n\n## Technical Stack\n\n- **Mobile**: Flutter for Android (iOS came later)\n- **Backend**: CakePHP (client's preference, they had existing CakePHP apps)\n- **Database**: MySQL for products, users, and messages\n- **Real-time**: Long polling for chat (WebSocket hosting was expensive at the time)\n\n## Features\n\n- Product listings with image uploads\n- Category-based search and filters\n- In-app messaging between buyers and sellers\n- User profiles with ratings and reviews\n- Push notifications for new messages\n- Saved searches and favorites\n\n## Challenges & Solutions\n\n**Challenge**: Real-time chat without WebSockets\n**Solution**: Implemented long polling with 5-second intervals. Not perfect, but worked for the budget.\n\n**Challenge**: Image uploads killing server storage\n**Solution**: Resized images on device before upload, compressed server-side, deleted originals after 30 days for inactive listings.\n\n**Challenge**: Spam and fake listings\n**Solution**: Manual approval for first 3 listings per user, then auto-approve with report system.\n\n## Results\n\n- **10,000+ downloads** on Google Play\n- **4.2★** average rating\n- Active user base for 2+ years before client sunset the project\n- Led to more freelance work and eventually COWEMA\n\n## What I'd Do Differently\n\n- Use Laravel instead of CakePHP (migrations, queues, better docs)\n- Invest in proper WebSocket infrastructure from day one\n- Build admin dashboard earlier (content moderation was manual for too long)\n- Add payment integration (we only did messaging, not transactions)\n\n## Why It Matters\n\nLord-Market was my crash course in building real products. I learned that perfect code doesn't matter if users can't figure out your UI. That caching is not optional. That push notifications are a retention goldmine. These lessons shaped everything I built after."
                        ],
                        'mylibcg' => [
                            'title' => 'MylibCG',
                            'category' => 'Web',
                            'tags' => ['React', 'Node.js', 'MongoDB'],
                            'image' => '/images/software-architecture-diagram.png',
                            'description' => 'Digital library platform for Congolese content',
                            'content' => "## The Vision\n\nA digital library platform to preserve and share Congolese books, research papers, and educational content. Many works exist only in physical form in university libraries—inaccessible to most students.\n\n## What We Built\n\nA web platform where universities and authors can upload, organize, and share digital content. Think Internet Archive meets university library, focused on Congo.\n\n## Technical Architecture\n\n- **Frontend**: React with Redux for state management\n- **Backend**: Node.js with Express for the API\n- **Database**: MongoDB for flexible document storage (books have varied metadata)\n- **File Storage**: Local storage initially, planned S3 migration\n- **Search**: MongoDB text indexes with ranking algorithm\n- **Authentication**: JWT with role-based access (admins, authors, readers)\n\n## Features\n\n### For Readers\n- Browse books by category, author, university\n- Full-text search across metadata\n- Read online or download PDF\n- Bookmark and reading history\n- Responsive design for mobile reading\n\n### For Authors/Universities\n- Upload books with metadata (title, author, year, category)\n- Batch uploads via CSV\n- Analytics: views, downloads, popular content\n- Access control (public, university-only, private)\n\n### For Admins\n- Content moderation and approval\n- User management\n- Platform analytics dashboard\n\n## Technical Decisions\n\n**MongoDB over PostgreSQL**: Books have inconsistent metadata—some have ISBNs, some don't; some have chapters, some don't. MongoDB's flexible schema made sense.\n\n**React over server-side rendering**: Needed a fast, interactive UI for browsing large catalogs. SPA made more sense than traditional MVC.\n\n**Node.js**: Wanted to use JavaScript full-stack. Also, streaming file uploads for large PDFs worked well with Node.\n\n## Implementation Notes\n\n```javascript\n// Streaming large file uploads to prevent memory issues\napp.post('/upload', upload.single('file'), async (req, res) => {\n  const stream = fs.createReadStream(req.file.path);\n  // Process in chunks...\n});\n```\n\n## Current Status\n\n- **Beta version** deployed with 500+ books\n- **3 universities** piloting the platform\n- Working on funding for full launch and S3 migration\n- Future: OCR for scanned documents, citation generator\n\n## Challenges\n\n- **Copyright**: Many books have unclear licensing. Building approval workflow.\n- **File sizes**: PDFs can be 50MB+. Need better compression and streaming.\n- **Discoverability**: Search is basic. Need better categorization and recommendations.\n- **Sustainability**: Who pays for hosting? Exploring institutional partnerships.\n\n## What I Learned\n\nBuilding for social impact is different from building for profit. Users have different priorities (accessibility over features). Funding is harder. But the mission matters more. Seeing students access books they couldn't get before? Worth every bug fix."
                        ],
                        'personal-portfolio' => [
                            'title' => 'Personal Portfolio',
                            'category' => 'Web',
                            'tags' => ['Laravel', 'Tailwind CSS', 'Vite'],
                            'image' => '/images/code-review-collaboration.jpg',
                            'description' => 'Modern portfolio built with Laravel 12 and Tailwind v4',
                            'content' => "## Why Build This?\n\nI needed a professional portfolio to showcase my work, share my experience, and position myself for consulting and leadership roles. Static site generators felt limiting. I wanted full control over content, design, and performance.\n\n## The Stack\n\n- **Laravel 12**: Latest version with streamlined structure, no more Kernel classes\n- **Tailwind CSS v4**: New @import syntax, native cascade layers, better dark mode\n- **Vite**: Lightning-fast builds and hot reload during development\n- **Blade templates**: Server-side rendering for SEO and performance\n- **Vanilla JS**: No React/Vue—keeping it simple for animations and interactions\n\n## Design Goals\n\n1. **Fast**: Sub-second page loads, optimized images, minimal JavaScript\n2. **Clean**: Typography-first design, generous whitespace, clear hierarchy\n3. **Conversational**: Not a CV, not corporate fluff—just honest content\n4. **Dark mode**: Because it's 2026 and people expect it\n5. **Accessible**: Semantic HTML, keyboard navigation, screen reader friendly\n\n## Technical Highlights\n\n### Tailwind v4 Setup\n```css\n@import \"tailwindcss\";\n@plugin '@tailwindcss/typography';\n\n@custom-variant dark (&:is(.dark *));\n\n:root {\n  --primary: oklch(0.48 0.12 168); /* Warm green */\n  --background: oklch(0.99 0 0);\n}\n```\n\n### Markdown Content\nUsing Laravel's `Str::markdown()` helper for blog posts and project details:\n```blade\n<div class=\"prose prose-lg dark:prose-invert\">\n  {!! Str::markdown($article['content']) !!}\n</div>\n```\n\n### Vanilla JS for Theme Toggle\n```javascript\nfunction initTheme() {\n  const theme = localStorage.getItem('theme') || \n    (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');\n  document.documentElement.classList.toggle('dark', theme === 'dark');\n}\n```\n\n## Performance\n\n- **First Contentful Paint**: <1s\n- **Lighthouse Score**: 95+ across all metrics\n- **Image optimization**: WebP format, lazy loading, responsive sizes\n- **CSS**: Single bundled file, ~15KB gzipped\n- **JS**: Minimal, only for interactivity (~5KB)\n\n## Content Strategy\n\n- **Hero**: Clear value proposition (VP Engineering, 10 years)\n- **About**: Conversational tone, specific metrics, no CV copy-paste\n- **Experience**: Outcomes over responsibilities\n- **Projects**: Real work only, no placeholder content\n- **Blog**: Authentic insights from actual experience\n\n## What Makes This Different\n\nMost portfolios are either over-designed (animations everywhere) or under-designed (basic templates). I wanted something in between: clean and professional, but with personality. The content is written like I talk—no corporate speak, no buzzwords.\n\n## Future Improvements\n\n- Add case studies with more technical depth\n- Blog CMS integration for easier content updates\n- Analytics to see what resonates with visitors\n- Contact form with actual backend (currently just a route)\n- Newsletter for sharing technical insights\n\n## The Meta Part\n\nYou're reading this on the portfolio itself. Pretty meta. If you made it this far, you probably care about the details. Let's talk—I'm always interested in connecting with people who care about craft."
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
