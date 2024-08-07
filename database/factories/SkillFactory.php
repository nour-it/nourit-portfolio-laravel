<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
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
            "delete_at" => fake()->numberBetween(0, 1) ? fake()->dateTime() : null,
            "description" => fake()->paragraph(fake()->numberBetween(3, 5)),
        ];
    }
}
