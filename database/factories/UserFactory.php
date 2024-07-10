<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

        $username = fake()->name();
        return [
            "username"             => $username,
            "slug"                 => Str::slug($username),
            "email"                => fake()->email(),
            "password"             => Hash::make('0000'),
            "token"                => null,
            "confirmation_token"   => null,
            "google_id"            => null,
            "google_token"         => null,
            "google_refresh_token" => null,
            "bio"                  => "<p>" . fake("fr_FR")->paragraphs(3, true) . "</p>",
            "about"                => "<p>" . fake("fr_FR")->paragraphs(3, true) . "</p>",
            "validate_at"          => fake()->date()
        ];
    }
}
