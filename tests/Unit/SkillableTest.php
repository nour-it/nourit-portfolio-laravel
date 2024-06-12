<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SkillableTest extends TestCase
{

    use RefreshDatabase;

    public function test_add_user_skill(): void
    {
        $this->seed();
        $skill_category = SkillCategory::find(1);
        $user = User::find(1);
        Auth::login($user);
        $response = $this->post(route('skills.store'), [
            'name'              => fake()->word(),
            'skill_category_id' => $skill_category->id,
            'icon'              => UploadedFile::fake()->image("demo.png")
        ]);

        $response->assertStatus(302);

    }

  
    public function test_add_project_skill(): void
    {
        $this->seed();
        $project = Project::find(1);
        $skill = Skill::find(1);
        $user = User::find(1);
        Auth::login($user);
        $response = $this->put(route("projects.update", ['project' => $project->id]), [
            'name'                => fake()->word(),
            'project_category_id' => $project->project_category_id,
            "skill_id"            => $skill->id,
            'icon'                => UploadedFile::fake()->image("demo.png")
        ]);

        $response->assertStatus(302);
    }
}
