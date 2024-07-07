<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RepositoryTest extends TestCase
{


    private UserRepository $userRepository;

    private ProjectRepository $projectRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository(new User());
        $this->projectRepository = new ProjectRepository(new Project(), new Category());
    }


    public function test_get_user_project()
    {
        $projects = $this->projectRepository->getUserProject(User::find(1));
        $this->assertCount(1, $projects);
    }
}
