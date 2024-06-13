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
        $this->user = $request->user();
        return $this->render($request, function ($request) {
            $skills = $this->user->skill()->limit(5)->get();
            $projects = $this->user->project()->limit(5)->get();
            $more = true;
            return view("pages.admin", compact('skills', 'projects', "more"))->render();
        });
    }
}
