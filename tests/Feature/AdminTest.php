<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Project;
use App\Models\Qualification;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AdminTest extends TestCase
{

    public function test_valide_admin(): void
    {
        $response = $this->get(route('admin.home'));
        $response->assertStatus(403);

        $user = User::find(User::count());
        Auth::login($user);
        $response = $this->get(route('admin.home'));
        $response->assertStatus(403);

        $user = User::find(1);
        Auth::login($user);
        $response = $this->get(route('admin.home'));
        $response->assertStatus(200);

    }

    public function test_render_admin_pages()
    {
        $user = User::find(1);
        Auth::login($user);

          // index
        $response = $this->get(route("_users.index"));
        $response->assertStatus(200);

        $response = $this->get(route("_skills.index"));
        $response->assertStatus(200);

        $response = $this->get(route("_projects.index"));
        $response->assertStatus(200);

        $response = $this->get(route("_socials.index"));
        $response->assertStatus(200);

        $response = $this->get(route("_services.index"));
        $response->assertStatus(200);

        $response = $this->get(route("_qualifications.index"));
        $response->assertStatus(200);

          // Create

        $response = $this->get(route("_skills.create"));
        $response->assertStatus(200);

        $response = $this->get(route("_projects.create"));
        $response->assertStatus(200);

        $response = $this->get(route("_socials.create"));
        $response->assertStatus(200);

        $response = $this->get(route("_services.create"));
        $response->assertStatus(200);

        $response = $this->get(route("_qualifications.create"));
        $response->assertStatus(200);

          // Edit

        $response = $this->get(route("_skills.edit", ['_skill' => Category::where("type", Skill::class)->first()->id]));
        $response->assertStatus(200);

        $response = $this->get(route("_projects.edit", ['_project' => Category::where("type", Project::class)->first()->id]));
        $response->assertStatus(200);

        $response = $this->get(route("_socials.edit", ["_social" => Category::where("type", Social::class)->first()->id]));
        $response->assertStatus(200);

        $response = $this->get(route("_services.edit", ['_service' => Category::where("type", Service::class)->first()->id]));
        $response->assertStatus(200);

        $response = $this->get(route("_qualifications.edit", ['_qualification' => Category::where("type", Qualification::class)->first()->id]));
        $response->assertStatus(200);
    }

    public function test_post_data_store_or_update()
    {
        $user = User::find(1);
        Auth::login($user);

          // store

        $response = $this->post(route("_skills.store"), [
            "name" => "new skill category",
            'icon' => UploadedFile::fake()->image("demo.png"),
        ]);
        $response->assertStatus(302);
        $filename = storage_path("app/assets/icon/category/skill/demo.png");
        $this->assertFileExists($filename);
        unlink($filename);

        $response = $this->post(route("_projects.store"), [
            "name" => "new project category",
            'icon' => UploadedFile::fake()->image("demo.png"),
        ]);
        $response->assertStatus(302);
        $filename = storage_path("app/assets/icon/category/project/demo.png");
        $this->assertFileExists($filename);
        unlink($filename);

        $response = $this->post(route("_socials.store"), [
            "name" => "new social category",
            'icon' => UploadedFile::fake()->image("demo.png"),
        ]);
        $response->assertStatus(302);
        $filename = storage_path("app/assets/icon/category/social/demo.png");
        $this->assertFileExists($filename);
        unlink($filename);

        $response = $this->post(route("_services.store"), [
            "name" => "new service category",
            'icon' => UploadedFile::fake()->image("demo.png"),
        ]);
        $response->assertStatus(302);
        $filename = storage_path("app/assets/icon/category/service/demo.png");
        $this->assertFileExists($filename);
        unlink($filename);

        $response = $this->post(route("_qualifications.store"), [
            "name" => "new qualification category",
            'icon' => UploadedFile::fake()->image("demo.png"),
        ]);
        $response->assertStatus(302);
        $filename = storage_path("app/assets/icon/category/qualification/demo.png");
        $this->assertFileExists($filename);
        unlink($filename);

          // update

        $response = $this->put(route("_skills.update", ['_skill' => Category::where("type", Skill::class)->first()->id]), [
            "name" => "updated skill category",
            'icon' => UploadedFile::fake()->image("demo.png"),
        ]);
        $response->assertStatus(302);
        $filename = storage_path("app/assets/icon/category/skill/demo.png");
        $this->assertFileExists($filename);
        unlink($filename);

        $response = $this->put(route("_projects.update", ['_project' => Category::where("type", Project::class)->first()->id]), [
            "name" => "updated project category",
            'icon' => UploadedFile::fake()->image("demo.png"),
        ]);
        $response->assertStatus(302);
        $filename = storage_path("app/assets/icon/category/project/demo.png");
        $this->assertFileExists($filename);
        unlink($filename);

        $response = $this->put(route("_socials.update", ['_social' => Category::where("type", Social::class)->first()->id]), [
            "name" => "updated social category",
            'icon' => UploadedFile::fake()->image("demo.png"),
        ]);
        $response->assertStatus(302);
        $filename = storage_path("app/assets/icon/category/social/demo.png");
        $this->assertFileExists($filename);
        unlink($filename);

        $response = $this->put(route("_services.update", ['_service' => Category::where("type", Service::class)->first()->id]), [
            "name" => "updated service category",
            'icon' => UploadedFile::fake()->image("demo.png"),
        ]);
        $response->assertStatus(302);
        $filename = storage_path("app/assets/icon/category/service/demo.png");
        $this->assertFileExists($filename);
        unlink($filename);

        $response = $this->put(route("_qualifications.update", ['_qualification' => Category::where("type", Qualification::class)->first()->id]), [
            "name" => "updated qualification category",
            'icon' => UploadedFile::fake()->image("demo.png"),
        ]);
        $response->assertStatus(302);
        $filename = storage_path("app/assets/icon/category/qualification/demo.png");
        $this->assertFileExists($filename);
        unlink($filename);
    }
}

  // $@gb@d02024
