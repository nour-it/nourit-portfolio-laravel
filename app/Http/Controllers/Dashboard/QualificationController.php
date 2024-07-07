<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\Admin\UpdateQualificationEvent;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQualificationRequest;
use App\Models\Category;
use App\Models\Qualification;
use App\Repository\QualificationRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class QualificationController extends Controller
{

    public function __construct(private QualificationRepository $qualificationRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $qualifications = $this->qualificationRepository->getUserQualifications($request->user());
            $this->view = view("pages.dashboard", compact('qualifications'));
            return $this->view->render();
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $this->render($request, function ($request) {
            $qualification = new Qualification();
            $categories = Category::where('type', Qualification::class)->get();
            $this->view = view("qualification.edit", compact('qualification', "categories"));
            return $this->view->render();
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQualificationRequest $request)
    {
        $user = $request->user();
        $qualification = new Qualification();
        $paths = [...Helper::uploadFiles("image", "upload/" . $user->id . "/qualifications/" . Str::lower($request->input("name")), $request)];
        broadcast(new UpdateQualificationEvent($qualification, Arr::collapse([$request->all(), $paths])));
        $this->redirect = redirect(route("qualifications.index"));
        return $this->redirect->with("success", "qualification add successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $qualification)
    {
        return $this->render($request, function ($request) use ($qualification) {
            $qualification = Qualification::findOrFail($qualification);
            $categories = Category::where('type', Qualification::class)->get();
            $this->view = view("qualification.edit", compact('qualification', 'categories'));
            return $this->view->render();
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreQualificationRequest $request, Qualification $qualification)
    {
        UpdateQualificationEvent::dispatch($qualification, $request);
        $this->redirect = redirect(route("qualifications.index"));
        return $this->redirect->with("success", "qualification updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qualification $qualification)
    {
        $qualification->delete_at = new DateTime();
        $qualification->save();
        $this->redirect = redirect(route("qualifications.index"));
        return $this->redirect->with("success", "qualification delete successfully");
    }
}
