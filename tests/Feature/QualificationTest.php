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

        $this->assertDatabaseCount("qualifications", 2);
        $this->assertFileExists($created_file . '/demo_qualification.png');
        $response->assertStatus(302);
        exec("rm -rf {$created_file}");
    }

}
