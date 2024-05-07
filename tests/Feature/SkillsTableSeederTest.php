<?php

namespace Tests\Unit;

use App\Models\Skill;
use Database\Seeders\SkillSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SkillsTableSeederTest extends TestCase
{
    // use RefreshDatabase;

    public function test_seed_skills_table()
    {
       // $this->expectsDatabaseQueryCount(12);
        $this->seed(SkillSeeder::class);
        // $this->assertDatabaseCount("skill_categories", 2);
        $this->assertDatabaseCount("skills", 9);
    }
}
