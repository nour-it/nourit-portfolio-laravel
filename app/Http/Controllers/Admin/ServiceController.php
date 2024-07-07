<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\UpdateCategoryEvent;
use App\Events\Admin\UpdateServiceEvent;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreServiceRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\Service;
use App\Repository\ServiceRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
    private Category $category;

    public function __construct(private ServiceRepository $serviceRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $user = $request->user();
            $services = $this->serviceRepository->getCategories();
            $this->view = view("pages.admin", compact('services', 'user'));
            return $this->view->render();
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $this->render($request, function ($request) {
            $user = $request->user();
            $_service = new Category();
            $this->view = view("service.edit", compact('_service', "user"));
            return $this->view->render();
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->category = new Category();
        $paths = [...Helper::uploadFiles("icon", "assets/icon/category/service", $request)];
        broadcast(new UpdateCategoryEvent($this->category, Arr::collapse([$request->all(), $paths]), Service::class));
        $this->redirect = redirect(route("_services.index"));
        return $this->redirect->with("success", "project add successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $_service)
    {
        return $this->render($request, function ($request) use ($_service) {
            $user = $request->user();
            $_service =  $this->serviceRepository->findCategory($_service);
            $this->view = view("service.edit", compact('_service', 'user'));
            return $this->view->render();
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $_service)
    {
        $this->category = $_service;
        $paths = [...Helper::uploadFiles("icon", "assets/icon/category/service", $request)];
        broadcast(new UpdateCategoryEvent($this->category, Arr::collapse([$request->all(), $paths]), Service::class));
        $this->redirect = redirect(route("_services.index"));
        return $this->redirect->with("success", "service updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $_service)
    {
        $this->category = $_service;
        $this->category->delete_at = new DateTime();
        $this->category->save();
        $this->redirect = redirect(route("_services.index"));
        return $this->redirect->with("success", "service delete successfully");
    }
}
