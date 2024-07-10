<?php

namespace App\Http\Controllers\Page;

use App\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $user           = $request->user();
            $skills         = $user->skill()->limit(5)->paginate();
            $projects       = $user->project()->limit(5)->paginate();
            $services       = $user->service()->limit(5)->paginate();
            $qualifications = $user->qualification()->limit(5)->paginate();
            $more           = true;
            $this->view     = view(Helper::ADMIN_PAGE, compact('skills', 'projects', 'services', 'qualifications', "more", 'user'));
            return $this->view->render();
        });
    }
}
