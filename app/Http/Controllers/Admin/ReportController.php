<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $user = $request->user();
            $years = $this->userRepository->report();
            $this->view = view(Helper::ADMIN_REPORT_PAGE, compact('years',  'user'));
            return $this->view->render();
        });
    }
}
