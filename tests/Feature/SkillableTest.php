<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SkillableTest extends TestCase
{

    public function test_add_user_skill(): void
    {
        $user = User::find(1);
        Auth::login($user);
        $created_file = storage_path("app/upload/" . $user->id . "/skills/demo_skill");
        $response = $this->post(route('skills.store'), [
            'name'        => "demo_skill",
            'icon'        => UploadedFile::fake()->image("demo.png"),
            "category_id" => Category::where('type', Skill::class)->first()->id
        ]);
        $this->assertDatabaseHas("skills", ["name" => "demo_skill"]);
        $this->assertFileExists($created_file . '/demo.png');
        $response->assertStatus(302);
        exec("rm -rf {$created_file}");
    }

    public function test_render_user_skill_dashboard()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route('skills.index'));
        $response->assertStatus(200);
    }

    public function test_render_user_skill_edition_page()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route("skills.create"));
        $response->assertStatus(200);
        $response = $this->get(route("skills.edit", ['skill' => $user->skill()->first()->id]));
        $response->assertStatus(200);
    }

    public function test_render_skill_admin_page()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route('_skills.index'));
        $response->assertStatus(200);
    }

}
