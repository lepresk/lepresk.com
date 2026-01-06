<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Work>
 */
final class WorkFactory extends Factory
{
    protected $model = Work::class;

    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(),
            'content' => fake()->paragraphs(8, true),
            'featured_image' => null,
            'status' => 'draft',
            'published_at' => null,
            'order' => 0,
            'meta_title' => null,
            'meta_description' => fake()->sentence(),
            'meta_keywords' => null,
            'og_title' => null,
            'og_description' => null,
            'og_image' => null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'published',
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ]);
    }
}
