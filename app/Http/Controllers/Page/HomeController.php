<?php

namespace App\Http\Controllers\Page;

use App\Events\ViewSkillPageEvent;
use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $default = function ($request) {
            $skills = Skill::with("skillCategory", "images")->paginate(15);
            ViewSkillPageEvent::dispatch($request->ip());
            $header = "home-header";
            return view("pages.home", compact("skills", "header"))->render();
        };
        return $this->render($request, $default);
    }
}
