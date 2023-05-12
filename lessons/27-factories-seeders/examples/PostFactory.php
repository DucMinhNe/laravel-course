<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence();

        return [
            'title'        => $title,
            'slug'         => Str::slug($title) . '-' . fake()->unique()->numberBetween(1, 99999),
            'body'         => fake()->paragraphs(3, true),
            'published'    => fake()->boolean(70),   // 70% chance true
            'published_at' => fake()->dateTimeBetween('-1 year'),
        ];
    }

    // A state: Post::factory()->draft()->create()
    public function draft(): static
    {
        return $this->state(fn () => [
            'published'    => false,
            'published_at' => null,
        ]);
    }
}
