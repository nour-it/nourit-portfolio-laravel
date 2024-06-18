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
        $default = function ($request) {
            $services = Service::where(["desable_at" => NULL])->paginate(15);
            return view("pages.projects", compact('services'))->render();
        };
        return $this->render($request, $default);
    }

    public function show(Request $request, int $service)
    {
        $default = function ($request) use ($service){
            $services = Service::where(["delete_at" => NULL])->paginate(15);
            $service = Service::findOrFail($service);
            return view("pages.projects", compact('services', 'service'))->render();
        };
        return $this->render($request, $default);
    }
}
