<?php

namespace App\Http\Controllers\User;

use App\Events\ViewSkillPageEvent;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Skill;
use App\Models\User;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function __construct(
        private SkillRepository $skillRepository,
        private UserRepository $userRepository
    ) {
    }


    public function index(Request $request, string $user)
    {
        $user = User::where("username", $user)->first();
        if (NULL === $user) {
            $this->redirect = redirect(route("home"), 301);
            return $this->redirect;
        }
        $default = function ($request) use ($user) {
            $skills = $this->skillRepository->getUserSkills($user);
            $header = "home-header";
            $username = $user->username;
            return view("user.home", compact("skills", "header", "username"))->render();
        };
        return $this->render($request, $default);
    }

    public function mail(Request $request, string $user)
    {
        $receiver = $this->userRepository->findUserByUsernameOrMail($user);
        $message = $request->only('name', 'email', 'project');
        Mail::to($receiver)->send(new ContactMail($message));
        return redirect(route("user.home", ['user' => $user]))->with('success', 'Mail Send Successfully');
    }
}
