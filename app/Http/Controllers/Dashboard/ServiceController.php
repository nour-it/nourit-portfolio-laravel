<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\Admin\UpdateServiceEvent;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\Service;
use App\Repository\ServiceRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ServiceController extends Controller
{

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
            $services = $this->serviceRepository->getUserServices($request->user());
            $this->view = view("pages.dashboard", compact('services', 'user'));
            return $this->view->render();
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $this->render($request, function ($request) {
            $service = new Service();
            $categories = Category::where('type', Service::class)->get();
            $this->view = view("service.edit", compact('service', "categories"));
            return $this->view->render();
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $user = $request->user();
        $service = new Service();
        $paths = [...Helper::uploadFiles("image", "upload/" . $user->id . "/services/" . Str::lower($request->input("title")), $request)];
        broadcast(new UpdateServiceEvent($service, Arr::collapse([$request->all(), $paths])));
        $this->redirect = redirect(route("services.index"));
        return $this->redirect->with("success", "project add successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $service)
    {
        return $this->render($request, function ($request) use ($service) {
            $service = Service::findOrFail($service);
            $categories = Category::where('type', Service::class)->get();
            $this->view = view("service.edit", compact('service', 'categories'));
            return $this->view->render();
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreServiceRequest $request, Service $service)
    {
        $user = $request->user();
        $paths = [...Helper::uploadFiles("image", "upload/" . $user->id . "/services/" . Str::lower($request->input("title")), $request)];
        broadcast(new UpdateServiceEvent($service, Arr::collapse([$request->all(), $paths])));
        $this->redirect = redirect(route("services.index"));
        return $this->redirect->with("success", "service updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(service $service)
    {
        $service->desable_at = new DateTime();
        $service->save();
        $this->redirect = redirect(route("services.index"));
        return $this->redirect->with("success", "service delete successfully");
    }
}
