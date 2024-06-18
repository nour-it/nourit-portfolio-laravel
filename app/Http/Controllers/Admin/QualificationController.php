<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $projects = Project::paginate(15);
            return view("pages.admin", compact('projects'))->render();
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $this->render($request, function ($request) {
            $project = new Project();
            $categories = Category::where('type', Project::class)->get();
            return view("project.edit", compact('project', "categories"))->render();
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $skill = new Project();
        UpdateProjectEvent::dispatch($skill, $request);
        $this->redirect = redirect(route("projects.index"));
        return $this->redirect->with("success", "project add successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $project)
    {
        return $this->render($request, function ($request) use ($project) {
            $project = Project::findOrFail($project);
            $categories = Category::where('type', Project::class)->get();
            return view("project.edit", compact('project', 'categories'))->render();
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, Project $project)
    {
        
        UpdateProjectEvent::dispatch($project, $request);
        $this->redirect = redirect(route("projects.index"));
        return $this->redirect->with("success", "project updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete_at = new DateTime();
        $project->save();
        return redirect(route("projects.index"))->with("success", "project delete successfully");
    }
}
