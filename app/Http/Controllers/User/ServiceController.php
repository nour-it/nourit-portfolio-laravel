<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use App\Repository\ProjectRepository;
use App\Repository\ServiceRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function __construct(private ServiceRepository $serviceRepository)
    {
    }

    public function index(Request $request, string $user)
    {
        $user = User::where("username", $user)->first();
        if (NULL === $user) {
            $this->redirect = redirect(route('service.page.index'), 301);
            return $this->redirect;
        }
        $default = function ($request) use ($user) {
            $services = $this->serviceRepository->findPublicServices();
            $username = $user->username;
            return view("user.services", compact('services', "username"))->render();
        };
        return $this->render($request, $default);
    }

    public function show(Request $request, int $service)
    {
        $default = function ($request) use ($service) {
            $services = $this->serviceRepository->findPublicServices();
            $service = Service::findOrFail($service);
            return view("user.services", compact('services', 'service'))->render();
        };
        return $this->render($request, $default);
    }
}
