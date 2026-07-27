<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
final class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $titleEn = fake()->sentence(6);
        $titleFr = fake('fr_FR')->sentence(6);

        return [
            'title' => ['en' => $titleEn, 'fr' => $titleFr],
            'slug' => ['en' => Str::slug($titleEn), 'fr' => Str::slug($titleFr)],
            'excerpt' => ['en' => fake()->paragraph(2), 'fr' => fake('fr_FR')->paragraph(2)],
            'content' => ['en' => fake()->paragraphs(10, true), 'fr' => fake('fr_FR')->paragraphs(10, true)],
            'featured_image' => null,
            'read_time' => fake()->randomElement(['5 min', '8 min', '10 min', '12 min']),
            'status' => 'draft',
            'published_at' => null,
            'meta_title' => null,
            'meta_description' => ['en' => fake()->sentence(), 'fr' => fake('fr_FR')->sentence()],
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
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ]);
    }
}
