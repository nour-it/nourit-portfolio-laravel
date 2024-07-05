<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct(
        private ProjectRepository $projectRepository,
        private UserRepository $userRepository
    ) {
    }

    public function index(Request $request, string $user)
    {
        return $this->render($request, function ($request) use ($user): string {
            $user = User::where("username", $user)->first();
            if (NULL === $user) {
                $this->redirect = redirect(route("project.page.index"), 301);
                return $this->redirect;
            }
            $projects = $this->projectRepository->getUserProject($user);
            $contactLinks = $this->userRepository->getContactLink($user);
            $profileLinks = $this->userRepository->getProfileLink($user);
            $username = $user->username;
            $this->view = view("user.projects", compact('projects', "username", "contactLinks", "profileLinks"));
            return $this->view->render();
        });
    }

    public function show(Request $request, int $project)
    {
        return $this->render($request, function ($request) use ($project) {
            $projects = $this->projectRepository->findPublicProject();
            $project = Project::findOrFail($project);
            $this->view = view("user.projects", compact('projects', 'project'));
            return $this->view->render();
        });
    }
}
