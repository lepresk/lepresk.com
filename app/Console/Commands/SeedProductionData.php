<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Work;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

final class SeedProductionData extends Command
{
    protected $signature = 'seed:production {--fresh : Delete existing data before seeding}';

    protected $description = 'Seed production data with professional content';

    public function handle(): int
    {
        if ($this->option('fresh')) {
            $this->info('Clearing existing data...');
            DB::table('taggables')->delete();
            DB::table('category_post')->delete();
            DB::table('category_work')->delete();
            Post::query()->forceDelete();
            Work::query()->forceDelete();
            Category::query()->delete();
            Tag::query()->delete();
            $this->info('✓ Data cleared');
        }

        $this->info('Starting production data seeding...');

        $this->seedCategories();
        $this->seedTags();
        $this->seedPosts();
        $this->seedWorks();

        $this->newLine();
        $this->info('✓ Production data seeded successfully!');

        return self::SUCCESS;
    }

    private function seedCategories(): void
    {
        $this->info('Seeding categories...');

        $categories = [
            // Post categories
            ['name' => 'Laravel', 'type' => 'post', 'description' => 'Articles about Laravel framework, best practices, and tutorials'],
            ['name' => 'PHP', 'type' => 'post', 'description' => 'PHP programming language tips, tricks, and insights'],
            ['name' => 'Architecture', 'type' => 'post', 'description' => 'Software architecture patterns and system design'],
            ['name' => 'DevOps', 'type' => 'post', 'description' => 'DevOps practices, CI/CD, and infrastructure'],
            ['name' => 'Leadership', 'type' => 'post', 'description' => 'Engineering leadership and team management'],
            ['name' => 'Mobile Development', 'type' => 'post', 'description' => 'Mobile app development with Flutter, Kotlin, and React Native'],

            // Work categories
            ['name' => 'E-Commerce', 'type' => 'work', 'description' => 'E-commerce platforms and marketplace solutions'],
            ['name' => 'Enterprise', 'type' => 'work', 'description' => 'Enterprise-grade systems and applications'],
            ['name' => 'Mobile Apps', 'type' => 'work', 'description' => 'Mobile applications for Android and iOS'],
            ['name' => 'Web Applications', 'type' => 'work', 'description' => 'Modern web applications and platforms'],
        ];

        foreach ($categories as $category) {
            Category::query()->create($category);
        }

        $this->info('✓ Categories seeded');
    }

    private function seedTags(): void
    {
        $this->info('Seeding tags...');

        $tags = [
            'Laravel', 'PHP', 'ASP.NET Core', 'Node.js', 'React', 'Flutter',
            'Kotlin', 'Docker', 'CI/CD', 'API',
            'Microservices', 'Architecture', 'Leadership', 'Team Building',
            'Mobile', 'Web', 'Backend', 'Frontend', 'Full-Stack',
            'E-Commerce', 'Enterprise', 'Tutorial', 'Best Practices',
        ];

        foreach ($tags as $tag) {
            Tag::query()->create(['name' => $tag]);
        }

        $this->info('✓ Tags seeded');
    }

    private function seedPosts(): void
    {
        $this->info('Seeding blog posts...');

        $posts = $this->getPostsData();

        foreach ($posts as $postData) {
            $post = Post::query()->create([
                'title' => $postData['title'],
                'excerpt' => $postData['excerpt'],
                'content' => $postData['content'],
                'status' => 'published',
                'published_at' => now()->subDays($postData['days_ago']),
                'read_time' => $postData['read_time'],
                'meta_title' => $postData['title'],
                'meta_description' => $postData['excerpt'],
            ]);

            // Attach categories
            $categories = Category::forPosts()->whereIn('name', $postData['categories'])->get();
            $post->categories()->attach($categories);

            // Attach tags
            $tags = Tag::query()->whereIn('name', $postData['tags'])->get();
            $post->tags()->attach($tags);
        }

        $this->info('✓ Blog posts seeded');
    }

    private function seedWorks(): void
    {
        $this->info('Seeding portfolio works...');

        $works = $this->getWorksData();

        foreach ($works as $index => $workData) {
            $work = Work::query()->create([
                'title' => $workData['title'],
                'description' => $workData['description'],
                'content' => $workData['content'],
                'status' => 'published',
                'published_at' => now()->subDays($workData['days_ago']),
                'order' => $index + 1,
                'meta_title' => $workData['title'],
                'meta_description' => $workData['description'],
            ]);

            // Attach categories
            $categories = Category::forWorks()->whereIn('name', $workData['categories'])->get();
            $work->categories()->attach($categories);

            // Attach tags
            $tags = Tag::query()->whereIn('name', $workData['tags'])->get();
            $work->tags()->attach($tags);
        }

        $this->info('✓ Portfolio works seeded');
    }

