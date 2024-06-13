<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Repository\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct(private ProjectRepository $projectRepository) {
    }
    
    public function index(Request $request)
    {
        $default = function ($request) {
            $projects = $this->projectRepository->findPublicProject();
            return view("user.projects", compact('projects'))->render();
        };
        return $this->render($request, $default);
    }

    public function show(Request $request, int $project)
    {
        $default = function ($request) use ($project) {
            $projects = $this->projectRepository->findPublicProject();
            $project = Project::findOrFail($project);
            return view("user.projects", compact('projects', 'project'))->render();
        };
        return $this->render($request, $default);
    }
}
