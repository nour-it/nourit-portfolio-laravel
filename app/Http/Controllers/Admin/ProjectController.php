<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\UpdateProjectEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
            $categories = ProjectCategory::all();
            return view("project.edit", compact('project', "categories"))->render();
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
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
        //
    }
}
