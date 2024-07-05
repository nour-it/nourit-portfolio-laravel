<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        private ProjectRepository $projectRepository,
        private UserRepository $userRepository,
    ) {
    }

    public function index(Request $request)
    {
        return $this->render($request,  function ($request) {
            $projects = Project::where(["delete_at" => NULL])->paginate(15);
            $this->view = view("pages.projects", compact('projects'));
            return $this->view->render();
        });
    }

    public function show(Request $request, int $project)
    {
        return $this->render($request,  function ($request) use ($project) {
            $project = Project::findOrFail($project);
            $projectUser = $project->user;
            $projects = $this->projectRepository->getUserProject($projectUser);
            $profileLinks = $this->userRepository->getProfileLink($projectUser);
            $this->view = view("pages.projects", compact('projects', 'project', 'profileLinks'));
            return $this->view->render();
        });
    }
}
