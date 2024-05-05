<?php

namespace App\Http\Controllers\Page;

use App\Events\ViewSkillPageEvent;
use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index (Request $request) {
        $skills = Skill::with("skillCategory", "images")->paginate(15);
        ViewSkillPageEvent::dispatch($request->ip());
        return view("pages.home", compact("skills"));
    }
}
