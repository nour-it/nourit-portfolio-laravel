<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectCategory>
 */
class ProjectCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->word(),
            "add_at" => fake()->dateTime(),
            "delete_at" => fake()->numberBetween(0, 1) ? fake()->dateTime() : null,
            "description" => fake()->numberBetween(0, 1) ? fake()->paragraph(fake()->numberBetween(3, 5)) : null,
        ];
    }
}
