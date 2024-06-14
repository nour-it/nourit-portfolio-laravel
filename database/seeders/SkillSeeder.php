<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\User;
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
                "type" => Skill::class,
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
                "skill_category_id" => $skill[1]
            ]
        );
       
        if(app()->environment() != "production") {
            Schema::disableForeignKeyConstraints();
            DB::table('images')->truncate();
            DB::table('imageables')->truncate();
            DB::table('skills')->truncate();
        }

        User::find(1)->skill()->sync([1, 2, 3, 4, 5, 6, 7, 8, 9]);

        DB::table('images')->insert($this->images);
        Category::insert($this->categories);
        foreach($this->skills as $skill) {
            $tmp = Skill::create(['name' => $skill['name']]);
            $c = Category::find($skill['skill_category_id']);
            $c->skill()->attach($tmp);
        }
        DB::table('imageables')->insert(Arr::map([
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
            'imageable_id' => $skill_image[0],
            'imageable_type' => Skill::class,
            'image_id' => $skill_image[1],
            "upload_at" => new DateTime(),
        ]));
    }
}
