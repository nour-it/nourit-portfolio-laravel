<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
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
            Storage::allFiles("assets/img/project/fruitnourmatching"),
            fn ($image) => ['path' => $image]
        );
        $this->categories = Arr::map(
            ['web', 'android', 'ios'],
            fn ($category) => [
                'name' => $category,
                'add_at' => new DateTime(),
                'delete_at' => NULL,
                'description' => '',
            ]
        );
        $this->projects = Arr::map(
            [
                ["Fruit Nour Matching", 2],
            ],
            fn ($project) => [
                'name' => $project[0],
                'add_at' => new DateTime(),
                'delete_at' => NULL,
                'description' => '',
                "project_category_id" => $project[1]
            ]
        );
        if(app()->environment() == "local") {
            Schema::disableForeignKeyConstraints();
            // DB::table('images')->truncate();
            // DB::table('image_project')->truncate();
            DB::table('projects')->truncate();
        }

        DB::table('images')->insert($this->images);
        ProjectCategory::insert($this->categories);
        Project::insert($this->projects);
        DB::table('imageable')->insert(Arr::map([
            [1, 21],
            [1, 18],
            [1, 19],
            [1, 20],
        ], fn ($skill_image) => [
            'imageable_id' => $skill_image[0],
            'imageable_type' => Project::class,
            'image_id' => $skill_image[1],
            "upload_at" => new DateTime(),
        ]));
    }
}
