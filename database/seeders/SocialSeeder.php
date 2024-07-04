<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Social;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socials = Arr::map(
            ['Facebook', "github", "instagram", "linkedin", 'twitter'],
            fn ($category) => [
                'name' => $category,
                'add_at' => new DateTime()
            ]
        );

        Social::insert($socials);

        $images = Arr::map(
            Storage::allFiles("assets/img/social"),
            fn ($image) => ['path' => $image]
        );

        Image::insert($images);

        DB::table('imageables')->insert(Arr::map([
            [1, 20],
            [2, 21],
            [3, 22],
            [4, 23],
            [5, 24],
        ], fn ($social_image) => [
            'imageable_id' => $social_image[0],
            'imageable_type' => Social::class,
            'image_id' => $social_image[1],
            "upload_at" => new DateTime(),
        ]));
    }
}
