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
        exec("rm -rf {$created_file}");
    }
}
