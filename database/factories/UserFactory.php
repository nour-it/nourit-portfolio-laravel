<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "username" => fake()->text(20),
            "email" => fake()->email(),
            "password" => Hash::make('0000'),
            "token" => fake()->text(20),
            "confirmation_token" => fake()->text(20),
            "google_id" => fake()->text(20),
            "google_token" => fake()->text(20),
            "google_refresh_token" => fake()->text(20)
        ];
    }
}
