<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillCategory;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\map;

class SkillSeeder extends Seeder
{
    private $images = [];

    private $categories = [];

    private $skills = [];


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->images = Arr::map(
            Storage::allFiles("assets/img/skill"),
            fn ($image) => ['path' => $image]
        );
        $this->categories = Arr::map(
            ['Frontend', 'Backend'],
            fn ($category) => [
                'name' => $category,
                'add_at' => new DateTime(),
                'delete_at' => NULL,
                'description' => '',
            ]
        );
        $this->skills = Arr::map(
            [
                ["Figma", 1],
                ["ReactJS + React Native", 1],
                ["Mysql + Postgres", 2],
                ["Php + NodeJS", 2],
                ["HTML 5", 1],
                ["CSS 3 + SCSS", 1],
                ["Laravel", 2],
                ["VS Code", 1],
                ["Git", 2]
            ],
            fn ($skill) => [
                'name' => $skill[0],
                'add_at' => new DateTime(),
                'delete_at' => NULL,
                'description' => '',
                "skill_category_id" => $skill[1]
            ]
        );

        Schema::disableForeignKeyConstraints();
        DB::table('images')->truncate();
        DB::table('images')->insert($this->images);
        SkillCategory::insert($this->categories);
        Skill::insert($this->skills);
        DB::table('image_skill')->insert(Arr::map([
            [1, 3],
            [2, 14],
            [3, 8],
            [3, 12],
            [4, 9],
            [4, 11],
            [5, 5],
            [6, 2],
            [6, 15],
            [7, 7],
            [8, 16],
            [9, 4],
        ], fn ($skill_image) => [
            'skill_id' => $skill_image[0],
            'image_id' => $skill_image[1],
            "upload_at" => new DateTime(),

        ]));
    }
}
