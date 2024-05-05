<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::paginate(15);
        return view("pages.projects", compact('projects'));
    }

    public function show(Request $request, Project $project)
    {
        $projects = Project::paginate(15);
        return view("pages.projects", compact('projects', 'project'));
    }
}
