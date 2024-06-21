<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if(app()->environment() != "production") {
            Schema::disableForeignKeyConstraints();
            DB::table('images')->truncate();
            DB::table('imageables')->truncate();
            DB::table('skills')->truncate();
            DB::table('projects')->truncate();
        }
       
        $this->call([
            UserSeeder::class,
            SkillSeeder::class,
            ProjectSeeder::class,
            ServiceSeeder::class,
            QualificationSeeder::class
        ]); 
        
    }
}