    /**
     * @return array<int, array{title: string, excerpt: string, read_time: string, days_ago: int, categories: list<string>, tags: list<string>, content: string}>
     */
    private function getPostsData(): array
    {
        return [
            [
                'title' => 'Scaling Engineering Teams: Lessons from 7 to 17+ Engineers',
                'excerpt' => 'Practical insights from scaling an engineering team at Akieni, covering recruitment, processes, and maintaining code quality during rapid growth.',
                'read_time' => '8 min read',
                'days_ago' => 5,
                'categories' => ['Leadership'],
                'tags' => ['Leadership', 'Team Building', 'Best Practices'],
                'content' => <<<'MARKDOWN'
# Scaling Engineering Teams: Lessons from 7 to 17+ Engineers

Over the past year at Akieni, I've had the privilege of scaling our engineering team from 7 to over 17 engineers across Backend, Frontend, Mobile, and DevOps. This journey taught me invaluable lessons about team building, process optimization, and maintaining quality during rapid growth.

## The Challenge

When I joined as Engineering Manager in April 2024, we had a critical enterprise system that had been stalled for over 2 years. The team was small, processes were informal, and we needed to scale quickly without sacrificing quality.

## Key Strategies

### 1. Structured Hiring Process

We implemented a rigorous but efficient hiring process:
- Technical assessment tailored to the role
- Pair programming sessions to assess collaboration
- Cultural fit interviews with multiple team members
- Clear evaluation criteria

This helped us maintain quality while scaling quickly.

### 2. Engineering Processes

We established clear processes early:
- Code review standards
- Git workflow and branching strategy
- CI/CD pipelines for automated testing
- Documentation requirements

### 3. Mentorship Program

One of our most successful initiatives was integrating Academy talent with structured mentorship:
- Pairing junior developers with seniors
- Weekly 1-on-1s for feedback
- Clear learning paths and goals
- Regular knowledge sharing sessions

## Results

Within 10 months:
- Delivered the stalled enterprise system
- Reduced infrastructure costs by 21%
- Achieved 99.9% uptime with Kubernetes
- Successfully onboarded 10+ new engineers
- Built integration middleware for government services

## Key Takeaways

**Start with processes, not people.** Before scaling, establish clear engineering processes. It's much harder to retrofit processes after the team has grown.

**Invest in mentorship.** Senior engineers spending time mentoring juniors pays dividends. We saw 2 junior developers reach mid-level within 18 months.

**Document everything.** As teams grow, tribal knowledge becomes a bottleneck. We made documentation a first-class citizen.

**Maintain code quality.** Fast growth can lead to technical debt. We enforced code reviews and automated testing from day one.

**Communicate constantly.** Regular all-hands, team syncs, and 1-on-1s kept everyone aligned as we grew.

## Conclusion

Scaling a team is challenging, but with the right processes, culture, and focus on quality, it's incredibly rewarding. The key is to be intentional about how you grow and never compromise on the fundamentals.

If you're facing similar challenges, I'd love to hear about your experience. What worked for you? What would you do differently?
MARKDOWN
            ],

            [
                'title' => 'Integrating OneSignal Push Notifications in Laravel',
                'excerpt' => 'A complete guide to implementing OneSignal push notifications in your Laravel application with practical examples and best practices.',
                'read_time' => '6 min read',
                'days_ago' => 15,
                'categories' => ['Laravel', 'PHP'],
                'tags' => ['Laravel', 'PHP', 'API', 'Tutorial'],
                'content' => <<<'MARKDOWN'
# Integrating OneSignal Push Notifications in Laravel

Push notifications are essential for modern web applications. They keep users engaged and informed about important updates. In this guide, I'll show you how to integrate OneSignal with Laravel.

## Why OneSignal?

OneSignal is a powerful, free push notification service that supports:
- Web Push (Chrome, Firefox, Safari)
- Mobile Push (iOS, Android)
- In-App Messages
- Email notifications

It's reliable, scalable, and has a generous free tier perfect for most applications.

## Installation

First, install the OneSignal PHP SDK:

```bash
composer require onesignal/onesignal-php-api
```

## Configuration

Add your OneSignal credentials to `.env`:

```env
ONESIGNAL_APP_ID=your_app_id
ONESIGNAL_REST_API_KEY=your_rest_api_key
```

Create a configuration file `config/onesignal.php`:

```php
<?php

return [
    'app_id' => env('ONESIGNAL_APP_ID'),
    'rest_api_key' => env('ONESIGNAL_REST_API_KEY'),
];
```

## Creating a Notification Service

Create a service to handle OneSignal operations:

```php
<?php

namespace App\Services;

use OneSignal\OneSignal;

class PushNotificationService
{
    protected OneSignal $client;

    public function __construct()
    {
        $this->client = new OneSignal(
            config('onesignal.app_id'),
            config('onesignal.rest_api_key')
        );
    }

    public function sendToUser(string $userId, string $message, array $data = []): void
    {
        $this->client->notifications->create([
            'contents' => ['en' => $message],
            'include_external_user_ids' => [$userId],
            'data' => $data,
        ]);
    }

    public function sendToAll(string $message, array $data = []): void
    {
        $this->client->notifications->create([
            'contents' => ['en' => $message],
            'included_segments' => ['All'],
            'data' => $data,
        ]);
    }
}
```

## Usage in Controllers

```php
use App\Services\PushNotificationService;

class OrderController extends Controller
{
    public function __construct(
        protected PushNotificationService $pushNotification
    ) {}

    public function store(Request $request)
    {
        $order = Order::create($request->validated());

        $this->pushNotification->sendToUser(
            $order->user_id,
            "Your order #{$order->id} has been confirmed!",
            ['order_id' => $order->id]
        );

        return response()->json($order);
    }
}
```

## Laravel Notifications

For a more Laravel-native approach, create a notification channel:

```php
<?php

namespace App\Notifications\Channels;

use App\Services\PushNotificationService;
use Illuminate\Notifications\Notification;

class OneSignalChannel
{
    public function __construct(
        protected PushNotificationService $pushNotification
    ) {}

    public function send($notifiable, Notification $notification): void
    {
        $message = $notification->toOneSignal($notifiable);

        $this->pushNotification->sendToUser(
            $notifiable->onesignal_id,
            $message['body'],
            $message['data'] ?? []
        );
    }
}
```

Then use it in your notifications:

```php
<?php

namespace App\Notifications;

use App\Notifications\Channels\OneSignalChannel;
use Illuminate\Notifications\Notification;

class OrderShipped extends Notification
{
    public function via($notifiable): array
    {
        return [OneSignalChannel::class, 'mail'];
    }

    public function toOneSignal($notifiable): array
    {
        return [
            'body' => 'Your order has been shipped!',
            'data' => [
                'order_id' => $this->order->id,
                'tracking_number' => $this->order->tracking_number,
            ],
        ];
    }
}
```

## Best Practices

1. **Queue notifications**: Always queue push notifications to avoid blocking requests
2. **Handle failures gracefully**: Wrap OneSignal calls in try-catch blocks
3. **Personalize messages**: Use user data to make notifications relevant
4. **Test thoroughly**: Use OneSignal's test mode before going live
5. **Monitor delivery**: Check OneSignal dashboard for delivery rates

## Conclusion

OneSignal makes it easy to add push notifications to Laravel apps. With proper implementation and best practices, you can significantly improve user engagement.

The code examples above provide a solid foundation. Customize them based on your specific needs and enjoy better user engagement!
MARKDOWN
            ],

            [
                'title' => 'Building High-Availability Systems with Kubernetes',
                'excerpt' => 'How we achieved 99.9% uptime by architecting a Kubernetes-based high-availability platform for enterprise systems.',
                'read_time' => '10 min read',
                'days_ago' => 25,
                'categories' => ['Architecture', 'DevOps'],
                'tags' => ['Kubernetes', 'AWS', 'Architecture', 'DevOps', 'CI/CD'],
                'content' => <<<'MARKDOWN'
# Building High-Availability Systems with Kubernetes

At Akieni, we needed to deliver a critical enterprise system that required 99.9% uptime. Here's how we architected a robust, highly-available platform using Kubernetes on AWS.

## The Requirements

Our enterprise client had strict requirements:
- 99.9% uptime SLA (max 43 minutes downtime per month)
- Handle 10,000+ concurrent users
- Zero-downtime deployments
- Automatic failover and recovery
- Data persistence and backup

## Architecture Overview

We designed a multi-tier architecture on AWS:

### Infrastructure Layer
- **AWS EKS**: Managed Kubernetes cluster
- **Multi-AZ deployment**: Resources spread across 3 availability zones
- **Auto-scaling**: Horizontal Pod Autoscaler (HPA) and Cluster Autoscaler
- **Load balancing**: AWS Application Load Balancer

### Application Layer
- **Stateless services**: API servers, workers
- **Stateful services**: Databases, caching
- **Service mesh**: Istio for advanced traffic management
- **Monitoring**: Prometheus + Grafana

### Data Layer
- **RDS Multi-AZ**: PostgreSQL with automatic failover
- **ElastiCache Redis**: Clustered mode for high availability
- **S3**: For object storage with versioning

## Key Implementation Details

### 1. Pod Disruption Budgets

We configured PDBs to ensure minimum replicas during updates:

```yaml
apiVersion: policy/v1
kind: PodDisruptionBudget
metadata:
  name: api-pdb
spec:
  minAvailable: 2
  selector:
    matchLabels:
      app: api
```

### 2. Health Checks

Robust liveness and readiness probes:

```yaml
livenessProbe:
  httpGet:
    path: /health
    port: 8080
  initialDelaySeconds: 30
  periodSeconds: 10

readinessProbe:
  httpGet:
    path: /ready
    port: 8080
  initialDelaySeconds: 5
  periodSeconds: 5
```

### 3. Resource Management

Proper resource requests and limits prevent cascading failures:

```yaml
resources:
  requests:
    memory: "256Mi"
    cpu: "250m"
  limits:
    memory: "512Mi"
    cpu: "500m"
```

### 4. Rolling Updates

Zero-downtime deployments with careful rollout strategy:

```yaml
strategy:
  type: RollingUpdate
  rollingUpdate:
    maxSurge: 1
    maxUnavailable: 0
```

## Monitoring and Alerting

### Prometheus Metrics

We monitored:
- Pod availability and restarts
- Request latency (p50, p95, p99)
- Error rates
- Resource utilization
- Database connection pool

### Alerting Rules

Critical alerts for:
- Pod crash loops
- High error rates (>1%)
- Latency degradation
- Resource exhaustion

## Disaster Recovery

### Backup Strategy
- **Database**: Automated daily backups with point-in-time recovery
- **Configuration**: GitOps with ArgoCD
- **Secrets**: AWS Secrets Manager with rotation

### Failover Testing
Monthly chaos engineering exercises:
- Random pod termination
- Node failure simulation
- Network partition tests
- Database failover drills

## Results

After 10 months in production:
- **Actual uptime**: 99.95% (exceeded SLA)
- **Deployment frequency**: 3-5 deploys per day
- **Mean time to recovery**: < 5 minutes
- **Zero data loss incidents**
- **Infrastructure costs reduced 21%** through optimization

## Lessons Learned

1. **Start simple**: Don't over-engineer initially. Add complexity as needed.

2. **Automate everything**: Manual processes are error-prone and slow.

3. **Test failures**: Regularly test your disaster recovery procedures.

4. **Monitor proactively**: Don't wait for users to report issues.

5. **Document thoroughly**: When incidents happen at 2 AM, documentation is critical.

## Conclusion

Building high-availability systems requires careful planning, robust architecture, and continuous monitoring. Kubernetes provides the tools, but success depends on how you use them.

The investment in proper HA architecture paid off—our client has complete confidence in the system's reliability, and our team sleeps better at night.

What's your experience with high-availability systems? I'd love to hear your stories and lessons learned.
MARKDOWN
            ],

            [
                'title' => 'Migrating Legacy PHP to Modern Laravel Architecture',
                'excerpt' => 'A step-by-step approach to migrating legacy PHP codebases to modern Laravel while maintaining business continuity.',
                'read_time' => '12 min read',
                'days_ago' => 40,
                'categories' => ['Laravel', 'PHP', 'Architecture'],
                'tags' => ['Laravel', 'PHP', 'Architecture', 'Best Practices'],
                'content' => <<<'MARKDOWN'
# Migrating Legacy PHP to Modern Laravel Architecture

Legacy PHP applications can be daunting. At Akieni, I led the migration of a critical system from procedural PHP to modern Laravel. Here's our systematic approach that minimized risk and downtime.

## The Situation

The legacy system:
- 10+ years old procedural PHP
- No framework, no tests
- MySQL queries scattered throughout
- Global variables and mixed concerns
- Business-critical with 5,000+ daily users

## Migration Strategy

We adopted the **Strangler Fig Pattern**: gradually replace parts of the legacy system while keeping it running.

### Phase 1: Preparation (2 weeks)

**1. Set up Laravel alongside legacy code**
```
/public
  /legacy    # Old PHP files
  /index.php # Laravel entry point
```

**2. Configure routing**
```php
// Legacy catch-all route
Route::fallback(function (Request $request) {
    $path = public_path('legacy' . $request->path() . '.php');
    if (file_exists($path)) {
        return response()->file($path);
    }
    abort(404);
});
```

**3. Database connection**
```php
// config/database.php
'legacy' => [
    'driver' => 'mysql',
    'host' => env('LEGACY_DB_HOST'),
    'database' => env('LEGACY_DB_DATABASE'),
    // ...
],
```

### Phase 2: Database Migration (3 weeks)

**1. Analyze existing schema**
```bash
php artisan db:inspect legacy
```

**2. Create Laravel migrations**
```php
// Match existing structure exactly
Schema::create('users', function (Blueprint $table) {
    $table->integer('user_id')->primary(); // Match legacy naming
    $table->string('username', 50);
    // ... existing columns
    $table->timestamps(); // Add for new features
});
```

**3. Create Eloquent models**
```php
class User extends Model
{
    protected $connection = 'legacy';
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    // Gradually add relationships
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }
}
```

### Phase 3: API Layer (4 weeks)

We built a new API layer in Laravel while legacy frontend continued working:

```php
// API that legacy code can call
Route::prefix('api/v1')->group(function () {
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('orders', [OrderController::class, 'store']);
});
```

**Legacy PHP calling new API:**
```php
// In legacy code
function createOrder($data) {
    $response = file_get_contents(
        '/api/v1/orders',
        false,
        stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($data)
            ]
        ])
    );
    return json_decode($response, true);
}
```

### Phase 4: Service Layer (6 weeks)

Extract business logic into Laravel services:

```php
class OrderService
{
    public function createOrder(User $user, array $items): Order
    {
        return DB::transaction(function () use ($user, $items) {
            $order = Order::create([
                'user_id' => $user->user_id,
                'total' => $this->calculateTotal($items),
                'status' => 'pending',
            ]);

            foreach ($items as $item) {
                $order->items()->create($item);
            }

            // Legacy notification (gradually replace)
            $this->sendOrderEmail($order);

            return $order;
        });
    }
}
```

### Phase 5: Frontend Migration (8 weeks)

Rebuilt frontend using Laravel Blade + Livewire:

**Route by route replacement:**
```php
// New route takes precedence
Route::get('/dashboard', DashboardController::class);

// Legacy fallback still works
Route::fallback(/* ... */);
```

**Shared authentication:**
```php
// AuthService bridges legacy and Laravel auth
class AuthService
{
    public function loginLegacyUser(int $userId): void
    {
        $user = User::find($userId);
        Auth::login($user);

        // Maintain legacy session
        $_SESSION['user_id'] = $userId;
    }
}
```

### Phase 6: Testing & Validation (Continuous)

**1. Add tests incrementally**
```php
test('order creation updates inventory', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create(['stock' => 10]);

    $order = $this->orderService->createOrder($user, [
        ['product_id' => $product->id, 'quantity' => 2]
    ]);

    expect($product->fresh()->stock)->toBe(8);
});
```

**2. Run parallel for validation**
- Run new code alongside legacy
- Compare outputs
- Log discrepancies
- Fix before switching over

**3. Feature flags**
```php
if (Feature::active('new-checkout')) {
    return $this->newCheckoutService->process($cart);
}
return $this->legacyCheckout($cart);
```

## Results

After 6 months:
- ✅ 100% features migrated
- ✅ 800+ tests written
- ✅ 40% faster page loads
- ✅ Zero data loss
- ✅ 50% reduction in bugs

## Key Takeaways

**1. Never "big bang" rewrite**: Incremental migration reduces risk dramatically.

**2. Maintain backward compatibility**: Users shouldn't notice the migration.

**3. Test religiously**: Tests are your safety net during migration.

**4. Run parallel temporarily**: Validate new code against legacy output.

**5. Document everything**: Future maintainers will thank you.

**6. Keep business involved**: Regular demos maintain stakeholder confidence.

## Common Pitfalls to Avoid

❌ Trying to "improve" functionality during migration
❌ Not maintaining legacy codebase during migration
❌ Migrating without understanding existing behavior
❌ Insufficient testing before switching over
❌ Not planning for rollback scenarios

## Conclusion

Legacy migrations are challenging but manageable with a systematic approach. The Strangler Fig Pattern, combined with comprehensive testing and gradual rollout, minimizes risk while modernizing your codebase.

If you're facing a similar challenge, start small, test thoroughly, and be patient. The results are worth it.

Questions about legacy migrations? Drop them in the comments!
MARKDOWN
            ],

            [
                'title' => 'MTN Mobile Money Integration in PHP: Complete Guide',
                'excerpt' => 'Step-by-step tutorial for integrating MTN Mobile Money payment gateway into your PHP application with code examples.',
                'read_time' => '5 min read',
                'days_ago' => 50,
                'categories' => ['PHP'],
                'tags' => ['PHP', 'API', 'Tutorial'],
                'content' => <<<'MARKDOWN'
# MTN Mobile Money Integration in PHP: Complete Guide

Mobile money is essential for applications in Africa. This guide shows you how to integrate MTN Mobile Money into your PHP application.

## Prerequisites

- PHP 8.1+
- Composer
- MTN Mobile Money API credentials
- HTTPS endpoint for callbacks

## Getting Started

### 1. API Credentials

Sign up for MTN Mobile Money API access:
1. Visit MTN Developer Portal
2. Create an application
3. Get your API key and subscription key
4. Configure callback URLs

### 2. Install Dependencies

```bash
composer require guzzlehttp/guzzle
```

## Implementation

### MTN MoMo Service Class

```php
<?php

namespace App\Services\Payment;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class MTNMoMoService
{
    protected Client $client;
    protected string $apiKey;
    protected string $subscriptionKey;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.mtn.api_key');
        $this->subscriptionKey = config('services.mtn.subscription_key');
        $this->baseUrl = config('services.mtn.base_url');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 30,
        ]);
    }

    /**
     * Request payment from customer
     */
    public function requestPayment(
        string $phoneNumber,
        float $amount,
        string $currency = 'XAF',
        string $externalId = null
    ): array {
        $referenceId = $externalId ?? $this->generateReferenceId();

        try {
            $response = $this->client->post('/collection/v1_0/requesttopay', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getAccessToken(),
                    'X-Reference-Id' => $referenceId,
                    'X-Target-Environment' => config('services.mtn.environment'),
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'amount' => (string) $amount,
                    'currency' => $currency,
                    'externalId' => $referenceId,
                    'payer' => [
                        'partyIdType' => 'MSISDN',
                        'partyId' => $this->formatPhoneNumber($phoneNumber),
                    ],
                    'payerMessage' => 'Payment for order',
                    'payeeNote' => 'Payment received',
                ],
            ]);

            return [
                'success' => true,
                'reference_id' => $referenceId,
                'status' => 'PENDING',
            ];
        } catch (GuzzleException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Check payment status
     */
    public function checkPaymentStatus(string $referenceId): array
    {
        try {
            $response = $this->client->get(
                "/collection/v1_0/requesttopay/{$referenceId}",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->getAccessToken(),
                        'X-Target-Environment' => config('services.mtn.environment'),
                        'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
                    ],
                ]
            );

            $data = json_decode($response->getBody()->getContents(), true);

            return [
                'success' => true,
                'status' => $data['status'],
                'amount' => $data['amount'],
                'currency' => $data['currency'],
                'financial_transaction_id' => $data['financialTransactionId'] ?? null,
            ];
        } catch (GuzzleException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get OAuth access token
     */
    protected function getAccessToken(): string
    {
        $cacheKey = 'mtn_momo_access_token';

        return cache()->remember($cacheKey, now()->addMinutes(50), function () {
            $response = $this->client->post('/collection/token/', [
                'auth' => [$this->apiKey, config('services.mtn.api_secret')],
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data['access_token'];
        });
    }

    protected function generateReferenceId(): string
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    protected function formatPhoneNumber(string $phoneNumber): string
    {
        // Remove any non-numeric characters
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Add country code if missing (example: 237 for Cameroon)
        if (strlen($phoneNumber) === 9) {
            $phoneNumber = '237' . $phoneNumber;
        }

        return $phoneNumber;
    }
}
```

## Configuration

Add to `config/services.php`:

```php
'mtn' => [
    'api_key' => env('MTN_API_KEY'),
    'api_secret' => env('MTN_API_SECRET'),
    'subscription_key' => env('MTN_SUBSCRIPTION_KEY'),
    'base_url' => env('MTN_BASE_URL', 'https://sandbox.momodeveloper.mtn.com'),
    'environment' => env('MTN_ENVIRONMENT', 'sandbox'),
],
```

## Usage Example

### In a Controller

```php
<?php

namespace App\Http\Controllers;

use App\Services\Payment\MTNMoMoService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        protected MTNMoMoService $mtnMoMo
    ) {}

    public function initiatePayment(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required|string',
            'amount' => 'required|numeric|min:100',
        ]);

        $result = $this->mtnMoMo->requestPayment(
            $validated['phone_number'],
            $validated['amount']
        );

        if ($result['success']) {
            // Store transaction in database
            $transaction = Transaction::create([
                'reference_id' => $result['reference_id'],
                'phone_number' => $validated['phone_number'],
                'amount' => $validated['amount'],
                'status' => 'pending',
            ]);

            return response()->json([
                'message' => 'Payment initiated',
                'transaction_id' => $transaction->id,
                'reference_id' => $result['reference_id'],
            ]);
        }

        return response()->json([
            'message' => 'Payment failed',
            'error' => $result['error'],
        ], 400);
    }

    public function checkStatus(string $referenceId)
    {
        $result = $this->mtnMoMo->checkPaymentStatus($referenceId);

        if ($result['success']) {
            // Update transaction status
            Transaction::where('reference_id', $referenceId)
                ->update(['status' => strtolower($result['status'])]);
        }

        return response()->json($result);
    }

    /**
     * Webhook for payment notifications
     */
    public function webhook(Request $request)
    {
        $data = $request->all();

        $transaction = Transaction::where('reference_id', $data['referenceId'])
            ->first();

        if ($transaction) {
            $transaction->update([
                'status' => strtolower($data['status']),
                'financial_transaction_id' => $data['financialTransactionId'] ?? null,
            ]);

            // Trigger any post-payment actions
            if ($data['status'] === 'SUCCESSFUL') {
                event(new PaymentSuccessful($transaction));
            }
        }

        return response()->json(['status' => 'OK']);
    }
}
```

## Best Practices

1. **Always use HTTPS** for production
2. **Validate webhook signatures** to prevent fraud
3. **Handle timeouts gracefully** - mobile payments can be slow
4. **Store transaction records** for reconciliation
5. **Test thoroughly** in sandbox before production
6. **Implement retry logic** for failed API calls
7. **Monitor transaction status** asynchronously

## Testing

Use MTN's sandbox environment for testing:

```php
// .env.testing
MTN_BASE_URL=https://sandbox.momodeveloper.mtn.com
MTN_ENVIRONMENT=sandbox
```

## Conclusion

MTN Mobile Money integration is straightforward with proper error handling and testing. This implementation provides a solid foundation for accepting mobile payments in your PHP application.

For production use, ensure you've completed MTN's KYC process and moved to their production environment.

Questions? Leave a comment below!
MARKDOWN
            ],
        ];
    }

