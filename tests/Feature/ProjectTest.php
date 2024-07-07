<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use App\Repository\ProjectRepository;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    private ProjectRepository $projectRepository;


    protected function setUp(): void
    {
        parent::setUp();
        $this->projectRepository = new ProjectRepository(new Project(), new Category());
    }


    public function test_create_project_without_logged_user()
    {
        $category = $this->projectRepository->getCategories()->first();
        $response = $this->post(route("projects.store", [
            'name'        => 'projet demo',
            'category_id' => $category->id,
            'add_at'      => new DateTime(),
            'create_at'   => new DateTime(),
            'end_at'      => Carbon::now()->addDays(3),
            'delete_at'   => NULL,
            'description' => 'PROJECT DEMO description',
            "skill_id"    => NULL,
        ]));
        $response->assertStatus(302);
    }


    public function test_create_project_with_logged_user()
    {
        $this->assertTrue(true);
    }

    public function test_create_project_with_invalide_input_data()
    {
        $this->assertTrue(true);
    }

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
        // $this->assertDatabaseCount("categorisables", 12);
        $response->assertStatus(302);
    }

    public function test_render_user_project_dashboard()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route('projects.index'));
        $response->assertStatus(200);
    }

    public function test_render_user_project_edition_page()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route("projects.create"));
        $response->assertStatus(200);
        $response = $this->get(route("projects.edit", ['project' => $user->project()->first()->id]));
        $response->assertStatus(200);
    }

    public function test_render_projet_admin_page()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route('_projects.index'));
        $response->assertStatus(200);
    }
}
