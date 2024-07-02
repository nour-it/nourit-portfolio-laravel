<?php

namespace App\Http\Controllers\User;

use App\Events\ViewSkillPageEvent;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Skill;
use App\Models\User;
use App\Repository\ProjectRepository;
use App\Repository\QualificationRepository;
use App\Repository\SkillRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function __construct(
        private SkillRepository $skillRepository,
        private UserRepository $userRepository,
        private QualificationRepository $qualificationRepository,
    ) {
    }


    public function index(Request $request, string $user)
    {
        $user = User::where("username", $user)
            ->with(["project" => fn ($q) => $q->with([])])
            ->first();
        if (NULL === $user) {
            $this->redirect = redirect(route("home"), 301);
            return $this->redirect;
        }
        $default = function ($request) use ($user) {
            $skills = $this->skillRepository->getUserSkills($user, 9);
            $qualifications = $this->qualificationRepository->getUserQualifications($user, 4);
            $header = "home-header";
            $username = $user->username;
            $this->view = view("user.home", compact("skills", "header", "username", "qualifications", "user"));
            return $this->view->render();
        };
        return $this->render($request, $default);
    }

    public function mail(Request $request, string $user)
    {
        $receiver = $this->userRepository->findUserByUsernameOrMail($user);
        $message = $request->only('name', 'email', 'project');
        Mail::to($receiver)->send(new ContactMail($message));
        $this->redirect = redirect(route("user.home", ['user' => $user]));
        return $this->redirect->with('success', 'Mail Send Successfully');
    }
}
