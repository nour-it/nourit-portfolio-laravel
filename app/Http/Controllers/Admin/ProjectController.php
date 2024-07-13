<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\UpdateCategoryEvent;
use App\Events\Admin\UpdateProjectEvent;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Category;
use App\Models\Project;
use App\Repository\ProjectRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProjectController extends Controller
{

    private Category $category;


    public function __construct(private ProjectRepository $projectRepository)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $user = $request->user();
            $projects = $this->projectRepository->getCategories();
            $this->view = view("pages.admin", compact('projects', 'user'));
            return $this->view->render();
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $this->render($request, function ($request) {
            $_project = new Category();
            $user = $request->user();
            $this->view = view("project.edit", compact('_project', "user"));
            return $this->view->render();
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->category = new Category();
        $paths = [...Helper::uploadFiles("icon", "assets/icon/category/project", $request)];
        broadcast(new UpdateCategoryEvent($this->category, Arr::collapse([$request->all(), $paths]), Project::class));
        $this->redirect = redirect(route("_projects.index"));
        return $this->redirect->with("success", "project add successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $_project)
    {
        return $this->render($request, function ($request) use ($_project) {
            $_project = $this->projectRepository->findCategory($_project);
            $user = $request->user();
            $this->view = view("project.edit", compact('_project', 'user'));
            return $this->view->render();
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $_project)
    {
        $this->category = $_project;
        $paths = [...Helper::uploadFiles("icon", "assets/icon/category/project", $request)];
        broadcast(new UpdateCategoryEvent($this->category, Arr::collapse([$request->all(), $paths]), Project::class));
        $this->redirect = redirect(route("projects.index"));
        return $this->redirect->with("success", "project updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $_project)
    {
        $this->category = $_project;
        $this->category->delete_at = new DateTime();
        $this->category->save();
        $this->redirect = redirect(route("_projects.index"));
        return $this->redirect->with("success", "project delete successfully");
    }
}
