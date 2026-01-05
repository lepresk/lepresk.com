<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Work;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

final class MigrateExistingContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create categories
        $categories = $this->createCategories();

        // 2. Migrate blog posts
        $this->migrateBlogPosts($categories);

        // 3. Migrate portfolio works
        $this->migrateWorks($categories);
    }

    private function createCategories(): array
    {
        $categoryData = [
            // Blog categories
            ['name' => 'Leadership', 'slug' => 'leadership', 'type' => 'post'],
            ['name' => 'Architecture', 'slug' => 'architecture', 'type' => 'post'],
            ['name' => 'Strategy', 'slug' => 'strategy', 'type' => 'post'],
            ['name' => 'Development', 'slug' => 'development', 'type' => 'post'],
            ['name' => 'DevOps', 'slug' => 'devops', 'type' => 'post'],

            // Work categories
            ['name' => 'Mobile & Web', 'slug' => 'mobile-web', 'type' => 'work'],
            ['name' => 'Mobile', 'slug' => 'mobile', 'type' => 'work'],
            ['name' => 'Web', 'slug' => 'web', 'type' => 'work'],
        ];

        $categories = [];
        foreach ($categoryData as $data) {
            $categories[$data['slug']] = Category::create($data);
        }

        return $categories;
    }

    private function migrateBlogPosts(array $categories): void
    {
        $posts = [
            [
                'title' => 'React Server Components: Architecture et Bonnes Pratiques',
                'slug' => 'react-server-components-architecture',
                'excerpt' => 'Comment structurer une application moderne avec React Server Components, avec exemples de code concrets.',
                'content' => "React Server Components represent a paradigm shift in how we build React applications. This guide covers the architecture patterns and best practices I've learned while implementing RSC in production.\n\n## Understanding Server Components\n\nServer Components run on the server and never ship JavaScript to the client. This means zero bundle size impact for code that doesn't need interactivity.\n\n## Key Patterns\n\n### Data Fetching\n\nFetch data directly in Server Components without useEffect:\n\n```jsx\nasync function UserProfile({ userId }) {\n  const user = await db.user.findUnique({ where: { id: userId } });\n  return <div>{user.name}</div>;\n}\n```\n\n### Composition\n\nCompose Server and Client Components strategically. Keep client boundaries small.\n\n## Best Practices\n\n1. Use Server Components by default\n2. Only use 'use client' when you need interactivity\n3. Fetch data at the component level, not in layouts\n4. Pass serializable props between Server and Client Components\n\n## Performance Wins\n\nBy moving data fetching to the server, we reduced our Time to Interactive by 40% and bundle size by 30%.",
                'category' => 'development',
                'date' => '2025-01-20',
                'readTime' => '15 min',
                'image' => '/images/software-architecture-diagram.png',
            ],
            [
                'title' => 'Scaling Engineering Teams: Lessons Learned',
                'slug' => 'scaling-engineering-teams-lessons-learned',
                'excerpt' => 'Key insights from growing engineering teams from 5 to 50+ members while maintaining velocity and quality.',
                'content' => "I've scaled engineering teams from 5 to 11+ people at Akieni, trained 3 junior developers to senior level at COWEMA within a year, and learned what works (and what doesn't) the hard way. Here's what I wish I knew earlier.\n\n## The Biggest Mistake: Hiring Too Fast\n\nWhen the team was overwhelmed, my first instinct was to hire. More people = more output, right? Wrong.\n\nI hired 4 developers in 2 months. Onboarding became chaos. Code reviews slowed down. We spent more time explaining context than shipping features. Velocity actually *decreased*.\n\n**What I learned**: Hire in batches of 1-2, with at least 2 months between hires. Give the team time to absorb new members before adding more.\n\n## What Actually Scales Teams\n\n### 1. Structured Onboarding (Not Just a Wiki)\n\nI used to send new hires a Notion doc and say \"ask if you have questions.\" Nobody asked questions. They struggled silently for weeks.\n\nNow I do:\n- **Week 1**: Pair programming with a senior dev (no solo work)\n- **Week 2**: First PR with heavy guidance\n- **Week 3**: Small feature end-to-end\n- **Month 1 review**: Explicit feedback, not \"you're doing fine\"\n\nResult: New hires are productive in 3 weeks instead of 2 months.\n\n### 2. Career Paths That Actually Exist\n\nAt COWEMA, I promoted 3 juniors to senior level. How? I told them exactly what \"senior\" meant:\n- Lead a feature from design to deployment\n- Mentor another developer\n- Participate in architecture decisions\n\nThen I gave them opportunities to do those things. With feedback. No surprises.\n\nCompare that to: \"You'll be senior when you're ready.\" (Translation: never.)\n\n### 3. Process That Doesn't Suck\n\nI've seen teams drown in process (daily standups, sprint planning, retrospectives, roadmap reviews...) and teams with zero process (chaos).\n\nWhat works for me:\n- **Daily async updates** (written, 5 minutes, in Slack). No standing meetings unless blocked.\n- **Weekly 1-on-1s** with each person (30 min, no status updates, just career/blockers)\n- **Sprint planning** only when priorities change (not every 2 weeks for the sake of it)\n- **Retrospectives** when something goes wrong, not on a schedule\n\nLess overhead, more shipping.\n\n## The Hard Part: Letting Go\n\nAs the team grew, I tried to review every PR, attend every planning meeting, approve every decision. I became the bottleneck.\n\n**The shift**: I stopped asking \"Can I trust this person to do X?\" and started asking \"What do they need to do X without me?\"\n\nExample: Backend decisions used to go through me. Now we have a tech spec template, and senior devs approve specs. I review outcomes, not every line of code.\n\nResult: I unblocked the team and got time back for actual strategic work.\n\n## What Success Looks Like\n\nYou know you've scaled successfully when:\n- Junior devs ship features without hand-holding\n- The team onboards new people without you being involved\n- You can take a week off and nothing breaks\n- People make decisions that align with the vision (even when you're not in the room)\n\n## Bottom Line\n\nScaling teams isn't about hiring fast or adding process. It's about:\n1. Hiring intentionally (not desperately)\n2. Onboarding systematically (not \"figure it out\")\n3. Growing people explicitly (not \"they'll figure it out\")\n4. Trusting the team (and giving them tools to succeed)\n\nIf I had to do it again, I'd hire slower, document better, and delegate sooner. The team would've been more effective, and I would've been less burned out.",
                'category' => 'leadership',
                'date' => '2025-01-15',
                'readTime' => '8 min',
                'image' => '/images/engineering-team-collaboration.png',
            ],
            [
                'title' => 'Modern Architecture Patterns for 2025',
                'slug' => 'modern-architecture-patterns-2025',
                'excerpt' => 'Exploring microservices, event-driven architectures, and the shift towards distributed systems.',
                'content' => "I've migrated legacy infrastructure to AWS with Kubernetes, built microservices that actually made sense, and also built microservices that were a terrible idea. Here's what's working in 2025 based on real experience, not conference talks.\n\n## The Monolith vs Microservices Debate is Over\n\nSpoiler: **Start with a monolith.** Always.\n\nI've seen teams (including mine) jump straight to microservices because \"that's what Netflix does.\" Result? 12 services for 500 users. Deployment hell. Distributed tracing nightmares. Debugging that makes you question your career choices.\n\n**What works**: Build a well-structured monolith first. Use modules, clear boundaries, separate databases if you want. Then extract services *when you have a reason*:\n- This module needs different scaling (high traffic, different SLA)\n- Different teams own different parts\n- You're actually big enough to justify the operational cost\n\nWe did this at Akieni. Started with a Laravel monolith. Extracted a Node.js service for real-time features (WebSockets). Extracted another for background jobs (RabbitMQ). The rest stayed in the monolith. It works.\n\n## Kubernetes: You Probably Don't Need It (But If You Do...)\n\nKubernetes is incredible. It's also overkill for 90% of projects.\n\n**When you don't need it**:\n- You have <10 services\n- Traffic is predictable\n- You don't need auto-scaling\n- Your team hasn't managed Kubernetes before\n\n**When you do need it** (our case at Akieni):\n- Multiple services with different scaling needs\n- Need HA (high availability) and zero-downtime deploys\n- Traffic spikes are unpredictable\n- You have someone who knows Kubernetes (or budget to learn)\n\nWe migrated to Kubernetes and achieved:\n- **99.9% uptime** (previously 99.5%)\n- **Auto-scaling** during peak traffic (saved us during a viral moment)\n- **Reduced costs** by $1.5K/month (optimized resource allocation)\n\nBut it took 3 months to migrate and 2 months to stabilize. Not free.\n\n## Event-Driven Architecture (When It Makes Sense)\n\nEvent-driven systems are great when:\n1. Different parts of your system need to react to the same event\n2. You need eventual consistency (not immediate)\n3. You want to decouple services\n\n**Example from COWEMA**: When a product is listed:\n- Inventory service updates stock\n- Search service indexes the product\n- Notification service alerts followers\n- Analytics service logs the event\n\nWithout events, the \"create product\" endpoint would call 4 services (slow, brittle). With events (RabbitMQ), we publish once, subscribers react independently.\n\n**But** events add complexity:\n- Debugging is harder (\"where did this event come from?\")\n- Ordering is tricky (event A must happen before event B)\n- Failed events need retry logic\n\nUse events when the benefits outweigh the complexity.\n\n## Database Patterns That Actually Work\n\n### One Database per Service (Microservices)\n\nIf you're doing microservices, give each service its own database. Shared databases defeat the purpose.\n\n**Our setup**:\n- User service → PostgreSQL (relational user data)\n- Product service → PostgreSQL (transactional data)\n- Search service → Elasticsearch (optimized for search)\n- Analytics service → MongoDB (flexible schema for events)\n\nYes, this means data duplication. That's fine. Use events to keep things in sync.\n\n### Read Replicas for Performance\n\nWe had slow queries killing our main database. Solution: **read replicas**.\n\n- Writes go to primary database\n- Reads (90% of queries) go to replicas\n- Replicas are geographically distributed for lower latency\n\nResult: 3x faster queries, primary database stopped melting.\n\n## CI/CD: Automate Everything\n\nManual deploys are a crime in 2025. Here's our pipeline:\n\n1. **Push to GitHub** → triggers CI\n2. **Run tests** (unit, integration, linting)\n3. **Build Docker images** if tests pass\n4. **Deploy to staging** automatically\n5. **Run E2E tests** in staging\n6. **Deploy to production** with approval (manual for now, will automate)\n\nDeploys went from 2 hours (manual) to 15 minutes (automated). Rollbacks are one click.\n\n**Tools**: GitHub Actions for CI, Kubernetes for deployment, ArgoCD for GitOps.\n\n## Monitoring: You Can't Fix What You Can't See\n\nWe used to debug by looking at logs. \"Let me SSH into the server and grep...\" Pain.\n\nNow:\n- **Metrics**: Prometheus + Grafana (CPU, memory, request rates)\n- **Logs**: Centralized logging (ELK stack)\n- **Tracing**: Distributed tracing for microservices (Jaeger)\n- **Alerts**: PagerDuty for critical issues (database down, API errors >5%)\n\nWhen something breaks, I know *what*, *where*, and *why* in under 2 minutes.\n\n## What I'd Do Differently\n\n**Start simpler**: We over-engineered early. Should've stayed with monolith longer.\n\n**Invest in observability sooner**: We added monitoring after problems. Should've been day one.\n\n**Document architecture decisions**: Future me (and future team) needed to know *why* we chose X over Y.\n\n## Bottom Line\n\nModern architecture isn't about using the latest tech. It's about:\n1. **Starting simple** (monoliths are fine)\n2. **Scaling when needed** (not prematurely)\n3. **Automating operations** (CI/CD, monitoring, alerts)\n4. **Choosing tools that match your scale** (Kubernetes for 100 users? No.)\n\nBuild for today's problems, not Netflix's problems.",
                'category' => 'architecture',
                'date' => '2024-12-28',
                'readTime' => '12 min',
                'image' => '/images/software-architecture-diagram.png',
            ],
            [
                'title' => 'Technical Debt: A Strategic Approach',
                'slug' => 'technical-debt-strategic-approach',
                'excerpt' => 'How to balance innovation with maintenance and make data-driven decisions about technical debt.',
                'content' => "Technical debt gets a bad reputation. Managers hear \"technical debt\" and think \"engineers want to rewrite everything for fun.\" Engineers hear \"ship fast\" and think \"management doesn't care about quality.\" Both are wrong.\n\nI've shipped features with intentional debt (and it was the right call). I've also let debt accumulate until it killed velocity. Here's how to think about technical debt strategically.\n\n## Not All Debt is Bad\n\nWhen I built COWEMA Marketplace, we had 6 months to launch or lose funding. We made deliberate trade-offs:\n\n**Debt we took on**:\n- Skipped multi-language support (hardcoded French)\n- No admin dashboard (managed data via database directly)\n- Minimal test coverage (focused on critical paths)\n- Basic search (no filters, just keyword matching)\n\n**Result**: Shipped on time, got users, secured funding.\n\n**Debt we paid later**:\n- Added admin dashboard when manual DB edits became unsustainable (month 3)\n- Improved search when users complained (month 5)\n- Added tests when bugs started breaking production (month 6)\n\nIf we'd built everything \"properly\" from the start, we'd have run out of money before launching.\n\n## When to Take on Debt (Intentionally)\n\n### 1. Time-to-Market is Critical\n\nExample: A competitor announced a similar feature. We had 2 weeks to ship or lose our edge.\n\n**Fast approach**: Hardcoded logic, skipped edge cases, deployed.\n\n**Proper approach**: Generic solution, handled all edge cases, 6 weeks.\n\nWe shipped fast. Won the users. Refactored later.\n\n### 2. You're Testing a Hypothesis\n\nAt Lord-Market, we added a \"favorites\" feature. Would users use it? No idea.\n\n**Fast approach**: Stored favorites in local storage (client-side). 2 days.\n\n**Proper approach**: Backend API, database, sync across devices. 2 weeks.\n\nWe shipped the fast version. Users loved it. *Then* we built it properly with backend sync.\n\nIf users hadn't used it, we'd have deleted 100 lines of code instead of a whole backend feature.\n\n### 3. Requirements Are Uncertain\n\nEarly COWEMA, we weren't sure how product categories should work. Build a complex taxonomy system? Or keep it simple?\n\nWe kept it simple (flat categories). Learned from user behavior. Built the taxonomy later when we understood the actual need.\n\n## When Debt Becomes a Problem\n\n### Warning Sign #1: \"We Can't Ship Without Breaking Something\"\n\nAt one point, every deployment to COWEMA broke something. Why? No tests, tightly coupled code, no staging environment.\n\n**Fix**: Stopped all features for 2 weeks. Added critical tests, set up staging, decoupled core modules.\n\nVelocity dropped short-term, but we could ship confidently after.\n\n### Warning Sign #2: \"New Features Take 3x Longer Than They Should\"\n\nAdding a simple feature (\"show related products\") took 2 weeks because:\n- Product model was a mess (20 random fields, no clear structure)\n- No proper API for product queries\n- Frontend was tightly coupled to backend structure\n\n**Fix**: Refactored product model, built a clean API, introduced a data layer.\n\nNext similar feature took 2 days instead of 2 weeks.\n\n### Warning Sign #3: \"Only One Person Can Touch This Code\"\n\nIf a critical part of the system is \"owned\" by one person and nobody else dares touch it, that's debt.\n\nAt COWEMA, the payment module was like this. Only I understood it. Bus factor of 1.\n\n**Fix**: Pair programming sessions, documentation, code review, refactoring for clarity.\n\n## How to Manage Debt Strategically\n\n### 1. Write It Down\n\nWhen you take on debt, document it:\n\n```markdown\n// TODO: Hardcoded for French. Add i18n when we expand to other countries.\n// See ticket #342 for context.\n```\n\nWhy you took the shortcut matters. Future you (or future team) will thank you.\n\n### 2. Track It Like Features\n\nWe use a \"Tech Debt\" board in Jira. Every intentional shortcut gets a ticket with:\n- What we skipped\n- Why we skipped it\n- Impact (low/medium/high)\n- When to revisit\n\nDebt isn't invisible. It's tracked, prioritized, and addressed.\n\n### 3. Budget Time for Paydown\n\nAt Akieni, we allocate **20% of sprint capacity to tech debt**. Not \"if we have time\" (we never do). It's planned.\n\nThis prevents debt from piling up until it's a crisis.\n\n### 4. Prioritize by Pain, Not Perfection\n\nNot all debt needs fixing. Focus on:\n- **High-pain debt**: Slows down development, causes bugs\n- **High-leverage debt**: Fixing it unlocks future work\n\nIgnore:\n- **Low-pain debt**: Ugly code that works fine\n- **Speculative debt**: \"We might need to scale this someday\"\n\n## Real Example: Refactoring the Product Search\n\nCOWEMA's search was bad. Basic keyword matching, no filters, slow queries.\n\n**Option 1**: Rewrite with Elasticsearch (2 months)\n\n**Option 2**: Optimize existing search with indexes and better queries (1 week)\n\nWe chose Option 2. It solved 80% of the pain for 20% of the effort.\n\nWhen we scaled to 50K+ products, *then* we moved to Elasticsearch.\n\n## Bottom Line\n\nTechnical debt isn't good or bad. It's a trade-off.\n\n**Good debt**:\n- Taken intentionally\n- Documented\n- Paid down before it compounds\n\n**Bad debt**:\n- Taken accidentally (\"we didn't know better\")\n- Ignored until it's a crisis\n- Never prioritized\n\n**The goal isn't zero debt**. It's managing debt strategically—knowing when to take it on, when to pay it down, and when to ignore it.\n\nShip fast when it matters. Refactor when it hurts. Don't rewrite for perfection.",
                'category' => 'strategy',
                'date' => '2024-12-10',
                'readTime' => '10 min',
                'image' => '/images/technical-strategy-planning.jpg',
            ],
            [
                'title' => 'Building High-Performance Engineering Teams',
                'slug' => 'building-high-performance-teams',
                'excerpt' => 'Strategies for creating and nurturing teams that consistently deliver exceptional results.',
                'content' => "Building a high-performance engineering team is about creating an environment where engineers thrive, collaborate effectively, and consistently deliver exceptional results.\n\n## Key Principles\n\n### Clear Vision and Goals\nEvery team member should understand not just what they're building, but why it matters and how it fits into the bigger picture.\n\n### Psychological Safety\nTeam members must feel safe to take risks, make mistakes, and speak up when something isn't right.\n\n### Continuous Learning\nInvest in your team's growth through mentorship, training, and exposure to new technologies and methodologies.\n\n### Effective Communication\nEstablish clear communication channels and encourage open, honest dialogue across all levels.\n\n### Ownership and Autonomy\nGive teams ownership of their work and the autonomy to make decisions about how to achieve their goals.\n\n## Practical Implementation\n\nFocus on outcomes over output, celebrate wins and learn from failures, and regularly solicit feedback to improve team dynamics and processes.",
                'category' => 'leadership',
                'date' => '2024-11-22',
                'readTime' => '9 min',
                'image' => '/images/high-performance-team-meeting.jpg',
            ],
            [
                'title' => 'Microservices vs Monoliths: Making the Right Choice',
                'slug' => 'microservices-vs-monoliths',
                'excerpt' => 'A pragmatic guide to choosing between microservices and monolithic architecture for your project.',
                'content' => "The microservices vs monolith debate often generates more heat than light. The truth is: both architectures have their place.\n\n## When Monoliths Make Sense\n\n- Small to medium teams\n- Product/market fit not yet proven\n- Simple deployment requirements\n- Limited operational complexity tolerance\n- Need to move fast and iterate quickly\n\n## When Microservices Make Sense\n\n- Large, distributed teams\n- Different parts need different scaling characteristics\n- Clear service boundaries exist\n- Team has microservices expertise\n- Can handle operational overhead\n\n## The Hybrid Approach\n\nStart with a well-structured monolith. Extract services only when you have a compelling reason—not because it's trendy.\n\n## Common Pitfalls\n\nDon't split too early, don't underestimate operational complexity, and ensure your team has the necessary skills and tooling before committing to microservices.",
                'category' => 'architecture',
                'date' => '2024-11-05',
                'readTime' => '15 min',
                'image' => '/images/software-architecture-diagram.png',
            ],
            [
                'title' => 'The Art of Effective Code Reviews',
                'slug' => 'effective-code-reviews',
                'excerpt' => 'Best practices for conducting code reviews that improve quality without slowing down velocity.',
                'content' => "Code reviews are one of the most powerful tools for maintaining code quality and spreading knowledge across the team.\n\n## Core Principles\n\n### Be Kind and Constructive\nCritique the code, not the person. Frame feedback as suggestions rather than demands.\n\n### Focus on What Matters\nPrioritize issues by importance: correctness > security > maintainability > style.\n\n### Timely Reviews\nReview promptly to keep momentum. Aim for same-day turnaround on small PRs.\n\n### Ask Questions\nInstead of stating \"This is wrong,\" ask \"What's the reason for this approach?\"\n\n## Practical Guidelines\n\n1. Keep PRs small and focused\n2. Use automated tools for style and basic checks\n3. Provide specific, actionable feedback\n4. Celebrate good code and clever solutions\n5. Document patterns and decisions\n\n## Anti-Patterns to Avoid\n\n- Nitpicking on style when you have linters\n- Blocking PRs for minor issues\n- Rewriting code to match your personal style\n- Leaving vague comments like \"This could be better\"\n\nEffective code reviews build better software and stronger teams.",
                'category' => 'development',
                'date' => '2024-10-18',
                'readTime' => '7 min',
                'image' => '/images/code-review-collaboration.jpg',
            ],
            [
                'title' => 'Engineering Metrics That Actually Matter',
                'slug' => 'engineering-metrics-that-matter',
                'excerpt' => 'Moving beyond vanity metrics to measure what truly impacts engineering effectiveness.',
                'content' => "Not all metrics are created equal. Some provide actionable insights, others just look good on dashboards.\n\n## Metrics to Track\n\n### Deployment Frequency\nHow often does code reach production? Higher frequency usually indicates better processes.\n\n### Lead Time for Changes\nTime from code commit to production deployment. Lower is better.\n\n### Mean Time to Recovery (MTTR)\nHow quickly can you recover from production incidents?\n\n### Change Failure Rate\nPercentage of deployments causing production issues.\n\n### Cycle Time\nTime from starting work to deployment. Identifies bottlenecks.\n\n## Vanity Metrics to Avoid\n\n- Lines of code written\n- Number of commits\n- Hours worked\n- Story points completed (without context)\n\n## Making Metrics Actionable\n\nUse metrics to start conversations, not end them. Look for trends, not absolutes. And remember: metrics should inform decisions, not make them.\n\nThe goal is continuous improvement, not hitting arbitrary targets.",
                'category' => 'strategy',
                'date' => '2024-10-02',
                'readTime' => '11 min',
                'image' => '/images/data-analytics-dashboard.png',
            ],
            [
                'title' => 'Continuous Integration Best Practices',
                'slug' => 'continuous-integration-best-practices',
                'excerpt' => 'Implementing CI/CD pipelines that accelerate development while maintaining quality standards.',
                'content' => "Continuous Integration is about integrating code frequently and catching issues early through automated testing.\n\n## Core CI/CD Principles\n\n### Commit Often\nSmall, frequent commits are easier to review and debug than large, infrequent ones.\n\n### Automate Everything\nIf it can be automated, it should be. Tests, builds, deployments, security scans.\n\n### Fast Feedback\nKeep build times under 10 minutes. Developers shouldn't wait.\n\n### Fail Fast\nRun quick tests first, expensive ones later.\n\n## Pipeline Structure\n\n1. Lint and format checks (30 seconds)\n2. Unit tests (2-3 minutes)\n3. Integration tests (5-8 minutes)\n4. Build artifacts\n5. Deploy to staging\n6. Run E2E tests\n7. Deploy to production (with approval)\n\n## Best Practices\n\n- Keep the main branch deployable\n- Fix broken builds immediately\n- Use feature flags for incomplete features\n- Automate rollbacks\n- Monitor deployments\n\n## Tools and Technologies\n\nGitHub Actions, GitLab CI, CircleCI, Jenkins—pick one that fits your workflow and stick with it.\n\nGood CI/CD transforms how teams work.",
                'category' => 'devops',
                'date' => '2024-09-14',
                'readTime' => '10 min',
                'image' => '/images/ci-cd-pipeline-visualization.jpg',
            ],
            [
                'title' => 'Transforming Engineering Culture',
                'slug' => 'engineering-culture-transformation',
                'excerpt' => 'Practical steps for evolving engineering culture to support growth and innovation.',
                'content' => "Culture isn't about foosball tables and free snacks. It's about shared values, behaviors, and how work gets done.\n\n## Elements of Strong Engineering Culture\n\n### Trust and Transparency\nShare information openly. Trust teams to make good decisions.\n\n### Learning from Failure\nBlameless postmortems turn incidents into learning opportunities.\n\n### Quality and Craft\nPride in the work. Balance speed with sustainability.\n\n### Collaboration\nBreak down silos. Encourage cross-functional work.\n\n### Continuous Improvement\nRegularly reflect and adapt processes.\n\n## Driving Culture Change\n\n### Lead by Example\nLeaders must embody the culture they want to see.\n\n### Make it Safe\nPeople won't change if they fear consequences.\n\n### Celebrate Wins\nRecognize behaviors that align with desired culture.\n\n### Be Patient\nCulture change takes time. Measure in quarters, not weeks.\n\n## Common Pitfalls\n\n- Declaring culture change without changing behavior\n- Inconsistent messages from leadership\n- Ignoring systemic issues\n- Moving too fast or too slow\n\n## Measuring Success\n\nLook for: increased psychological safety, faster decision-making, better retention, more innovation, and higher engagement scores.\n\nCulture is your competitive advantage. Invest in it.",
                'category' => 'leadership',
                'date' => '2024-08-28',
                'readTime' => '13 min',
                'image' => '/images/team-culture-workshop.jpg',
            ],
        ];

        foreach ($posts as $postData) {
            $categorySlug = mb_strtolower($postData['category']);
            $category = $categories[$categorySlug] ?? null;
            unset($postData['category']);

            $post = Post::create([
                'title' => $postData['title'],
                'slug' => $postData['slug'],
                'excerpt' => $postData['excerpt'],
                'content' => $postData['content'],
                'featured_image' => $postData['image'],
                'read_time' => $postData['readTime'],
                'status' => 'published',
                'published_at' => $postData['date'],
            ]);

            if ($category) {
                $post->categories()->attach($category);
            }
        }
    }

    private function migrateWorks(array $categories): void
    {
        $works = [
            [
                'title' => 'COWEMA Marketplace',
                'slug' => 'cowema-marketplace',
                'description' => 'E-commerce marketplace serving 30K+ users across Central Africa',
                'content' => "## The Challenge\n\nIn 2020, e-commerce in Central Africa was fragmented. People relied on WhatsApp groups and Facebook Marketplace to buy and sell—no reliable platform, no payment protection, no search functionality. I co-founded COWEMA to solve this.\n\n## What We Built\n\nA full-stack marketplace platform with mobile apps (Flutter) and web dashboard (Laravel). Users could list products, search with filters, message sellers, and complete transactions—all in one place. We built the entire tech stack from scratch in 6 months.\n\n## Technical Approach\n\n- **Mobile apps**: Flutter for cross-platform (iOS & Android) with a single codebase\n- **Backend**: Laravel API with JWT authentication and role-based access control\n- **Database**: PostgreSQL for transactional data, Redis for caching and real-time features\n- **Search**: Implemented full-text search with indexed queries for product discovery\n- **Messaging**: Real-time chat using WebSockets for buyer-seller communication\n- **Infrastructure**: Deployed on AWS with auto-scaling for traffic spikes\n\n## Key Decisions\n\n1. **Why Flutter?** Needed to ship fast on both platforms with limited team. Flutter let us maintain one codebase.\n2. **Why Laravel?** Rapid API development with built-in auth, queues, and migrations. Allowed us to iterate quickly.\n3. **PostgreSQL over MySQL**: Better JSON support for product attributes and complex queries.\n\n## Results\n\n- Scaled to **30,000+ users** within 2 years\n- **50,000+ product listings** across categories\n- Trained 3 junior developers to senior level during the project\n- Built a vendor management app (VEC) as a companion product\n- Platform handled peak traffic of 5,000+ concurrent users\n\n## What I Learned\n\nScaling from 0 to 30K users teaches you things you can't learn from books. Database optimization matters more than you think. User onboarding is harder than building features. And most importantly: a small team that ships fast beats a large team that plans forever.",
                'category' => 'mobile-web',
                'tags' => ['Flutter', 'Laravel', 'PostgreSQL'],
                'image' => '/images/classifieds-app-interface.jpg',
                'order' => 1,
                'date' => '2024-01-01',
            ],
            [
                'title' => 'COWEMA VEC',
                'slug' => 'cowema-vec',
                'description' => 'Vendor management app for marketplace sellers',
                'content' => "## The Problem\n\nCOWEMA Marketplace sellers were managing hundreds of products from their phones using the customer app—not ideal. They needed dedicated tools: bulk uploads, inventory tracking, sales analytics, order management.\n\n## The Solution\n\nBuilt VEC (Vendor E-Commerce), a companion app specifically for sellers. Think of it as a mobile Shopify dashboard integrated with our marketplace.\n\n## Features\n\n- **Product Management**: Bulk upload products with images, categories, and variants\n- **Inventory Tracking**: Real-time stock levels with low-stock alerts\n- **Order Management**: Process orders, update shipping status, communicate with buyers\n- **Analytics**: Sales trends, top products, revenue tracking\n- **Notifications**: Instant alerts for new orders and customer messages\n\n## Technical Stack\n\n- **Frontend**: Flutter (shared UI components with main marketplace app)\n- **Backend**: Same Laravel API as marketplace, with vendor-specific endpoints\n- **Authentication**: OAuth with role-based permissions (vendors can only see their data)\n- **File Uploads**: S3 for product images with CDN caching\n\n## Implementation Highlights\n\n```dart\n// Shared Flutter widgets between marketplace and VEC\nclass ProductCard extends StatelessWidget {\n  final Product product;\n  final bool isVendorView;\n  \n  // Different actions based on user type\n}\n```\n\n- Reused 60% of codebase between customer and vendor apps\n- Built in 3 months with 2 developers\n- API endpoints secured with vendor-specific middleware\n\n## Impact\n\n- **500+ active vendors** using the app daily\n- Reduced product listing time from 5 minutes to 30 seconds\n- Vendors increased their listings by 3x on average\n- 95% positive feedback from vendor community\n\n## Lessons\n\nBuilding for power users (vendors) is different from building for consumers. They need speed, bulk actions, and keyboard shortcuts. Mobile-first doesn't mean mobile-only—many vendors wanted desktop access. Version 2 should have been web-based.",
                'category' => 'mobile',
                'tags' => ['Flutter', 'Laravel', 'REST API'],
                'image' => '/images/mobile-marketplace-app-interface.jpg',
                'order' => 2,
                'date' => '2023-01-01',
            ],
            [
                'title' => 'Lord-Market',
                'slug' => 'lord-market',
                'description' => 'Mobile marketplace app with real-time messaging',
                'content' => "## Background\n\nBefore COWEMA, I built Lord-Market as a freelance project in 2018—one of my first full-stack mobile apps. A client needed a marketplace for their local community with integrated chat.\n\n## The Build\n\nSimple concept: people post items for sale, buyers browse and message sellers. The challenge was real-time messaging on a tight budget.\n\n## Technical Stack\n\n- **Mobile**: Flutter for Android (iOS came later)\n- **Backend**: CakePHP (client's preference, they had existing CakePHP apps)\n- **Database**: MySQL for products, users, and messages\n- **Real-time**: Long polling for chat (WebSocket hosting was expensive at the time)\n\n## Features\n\n- Product listings with image uploads\n- Category-based search and filters\n- In-app messaging between buyers and sellers\n- User profiles with ratings and reviews\n- Push notifications for new messages\n- Saved searches and favorites\n\n## Challenges & Solutions\n\n**Challenge**: Real-time chat without WebSockets\n**Solution**: Implemented long polling with 5-second intervals. Not perfect, but worked for the budget.\n\n**Challenge**: Image uploads killing server storage\n**Solution**: Resized images on device before upload, compressed server-side, deleted originals after 30 days for inactive listings.\n\n**Challenge**: Spam and fake listings\n**Solution**: Manual approval for first 3 listings per user, then auto-approve with report system.\n\n## Results\n\n- **10,000+ downloads** on Google Play\n- **4.2★** average rating\n- Active user base for 2+ years before client sunset the project\n- Led to more freelance work and eventually COWEMA\n\n## What I'd Do Differently\n\n- Use Laravel instead of CakePHP (migrations, queues, better docs)\n- Invest in proper WebSocket infrastructure from day one\n- Build admin dashboard earlier (content moderation was manual for too long)\n- Add payment integration (we only did messaging, not transactions)\n\n## Why It Matters\n\nLord-Market was my crash course in building real products. I learned that perfect code doesn't matter if users can't figure out your UI. That caching is not optional. That push notifications are a retention goldmine. These lessons shaped everything I built after.",
                'category' => 'mobile',
                'tags' => ['Flutter', 'CakePHP', 'MySQL'],
                'image' => '/images/mobile-marketplace-app-interface.jpg',
                'order' => 3,
                'date' => '2022-01-01',
            ],
            [
                'title' => 'MylibCG',
                'slug' => 'mylibcg',
                'description' => 'Digital library platform for Congolese content',
                'content' => "## The Vision\n\nA digital library platform to preserve and share Congolese books, research papers, and educational content. Many works exist only in physical form in university libraries—inaccessible to most students.\n\n## What We Built\n\nA web platform where universities and authors can upload, organize, and share digital content. Think Internet Archive meets university library, focused on Congo.\n\n## Technical Architecture\n\n- **Frontend**: React with Redux for state management\n- **Backend**: Node.js with Express for the API\n- **Database**: MongoDB for flexible document storage (books have varied metadata)\n- **File Storage**: Local storage initially, planned S3 migration\n- **Search**: MongoDB text indexes with ranking algorithm\n- **Authentication**: JWT with role-based access (admins, authors, readers)\n\n## Features\n\n### For Readers\n- Browse books by category, author, university\n- Full-text search across metadata\n- Read online or download PDF\n- Bookmark and reading history\n- Responsive design for mobile reading\n\n### For Authors/Universities\n- Upload books with metadata (title, author, year, category)\n- Batch uploads via CSV\n- Analytics: views, downloads, popular content\n- Access control (public, university-only, private)\n\n### For Admins\n- Content moderation and approval\n- User management\n- Platform analytics dashboard\n\n## Technical Decisions\n\n**MongoDB over PostgreSQL**: Books have inconsistent metadata—some have ISBNs, some don't; some have chapters, some don't. MongoDB's flexible schema made sense.\n\n**React over server-side rendering**: Needed a fast, interactive UI for browsing large catalogs. SPA made more sense than traditional MVC.\n\n**Node.js**: Wanted to use JavaScript full-stack. Also, streaming file uploads for large PDFs worked well with Node.\n\n## Implementation Notes\n\n```javascript\n// Streaming large file uploads to prevent memory issues\napp.post('/upload', upload.single('file'), async (req, res) => {\n  const stream = fs.createReadStream(req.file.path);\n  // Process in chunks...\n});\n```\n\n## Current Status\n\n- **Beta version** deployed with 500+ books\n- **3 universities** piloting the platform\n- Working on funding for full launch and S3 migration\n- Future: OCR for scanned documents, citation generator\n\n## Challenges\n\n- **Copyright**: Many books have unclear licensing. Building approval workflow.\n- **File sizes**: PDFs can be 50MB+. Need better compression and streaming.\n- **Discoverability**: Search is basic. Need better categorization and recommendations.\n- **Sustainability**: Who pays for hosting? Exploring institutional partnerships.\n\n## What I Learned\n\nBuilding for social impact is different from building for profit. Users have different priorities (accessibility over features). Funding is harder. But the mission matters more. Seeing students access books they couldn't get before? Worth every bug fix.",
                'category' => 'web',
                'tags' => ['React', 'Node.js', 'MongoDB'],
                'image' => '/images/software-architecture-diagram.png',
                'order' => 4,
                'date' => '2021-01-01',
            ],
            [
                'title' => 'Personal Portfolio',
                'slug' => 'personal-portfolio',
                'description' => 'Modern portfolio built with Laravel 12 and Tailwind v4',
                'content' => "## Why Build This?\n\nI needed a professional portfolio to showcase my work, share my experience, and position myself for consulting and leadership roles. Static site generators felt limiting. I wanted full control over content, design, and performance.\n\n## The Stack\n\n- **Laravel 12**: Latest version with streamlined structure, no more Kernel classes\n- **Tailwind CSS v4**: New @import syntax, native cascade layers, better dark mode\n- **Vite**: Lightning-fast builds and hot reload during development\n- **Blade templates**: Server-side rendering for SEO and performance\n- **Vanilla JS**: No React/Vue—keeping it simple for animations and interactions\n\n## Design Goals\n\n1. **Fast**: Sub-second page loads, optimized images, minimal JavaScript\n2. **Clean**: Typography-first design, generous whitespace, clear hierarchy\n3. **Conversational**: Not a CV, not corporate fluff—just honest content\n4. **Dark mode**: Because it's 2026 and people expect it\n5. **Accessible**: Semantic HTML, keyboard navigation, screen reader friendly\n\n## Technical Highlights\n\n### Tailwind v4 Setup\n```css\n@import \"tailwindcss\";\n@plugin '@tailwindcss/typography';\n\n@custom-variant dark (&:is(.dark *));\n\n:root {\n  --primary: oklch(0.48 0.12 168); /* Warm green */\n  --background: oklch(0.99 0 0);\n}\n```\n\n### Markdown Content\nUsing Laravel's `Str::markdown()` helper for blog posts and project details:\n```php\n<div class=\"prose prose-lg dark:prose-invert\">\n  {!! Str::markdown(\$article['content']) !!}\n</div>\n```\n\n### Vanilla JS for Theme Toggle\n```javascript\nfunction initTheme() {\n  const theme = localStorage.getItem('theme') || \n    (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');\n  document.documentElement.classList.toggle('dark', theme === 'dark');\n}\n```\n\n## Performance\n\n- **First Contentful Paint**: <1s\n- **Lighthouse Score**: 95+ across all metrics\n- **Image optimization**: WebP format, lazy loading, responsive sizes\n- **CSS**: Single bundled file, ~15KB gzipped\n- **JS**: Minimal, only for interactivity (~5KB)\n\n## Content Strategy\n\n- **Hero**: Clear value proposition (VP Engineering, 10 years)\n- **About**: Conversational tone, specific metrics, no CV copy-paste\n- **Experience**: Outcomes over responsibilities\n- **Projects**: Real work only, no placeholder content\n- **Blog**: Authentic insights from actual experience\n\n## What Makes This Different\n\nMost portfolios are either over-designed (animations everywhere) or under-designed (basic templates). I wanted something in between: clean and professional, but with personality. The content is written like I talk—no corporate speak, no buzzwords.\n\n## Future Improvements\n\n- Add case studies with more technical depth\n- Blog CMS integration for easier content updates\n- Analytics to see what resonates with visitors\n- Contact form with actual backend (currently just a route)\n- Newsletter for sharing technical insights\n\n## The Meta Part\n\nYou're reading this on the portfolio itself. Pretty meta. If you made it this far, you probably care about the details. Let's talk—I'm always interested in connecting with people who care about craft.",
                'category' => 'web',
                'tags' => ['Laravel', 'Tailwind CSS', 'Vite'],
                'image' => '/images/code-review-collaboration.jpg',
                'order' => 5,
                'date' => '2025-01-01',
            ],
        ];

        foreach ($works as $workData) {
            $categorySlug = $workData['category'];
            $tags = $workData['tags'];
            $category = $categories[$categorySlug] ?? null;
            unset($workData['category'], $workData['tags']);

            $work = Work::create([
                'title' => $workData['title'],
                'slug' => $workData['slug'],
                'description' => $workData['description'],
                'content' => $workData['content'],
                'featured_image' => $workData['image'],
                'status' => 'published',
                'published_at' => $workData['date'],
                'order' => $workData['order'],
            ]);

            if ($category) {
                $work->categories()->attach($category);
            }

            // Create and attach tags
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(
                    ['name' => $tagName],
                    ['slug' => Str::slug($tagName)]
                );
                $work->tags()->attach($tag);
            }
        }
    }
}
