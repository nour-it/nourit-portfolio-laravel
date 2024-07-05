<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $services = Service::where(["desable_at" => NULL])->paginate(15);
            $this->view = view("pages.services", compact('services'));
            return $this->view->render();
        });
    }

    public function show(Request $request, int $service)
    {
        return $this->render($request, function ($request) use ($service) {
            $services = Service::where(["delete_at" => NULL])->paginate(15);
            $service = Service::findOrFail($service);
            $this->view = view("pages.services", compact('services', 'service'));
            return $this->view->render();
        });
    }
}
