<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\UpdateProfileEvent;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Social;
use App\Models\User;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function index(Request $request)
    {
        return $this->render($request, function (Request $request) {
            $user = $request->user();
            $socials = Social::all();
            $types = $this->categoryRepository->socialType();
            $this->view = view("pages.profile", compact("user", "socials", "types"));
            return $this->view->render();
        });
    }

    public function update(Request $request, User $profile)
    {
        $this->user = $request->user();
        broadcast(new UpdateProfileEvent($request->all(), $profile));
        // UpdateProfileEvent::dispatch($request, $profile);
        $this->redirect = redirect(route("profile.index"));
        return $this->redirect;
    }
}
