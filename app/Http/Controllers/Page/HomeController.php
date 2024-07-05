<?php

namespace App\Http\Controllers\Page;

use App\Events\ViewSkillPageEvent;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Skill;
use App\Models\User;
use App\Repository\SkillRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function __construct(
        private SkillRepository $skillRepository,
    ) {
    }


    public function index(Request $request)
    {
        $default = function ($request) {
            $skills = $this->skillRepository->getAvailableSkills();
            ViewSkillPageEvent::dispatch($request->ip());
            $header = "home-header";
            $this->view = view("pages.home", compact("skills", "header"));
            return $this->view->render();
        };
        return $this->render($request, $default);
    }

    public function mail(Request $request)
    {
        $message = $request->only('name', 'email', 'project');
        Mail::to(User::first())->send(new ContactMail($message));
        $this->redirect = redirect(route("home"));
        return $this->redirect->with('success', 'Mail Send Successfully');
    }
}
