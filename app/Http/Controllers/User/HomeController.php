<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Repository\QualificationRepository;
use App\Repository\SkillRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $default = function ($request) use ($user) {
            $slug = $user;
            $user = $this->userRepository->findUserByUsernameOrSlug($user, $slug);
            if (NULL === $user) {
                $this->redirect = redirect(route("home"), 301);
                return $this->redirect;
            }
            if ($user->slug != $slug) {
                $this->redirect = redirect(route("user.home", ["user" => $user->slug]), 301);
                return $this->redirect;
            }
            $skills = $this->skillRepository->getUserSkills($user, 9);
            $qualifications = $this->qualificationRepository->getUserQualifications($user, 4);
            $contactLinks = $this->userRepository->getContactLink($user);
            $profileLinks = $this->userRepository->getProfileLink($user);
            $header = "home-header";
            $username = $user->username;
            $this->view = view("user.home", compact("skills", "header", "username", "qualifications", "user", "contactLinks", "profileLinks"));
            return $this->view->render();
        };
        return $this->render($request, $default);
    }

    public function mail(Request $request, string $user)
    {
        $receiver = $this->userRepository->findUserByUsernameOrMail($user);
        $message = $request->only('name', 'email', 'project');
        $sender = Auth::user();
        if ($sender) {
            $message['name'] = $sender->username;
            $message['email'] = $sender->email;
        }
        Mail::to($receiver)->send(new ContactMail($message));
        $this->redirect = redirect(route("user.home", ['user' => $user]));
        return $this->redirect->with('success', 'Mail Send Successfully');
    }
}
