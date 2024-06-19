<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\UpdateQualificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQualificationRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\Qualification;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $qualifications = Qualification::paginate(15);
            return view("pages.admin", compact('qualifications'))->render();
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
            return view("qualification.edit", compact('qualification', "categories"))->render();
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQualificationRequest $request)
    {
        $qualification = new Qualification();
        UpdateQualificationEvent::dispatch($qualification, $request);
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
            return view("qualification.edit", compact('qualification', 'categories'))->render();
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
        return redirect(route("qualifications.index"))->with("success", "qualification delete successfully");
    }
}
