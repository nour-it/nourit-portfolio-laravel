<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repository\ServiceRepository;
use App\Repository\SkillRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    
    public function __construct(
        private SkillRepository $skillRepository,
        private UserRepository $userRepository
    ) {
    }

    public function index(Request $request, string $user)
    {
        return $this->render($request, function ($request) use ($user) {
            $slug = $user;
            $user = $this->userRepository->findUserByUsernameOrSlug($user, $slug);
            if (NULL === $user) {
                $this->redirect = redirect(route("home"), 301);
                return $this->redirect;
            }
            if ($user->slug != $slug) {
                $this->redirect = redirect(route("user.skill.page.index", ["user" => $user->slug]), 301);
                return $this->redirect;
            }
            $skills     = $this->skillRepository->getUserSkills($user);
            $contactLinks = $this->userRepository->getContactLink($user);
            $profileLinks = $this->userRepository->getProfileLink($user);
            $username     = $user->username;
            $this->view   = view("user.skills", compact('skills', "username", "contactLinks", "profileLinks", "user"));
            return $this->view->render();
        });
    }
}
