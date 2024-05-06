<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $skills = Skill::limit(5)->get();
            $projects = Project::limit(5)->get();
            return view("pages.admin", compact('skills', 'projects'))->render();
        });
    }
}
