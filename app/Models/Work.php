<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Carbon\CarbonInterface;
use Database\Factories\WorkFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string $content
 * @property string|null $featured_image
 * @property array<int, string>|null $image_gallery
 * @property string $status
 * @property CarbonInterface|null $published_at
 * @property int $order
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
final class Work extends Model
{
    /** @use HasFactory<WorkFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'featured_image',
        'image_gallery',
        'status',
        'published_at',
        'order',
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
            'order' => 'integer',
            'image_gallery' => 'array',
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
        return $this->belongsToMany(Category::class, 'category_work');
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
     * @param  Builder<Work>  $query
     * @return Builder<Work>
     */
    #[Scope]
    protected function published(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * @param  Builder<Work>  $query
     * @return Builder<Work>
     */
    #[Scope]
    protected function ordered(Builder $query): Builder
    {
        return $query->orderBy('order', 'asc');
    }

    // Auto-generate slug on creation
    protected static function booted(): void
    {
        self::creating(function (Work $work): void {
            if (empty($work->slug)) {
                $work->slug = Str::slug($work->title);
            }
        });
    }
}
