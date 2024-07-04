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
            $this->user     = $request->user();
            $skills         = $this->user->skill()->limit(5)->get();
            $projects       = $this->user->project()->limit(5)->get();
            $services       = $this->user->service()->limit(5)->get();
            $qualifications = $this->user->qualification()->limit(5)->get();
            $more           = true;
            return view("pages.admin", compact('skills', 'projects', 'services', 'qualifications', "more"))->render();
        });
    }
}
