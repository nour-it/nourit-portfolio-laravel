<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function index(Request $request)
    {
        return $this->render($request, function (Request $request) {
            $users = $this->userRepository->findAll();
            $this->view = view("user.index", compact("users"));
            return $this->view->render();
        });
    }

    public function update(Request $request, User $user)
    {
    }
}
