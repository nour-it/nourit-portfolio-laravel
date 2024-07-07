<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ServiceTest extends TestCase
{

    public function test_create_user_service()
    {
        $user = User::first();
        Auth::login($user);
        $created_file = storage_path("app/upload/" . $user->id . "/services/demo_service");

        $response = $this->post(route("services.store"), [
            'title'       => "demo_service",
            'image'       => UploadedFile::fake()->image("demo.png"),
            "category_id" => Category::where('type', Service::class)->first()->id
        ]);

        // $this->assertDatabaseCount("services", 2);
        $this->assertFileExists($created_file . '/demo.png');
        $response->assertStatus(302);
        // exec("rm -rf {$created_file}");
    }

    public function test_render_user_service_dashboard()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route('services.index'));
        $response->assertStatus(200);
    }

    public function test_render_user_service_edition_page()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route("services.create"));
        $response->assertStatus(200);
        $response = $this->get(route("services.edit", ['service' => $user->service()->first()->id]));
        $response->assertStatus(200);
    }

    public function test_render_service_admin_page()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route('_services.index'));
        $response->assertStatus(200);
    }
}
