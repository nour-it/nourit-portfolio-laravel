<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\Admin\UpdateProjectEvent;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Repository\ProjectRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProjectController extends Controller
{

    public function __construct(private ProjectRepository $projectRepository)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $projects = $this->projectRepository->getUserProject($request->user());
            $this->view = view("pages.dashboard", compact('projects'));
            return $this->view->render();
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
            $this->view = view("project.edit", compact('project', "categories"));
            return $this->view->render();
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $project = new Project();
        $paths = [...Helper::uploadFiles("image", "upload/" . $user->id . "/projects/" . Str::lower($request->input("name")), $request)];
        broadcast(new UpdateProjectEvent($project, Arr::collapse([$request->all(), $paths])));
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
            $this->view = view("project.edit", compact('project', 'categories'));
            return $this->view->render();
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, Project $project)
    {
        $user = $request->user();
        $paths = [...Helper::uploadFiles("image", "upload/" . $user->id . "/projects/" . Str::lower($request->input("name")), $request)];
        broadcast(new UpdateProjectEvent($project, Arr::collapse([$request->all(), $paths])));
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
        $this->redirect = redirect(route("projects.index"));
        return $this->redirect->with("success", "project delete successfully");
    }
}
