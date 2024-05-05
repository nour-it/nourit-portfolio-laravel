<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $default = function ($request) {
            $projects = Project::paginate(15);
            return view("pages.projects", compact('projects'))->render();
        };
        return $this->render($request, $default);
    }

    public function show(Request $request, int $project)
    {
        $default = function ($request) use ($project){
            $projects = Project::paginate(15);
            $project = Project::findOrFail($project);
            return view("pages.projects", compact('projects', 'project'))->render();
        };
        return $this->render($request, $default);
    }
}
