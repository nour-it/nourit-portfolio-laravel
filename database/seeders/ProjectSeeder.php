<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{

    private $images = [];

    private $categories = [];

    private $projects = [];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->images = Arr::map(
            Storage::files("assets/img/project/fruitnourmatching"),
            fn ($image) => ['path' => $image]
        );
        
        $this->projects = Arr::map(
            [
                ["Fruit Nour Matching", 4],
            ],
            fn ($project) => [
                'name' => $project[0],
                "project_category_id" => $project[1],
                "user_id" => 1
            ]
        );

        DB::table('images')->insert($this->images);
        foreach ($this->projects as $project) {
            $tmp = Project::create(
                [
                    'name' => $project['name'],
                    "user_id" => 1
                ]
            );
            $tmp->category()->attach($project['project_category_id']);
        }
        DB::table('imageables')->insert(Arr::map([
            [1, 18],
        ], fn ($skill_image) => [
            'imageable_id' => $skill_image[0],
            'imageable_type' => Project::class,
            'image_id' => $skill_image[1],
            "upload_at" => new DateTime(),
        ]));
    }
}
