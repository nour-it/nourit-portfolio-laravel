<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Qualification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class QualificationTest extends TestCase
{
  
    public function test_create_user_qualification()
    {
        $user = User::first();
        Auth::login($user);
        $created_file = storage_path("app/upload/" . $user->id . "/qualifications/demo_qualification");

        $response = $this->post(route("qualifications.store"), [
            'name'       => "demo_qualification",
            'image'       => UploadedFile::fake()->image("demo.png"),
            "category_id" => Category::where('type', Qualification::class)->first()->id
        ]);

        // $this->assertDatabaseCount("qualifications", 2);
        $this->assertFileExists($created_file . '/demo.png');
        $response->assertStatus(302);
        exec("rm -rf {$created_file}");
    }


    public function test_render_user_qualification_dashboard()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route('qualifications.index'));
        $response->assertStatus(200);
    }

    public function test_render_user_qualification_edition_page()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route("qualifications.create"));
        $response->assertStatus(200);
        $response = $this->get(route("qualifications.edit", ['qualification' => $user->qualification()->first()->id]));
        $response->assertStatus(200);
    }

    public function test_render_qualification_admin_page()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route('_qualifications.index'));
        $response->assertStatus(200);
    }
}
