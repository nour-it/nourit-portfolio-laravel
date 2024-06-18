<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\UpdateServiceEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\Service;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $services = Service::paginate(15);
            return view("pages.admin", compact('services'))->render();
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
            return view("service.edit", compact('service', "categories"))->render();
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $service = new Service();
        UpdateServiceEvent::dispatch($service, $request);
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
            return view("service.edit", compact('service', 'categories'))->render();
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreServiceRequest $request, Service $service)
    {
        
        UpdateServiceEvent::dispatch($service, $request);
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
        return redirect(route("services.index"))->with("success", "service delete successfully");
    }
}
