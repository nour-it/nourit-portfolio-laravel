<?php

namespace App\Http\Controllers\User;

use App\Events\ViewSkillPageEvent;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Request $request, string $user)
    {
        $user = User::where("username", $user)->first();
        if (NULL === $user) {
            $this->redirect = redirect(route("home"), 301);
            return $this->redirect;
        }
        $default = function ($request) use ($user) {
            $skills = $user->skill()->where(['skillables.delete_at' => NULL])->with("skillCategory", "images")->paginate(15);
            ViewSkillPageEvent::dispatch($request->ip());
            $header = "home-header";
            return view("user.home", compact("skills", "header"))->render();
        };
        return $this->render($request, $default);
    }

    public function mail(Request $request)
    {
        $message = $request->only('name', 'email', 'project');
        Mail::to('reply.nourit@gmail.com')->send(new ContactMail($message));
        return redirect(route("user.home"))->with('success', 'Mail Send Successfully');
    }
}
