<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\PostObserver;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $excerpt
 * @property string $content
 * @property string|null $featured_image
 * @property string|null $read_time
 * @property string $status
 * @property CarbonInterface|null $published_at
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $og_title
 * @property string|null $og_description
 * @property string|null $og_image
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property CarbonInterface|null $deleted_at
 * @property-read Collection<int, Category> $categories
 * @property-read Collection<int, Tag> $tags
 */
#[ObservedBy(PostObserver::class)]
final class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, HasTranslations, SoftDeletes;

    /** @var array<int, string> */
    public array $translatable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
    ];

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'read_time',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
    ];

    public function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships

    /**
     * @return BelongsToMany<Category, $this>
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    /**
     * @return MorphToMany<Tag, $this>
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    // Query Scopes

    /**
     * Every slug this post answers to, across locales.
     *
     * @return array<int, string>
     */
    public function slugsInAllLocales(): array
    {
        return array_values(array_filter(
            $this->getTranslations('slug'),
            fn (mixed $slug): bool => is_string($slug) && $slug !== '',
        ));
    }

    /**
     * @param  Builder<Post>  $query
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Order by publication date.
     *
     * Named `latestPublished` and not `latest`, because Eloquent's builder
     * already exposes a `latest()` method that would shadow the scope.
     *
     * @param  Builder<Post>  $query
     */
    public function scopeLatestPublished(Builder $query): void
    {
        $query->orderByDesc('published_at');
    }

    /**
     * Match a slug in any of the available locales.
     *
     * @param  Builder<Post>  $query
     */
    public function scopeWhereSlug(Builder $query, string $slug): void
    {
        $query->where(function (Builder $query) use ($slug): void {
            /** @var array<int, string> $locales */
            $locales = config('app.available_locales', []);

            foreach ($locales as $locale) {
                $query->orWhere("slug->{$locale}", $slug);
            }
        });
    }

    // Auto-generate slug on creation
    protected static function booted(): void
    {
        self::creating(function (Post $post): void {
            $locale = app()->getLocale();
            if (empty($post->getTranslation('slug', $locale, false))) {
                /** @var string|null $title */
                $title = $post->getTranslation('title', $locale, false);
                if (is_string($title) && $title !== '') {
                    $post->setTranslation('slug', $locale, Str::slug($title));
                }
            }
        });
    }
}
