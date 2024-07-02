<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\UpdateProfileEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index(Request $request)
    {
        return $this->render($request, function (Request $request) {
            $user = $request->user();
            $this->view = view("pages.profile", compact("user"));
            return $this->view->render();
        });
    }

    public function update(Request $request, User $profile)
    {
        $this->user = $request->user();
        UpdateProfileEvent::dispatch($request, $profile);
        $this->redirect = redirect(route("profile.index"));
        return $this->redirect;
    }
}
