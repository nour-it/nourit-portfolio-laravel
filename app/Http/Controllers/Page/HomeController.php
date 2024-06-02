<?php

namespace App\Http\Controllers\Page;

use App\Events\ViewSkillPageEvent;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $default = function ($request) {
            $skills = Skill::where(['delete_at' => NULL])->with("skillCategory", "images")->paginate(15);
            ViewSkillPageEvent::dispatch($request->ip());
            $header = "home-header";
            return view("pages.home", compact("skills", "header"))->render();
        };
        return $this->render($request, $default);
    }

    public function mail(Request $request)
    {
        $message = $request->only('name', 'email', 'project');
        Mail::to('reply.nourit@gmail.com')->send(new ContactMail($message));
        return redirect(route("home"))->with('success', 'Mail Send Successfully');
    }
}
