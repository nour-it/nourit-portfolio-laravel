<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\UpdateCategoryEvent;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Qualification;
use App\Repository\QualificationRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class QualificationController extends Controller
{
    private Category $category;

    public function __construct(private QualificationRepository $qualificationRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $qualifications = $this->qualificationRepository->getCategories();
            $user = $request->user();
            $this->view = view("pages.admin", compact('qualifications', 'user'));
            return $this->view->render();
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $this->render($request, function ($request) {
            $user = $request->user();
            $_qualification = new Category();
            $this->view = view("qualification.edit", compact('_qualification', "user"));
            return $this->view->render();
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->category = new Category();
        $paths = [...Helper::uploadFiles("icon", "assets/icon/category/qualification", $request)];
        broadcast(new UpdateCategoryEvent($this->category, Arr::collapse([$request->all(), $paths]), Qualification::class));
        $this->redirect = redirect(route("_qualifications.index"));
        return $this->redirect->with("success", "qualification add successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $_qualification)
    {
        return $this->render($request, function ($request) use ($_qualification) {
            $user = $request->user();
            $_qualification =  $this->qualificationRepository->findCategory($_qualification);
            $this->view = view("qualification.edit", compact('_qualification', 'user'));
            return $this->view->render();
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $_qualification)
    {
        $this->category = $_qualification;
        $paths = [...Helper::uploadFiles("icon", "assets/icon/category/qualification", $request)];
        broadcast(new UpdateCategoryEvent($this->category, Arr::collapse([$request->all(), $paths]), Qualification::class));
        $this->redirect = redirect(route("qualifications.index"));
        return $this->redirect->with("success", "qualification updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $_qualification)
    {
        $this->category = $_qualification;
        $this->category->delete_at = new DateTime();
        $this->category->save();
        $this->redirect = redirect(route("_qualifications.index"));
        return $this->redirect->with("success", "qualification delete successfully");
    }
}
