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
        $this->assertFileExists($created_file . '/demo_skill.png');
        $response->assertStatus(302);
        exec("rm -rf {$created_file}");
    }


}
