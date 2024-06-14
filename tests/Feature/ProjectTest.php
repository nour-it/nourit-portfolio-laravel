<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    public function test_add_project_skill(): void
    {
        $project = Project::find(1);
        $skill   = Skill::find(1);
        $user    = User::find(1);
        Auth::login($user);
        $response = $this->put(route("projects.update", ['project' => $project->id]), [
            "name"        => $project->name . ' edited',
            'category_id' => $project->category->first()->id,
            "skill_id"    => $skill->id
        ]);
        $this->assertDatabaseCount("categorisables", 10);
        $response->assertStatus(302);
    }
}
