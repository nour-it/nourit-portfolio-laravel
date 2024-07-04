<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use App\Models\Qualification;
use App\Models\Role;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Social;
use App\Models\User;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment() != "production") {
            Schema::disableForeignKeyConstraints();
            DB::table('images')->truncate();
            DB::table('imageables')->truncate();
            DB::table('skills')->truncate();
            DB::table('projects')->truncate();
        }

        $categories = Arr::map(
            ['Frontend', 'Backend'],
            fn ($category) => [
                'name' => $category,
                "type" => Skill::class,
            ]
        );
        Category::insert($categories);

        $categories = Arr::map(
            ['web', 'android', 'ios'],
            fn ($category) => [
                'name' => $category,
                'type' => Project::class,
            ]
        );
        Category::insert($categories);

        $categories = Arr::map(
            ['Web development'],
            fn ($category) => [
                'name' => $category,
                "type" => Service::class,
            ]
        );
        Category::insert($categories);

        $categories = Arr::map(
            ['Education', 'Experience'],
            fn ($category) => [
                'name' => $category,
                "type" => Qualification::class,
            ]
        );
        Category::insert($categories);

        $categories = Arr::map(
            ['Profile', 'Contact',],
            fn ($category) => [
                'name' => $category,
                "type" => Social::class,
            ]
        );
        Category::insert($categories);

        $this->call([
            UserSeeder::class,
            SkillSeeder::class,
            ProjectSeeder::class,
            ServiceSeeder::class,
            QualificationSeeder::class,
            SocialSeeder::class,
        ]);

        if (app()->environment() != "production") {
            for ($i = 1; $i < 20; $i++) {
                User::factory()
                    ->hasAttached(Role::find(2), ["add_at" => new DateTime()], "role")
                    ->has(
                        Project::factory()
                            ->hasAttached(Category::find(rand(3, 5)), [], "category")
                            ->count(rand(1, 5))
                    )
                    ->has(
                        Skill::factory()
                            ->hasAttached(Category::find(rand(1, 2)), [], "category")
                            ->count(rand(1, 15))
                    )
                    ->has(Service::factory()->count(rand(1, 4)))
                    ->count(1)
                    ->create();
            }
        }
    }
}
