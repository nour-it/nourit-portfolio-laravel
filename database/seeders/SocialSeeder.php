<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Social;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socials = Arr::map(
            ['Facebook', 'twitter', "linkedin", "instagram", "github"],
            fn ($category) => [
                'name' => $category,
                'add_at' => new DateTime()
            ]
        );

        $categories = Arr::map(
            ['Contact', 'Profile'],
            fn ($category) => [
                'name' => $category,
                "type" => Social::class,
            ]
        );

        Social::insert($socials);

        Category::insert($categories);
    }
}
