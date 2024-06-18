<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Qualification;
use App\Models\User;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class QualificationSeeder extends Seeder
{


    private $images = [];

    private $categories = [];

    private $qualifications = [];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->images = Arr::map(
            Storage::allFiles("assets/img/qualification"),
            fn ($image) => ['path' => $image]
        );
        $this->categories = Arr::map(
            ['Education', 'Experience'],
            fn ($category) => [
                'name' => $category,
                "type" => Qualification::class,
            ]
        );

        // l'id des categories de service commence par 7
        $this->qualifications = Arr::map(
            [
                ["Scientific secondary school diploma", 7],
            ],
            fn ($qualification) => [
                'name' => $qualification[0],
                'qualification_category_id' => $qualification[1],
                'user_id' => User::first()->id,
            ]
        );

        DB::table('images')->insert($this->images);
        Category::insert($this->categories);
        foreach ($this->qualifications as $qualification) {
            $tmp = Qualification::create(['name' => $qualification['name'], 'user_id' => $qualification['user_id']]);
            $c = Category::find($qualification['qualification_category_id']);
            $c->qualification()->attach($tmp);
        }

        // l'id des images pour les qualifications commence par 20
        DB::table('imageables')->insert(Arr::map([
            [1, 20],
        ], fn ($qualification_image) => [
            'imageable_id' => $qualification_image[0],
            'imageable_type' => Qualification::class,
            'image_id' => $qualification_image[1],
            "upload_at" => new DateTime(),
        ]));
    }
}
