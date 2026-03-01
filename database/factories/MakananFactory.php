<?php

namespace Database\Factories;

use App\Models\Daerah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Makanan>
 */
class MakananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->words(3, true),
            'deskripsi' => fake()->paragraph(),
            'resep' => fake()->paragraphs(3, true),
            'panduan' => fake()->paragraphs(2, true),
            'image' => 'default.jpg',
            'daerah_id' => Daerah::factory(),
            'status' => 'published',
        ];
    }

    /**
     * Indicate that the food is in draft status.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
        ]);
    }

    /**
     * Indicate that the food is archived.
     */
    public function archived(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'archived',
        ]);
    }
}