    /**
     * @return array<int, array{title: string, description: string, days_ago: int, categories: list<string>, tags: list<string>, content: string}>
     */
    private function getWorksData(): array
    {
        return [
            [
                'title' => 'Cowema - African E-Commerce Platform',
                'description' => 'Co-founded and scaled an e-commerce platform from 0 to 30K+ users, serving the African market with marketplace and classified ads functionality.',
                'days_ago' => 365,
                'categories' => ['E-Commerce', 'Web Applications'],
                'tags' => ['Laravel', 'React', 'Mobile', 'E-Commerce', 'Full-Stack'],
                'content' => <<<'MARKDOWN'
# Cowema - African E-Commerce Platform

## Overview

As Co-Founder and CTO at Cowema (2020-2023), I built and scaled a comprehensive e-commerce platform serving the African market. The platform grew from concept to 30K+ active users, processing thousands of transactions monthly.

## Challenge

Build a robust, scalable e-commerce platform tailored for African markets with:
- Marketplace for vendors to list products
- Classified ads system (VEC)
- Multiple payment integrations (Mobile Money, Bank Cards)
- Mobile-first approach
- Multi-language support (French, English)
- Low-bandwidth optimization

## Technical Stack

**Backend:**
- Laravel 10 for API and admin panel
- MySQL for data persistence
- Redis for caching and queues
- AWS S3 for media storage

**Frontend:**
- React for web application
- Next.js for SEO-optimized pages
- Tailwind CSS for responsive design

**Mobile:**
- Flutter for iOS and Android apps
- Push notifications with OneSignal

**Infrastructure:**
- AWS EC2 and RDS
- CloudFront CDN
- CI/CD with GitHub Actions

## Key Features Delivered

### Marketplace
- Vendor registration and verification
- Product catalog management
- Real-time inventory tracking
- Order processing and fulfillment
- Review and rating system

### Classified Ads (VEC)
- Category-based listings
- Location-based search
- Image galleries
- Contact system for buyers/sellers
- Featured listings

### Payment Integration
- MTN Mobile Money
- Orange Money
- Airtel Money
- Visa/Mastercard via Stripe
- Escrow system for buyer protection

### Admin Panel
- Comprehensive dashboard
- Vendor management
- Order tracking and analytics
- Content moderation tools
- Financial reporting

## Technical Achievements

**Scalability:**
- Architected microservices for payment processing
- Implemented caching strategies reducing DB load by 60%
- Queue system handling 10K+ background jobs daily
- Auto-scaling infrastructure

**Performance:**
- Optimized API responses to <200ms average
- Image optimization reducing bandwidth by 70%
- Progressive Web App (PWA) for offline support
- Lazy loading for mobile data savings

**Security:**
- Two-factor authentication
- Payment data encryption
- Rate limiting and DDoS protection
- Regular security audits

## Team & Process

**Built and led team of 3 engineers:**
- 1 Backend Developer
- 1 Frontend Developer
- 1 Mobile Developer

**Established engineering practices:**
- Git workflow and code reviews
- Automated testing (PHPUnit, Jest)
- CI/CD pipeline
- Agile sprints with weekly demos

## Impact

- **30,000+** registered users
- **5,000+** vendors on platform
- **100,000+** products listed
- **50,000+** mobile app downloads
- **$500K+** in transactions processed

## Lessons Learned

1. **Mobile-first is critical** in African markets
2. **Payment integration** requires robust error handling
3. **Offline capabilities** improve user experience significantly
4. **Local partnerships** are essential for growth
5. **Technical debt** must be addressed continuously

## Recognition

- Featured in local tech news
- Selected for startup acceleration program
- Positive user reviews (4.2+ stars)

## Links

- Platform: [cowema.com](https://cowema.com) (legacy)
- Case Study: Available upon request
MARKDOWN
            ],

            [
                'title' => 'Akieni Enterprise System - Government Integration',
                'description' => 'Led engineering team to deliver critical enterprise system after 2+ years stalled, integrating with 8+ government services.',
                'days_ago' => 90,
                'categories' => ['Enterprise', 'Web Applications'],
                'tags' => ['Laravel', 'ASP.NET Core', 'Kubernetes', 'AWS', 'Enterprise'],
                'content' => <<<'MARKDOWN'
# Akieni Enterprise System - Government Integration

## Overview

As Engineering Manager at Akieni (2024-present), I inherited a critical enterprise system that had been stalled for over 2 years. Within 10 months, we delivered a production-ready system integrating with 8+ government services, achieving 99.9% uptime.

## Challenge

The project faced multiple challenges:
- **Stalled development**: 2+ years behind schedule
- **Complex integrations**: 8+ government APIs with inconsistent documentation
- **High availability requirements**: 99.9% SLA
- **Legacy constraints**: Must integrate with existing systems
- **Team scaling**: Grew from 7 to 17+ engineers during delivery

## Technical Architecture

**Backend Services:**
- ASP.NET Core 8 for core business logic
- Laravel 11 for admin and reporting
- Node.js microservices for real-time features

**Infrastructure:**
- AWS EKS (Kubernetes) for container orchestration
- Multi-AZ deployment across 3 availability zones
- Auto-scaling based on load
- AWS RDS PostgreSQL with read replicas

**Integration Layer:**
- Custom middleware connecting 8 government APIs
- Message queue (RabbitMQ) for async processing
- API Gateway for request routing
- Circuit breakers for fault tolerance

**Frontend:**
- React 18 with TypeScript
- Redux for state management
- Material-UI component library
- Progressive Web App capabilities

**Monitoring & Observability:**
- Prometheus for metrics
- Grafana dashboards
- ELK stack for logging
- PagerDuty for alerting

## Key Features

### Government Service Integration
- Citizen identity verification
- Tax record retrieval
- Property registration
- Business license validation
- Court records access
- Land title verification
- Vehicle registration
- Social security data

### Core Functionality
- Multi-tenant architecture
- Role-based access control (RBAC)
- Audit logging for compliance
- Document management system
- Workflow automation engine
- Real-time notifications
- Advanced reporting and analytics

### Security
- OAuth 2.0 + OpenID Connect
- End-to-end encryption
- Data anonymization for PII
- Regular penetration testing
- GDPR compliance

## Technical Achievements

**High Availability:**
- 99.95% actual uptime (exceeded 99.9% SLA)
- Zero-downtime deployments
- Automatic failover in <30 seconds
- Disaster recovery with <5 minute RTO

**Performance:**
- Handles 10,000+ concurrent users
- API response times <100ms (p95)
- Process 50,000+ transactions daily
- Real-time updates via WebSockets

**Cost Optimization:**
- Reduced infrastructure costs by 21%
- Optimized database queries (3x faster)
- Implemented intelligent caching
- Right-sized EC2 instances

**DevOps:**
- 3-5 deployments per day
- 95% automated test coverage
- CI/CD pipeline <15 minutes
- Infrastructure as Code (Terraform)

## Team Leadership

**Scaled engineering team:**
- Recruited 10+ engineers
- Backend (4), Frontend (3), Mobile (2), DevOps (2)
- Integrated Academy talent with mentorship
- Established engineering culture

**Processes Implemented:**
- Agile/Scrum methodology
- Code review standards
- Git workflow (trunk-based)
- On-call rotation
- Knowledge base documentation

**Mentorship:**
- 2 junior developers reached mid-level
- Weekly 1-on-1s with direct reports
- Tech talks and knowledge sharing
- Career development plans

## Impact

**For Government:**
- 8 services integrated into single platform
- Reduced processing time by 60%
- Improved data accuracy
- Enhanced citizen experience

**For Organization:**
- Unblocked critical project
- Delivered on time and within budget
- Established reusable architecture
- Built sustainable engineering team

**Personal Growth:**
- Led largest team to date (17+ engineers)
- Managed complex stakeholder relationships
- Delivered mission-critical system
- Proved ability to rescue troubled projects

## Recognition

- Commendation from executive team
- Selected to present at company all-hands
- Promoted to VP of Engineering (March 2025)

## Lessons Learned

1. **Clear communication** is crucial with stakeholders
2. **Technical debt** must be addressed incrementally
3. **Team culture** impacts delivery speed
4. **Proper monitoring** prevents surprises
5. **Documentation** saves countless hours

## Technical Stack Summary

- **Languages**: C#, PHP, TypeScript, Python
- **Frameworks**: ASP.NET Core, Laravel, React, Node.js
- **Databases**: PostgreSQL, Redis, Elasticsearch
- **Infrastructure**: AWS (EKS, RDS, S3, CloudFront)
- **DevOps**: Docker, Kubernetes, Terraform, GitHub Actions
- **Monitoring**: Prometheus, Grafana, ELK, Sentry
MARKDOWN
            ],

            [
                'title' => 'Lord Market - Multi-Platform Commerce App',
                'description' => 'Developed a comprehensive marketplace mobile application reaching 10K+ downloads with real-time features and secure payment integration.',
                'days_ago' => 500,
                'categories' => ['Mobile Apps', 'E-Commerce'],
                'tags' => ['Flutter', 'Mobile', 'E-Commerce', 'API'],
                'content' => <<<'MARKDOWN'
# Lord Market - Multi-Platform Commerce App

## Overview

Lord Market is a mobile marketplace application I developed for Android and iOS, achieving over 10,000 downloads. The app connects buyers and sellers in a user-friendly platform with real-time messaging and secure payments.

## Features

**For Buyers:**
- Browse products by category
- Advanced search and filters
- Save favorites
- In-app messaging with sellers
- Secure checkout process
- Order tracking
- Push notifications

**For Sellers:**
- List products with photos
- Manage inventory
- Chat with buyers
- Process orders
- Sales analytics
- Promotional tools

**Core Functionality:**
- User authentication (social + email)
- Real-time chat messaging
- Image upload and optimization
- Location-based search
- Payment gateway integration
- Rating and review system
- Multi-language support

## Technical Stack

**Mobile App:**
- Flutter for cross-platform development
- Dart language
- BLoC pattern for state management
- Firebase for authentication
- OneSignal for push notifications

**Backend:**
- Laravel API
- MySQL database
- Redis for caching
- S3 for image storage

**Real-time:**
- Pusher for chat
- WebSocket connections
- Background sync

## Key Achievements

- 10,000+ downloads on Google Play
- 4.0+ star rating
- Featured in local app stores
- Active user base of 2,000+
- 95% crash-free rate

## Technical Highlights

**Performance:**
- Lazy loading for smooth scrolling
- Image caching and optimization
- Offline mode for saved content
- <3 second app startup time

**UX/UI:**
- Material Design principles
- Intuitive navigation
- Accessibility features
- Responsive layouts

**Security:**
- Encrypted communications
- Secure payment processing
- Input validation
- User data protection

## Impact

Created a trusted platform for local commerce, enabling small businesses to reach mobile-first customers efficiently.
MARKDOWN
            ],

            [
                'title' => 'Freeze - Inventory Management System',
                'description' => 'Desktop application for inventory and sales management with modern UI and robust reporting capabilities.',
                'days_ago' => 600,
                'categories' => ['Enterprise'],
                'tags' => ['C#', 'ASP.NET Core', 'Enterprise'],
                'content' => <<<'MARKDOWN'
# Freeze - Inventory Management System

## Overview

Freeze is a comprehensive inventory and sales management desktop application built for small to medium businesses. The system helps businesses track stock, manage sales, generate reports, and optimize operations.

## Features

**Inventory Management:**
- Product catalog with categories
- Stock level tracking
- Low stock alerts
- Barcode scanning support
- Batch and serial number tracking
- Multi-location support

**Sales Management:**
- Point of sale (POS) interface
- Invoice generation
- Payment tracking
- Customer database
- Sales history
- Returns and refunds

**Reporting:**
- Sales reports (daily, weekly, monthly)
- Inventory valuation
- Profit margins
- Best-selling products
- Customer purchase patterns
- Export to Excel/PDF

**User Management:**
- Role-based access
- Activity logging
- Multiple user accounts
- Permission system

## Technical Stack

**Frontend:**
- WPF (Windows Presentation Foundation)
- XAML for UI design
- Material Design themes
- MVVM pattern

**Backend:**
- C# .NET 6
- Entity Framework Core
- SQLite database
- Background services

**Reporting:**
- Crystal Reports
- Excel export (EPPlus)
- PDF generation

## Key Features

**Modern UI:**
- Responsive design
- Dark/light themes
- Keyboard shortcuts
- Touch-screen support

**Performance:**
- Fast search and filtering
- Efficient data loading
- Background synchronization
- Optimized queries

**Reliability:**
- Automatic backups
- Data validation
- Error handling
- Crash recovery

## Impact

Deployed to 20+ businesses, helping them:
- Reduce inventory errors by 80%
- Speed up checkout process
- Improve stock management
- Generate accurate reports
- Save 10+ hours per week

## Client Feedback

> "Freeze transformed how we manage inventory. The interface is intuitive and the reports are exactly what we need."
> — Small retail business owner

The application continues to receive updates and has an active user base with excellent feedback on reliability and ease of use.
MARKDOWN
            ],
        ];
    }
}
