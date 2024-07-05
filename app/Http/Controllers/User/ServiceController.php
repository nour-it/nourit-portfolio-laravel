<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use App\Repository\ProjectRepository;
use App\Repository\ServiceRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function __construct(
        private ServiceRepository $serviceRepository,
        private UserRepository $userRepository
    ) {
    }

    public function index(Request $request, string $user)
    {
        return $this->render($request, function ($request) use ($user) {
            $user = User::where("username", $user)->first();
            if (NULL === $user) {
                $this->redirect = redirect(route('service.page.index'), 301);
                return $this->redirect;
            }
            $services = $this->serviceRepository->getUserServices($user);
            $contactLinks = $this->userRepository->getContactLink($user);
            $profileLinks = $this->userRepository->getProfileLink($user);
            $username = $user->username;
            $this->view = view("user.services", compact('services', "username", "contactLinks", "profileLinks"));
            return $this->view->render();
        });
    }

    public function show(Request $request, int $service)
    {
        return $this->render($request, function ($request) use ($service) {
            $services = $this->serviceRepository->findPublicServices();
            $service = Service::findOrFail($service);
            $this->view = view("user.services", compact('services', 'service'));
            return $this->view->render();
        });
    }
}
