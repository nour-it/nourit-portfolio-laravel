<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\UpdateCategoryEvent;
use App\Events\Admin\UpdateSkillEvent;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreSkillRequest;
use App\Models\Category;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Repository\SkillRepository;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SkillController extends Controller
{
    private Category $category;

    public function __construct(private SkillRepository $skillRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $user = $request->user();
            $skills = $this->skillRepository->getCategories();
            $this->view = view('pages.admin', compact('skills', 'user'));
            return $this->view->render();
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $this->render($request, function ($request) {
            $_skill = new Category();
            $user = $request->user();
            $this->view = view('skill.edit', compact('_skill', 'user'));
            return $this->view->render();
        });
    }

    /**
     * store a newly created resource in storage.
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->category = new Category();
        $paths = [...Helper::uploadFiles('icon', 'assets/icon/category/skill', $request)];
        broadcast(new UpdateCategoryEvent($this->category, Arr::collapse([$request->all(), $paths]), Skill::class));
        $this->redirect = redirect(route('_skills.index'));
        return $this->redirect->with('success', 'skill add successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $_skill)
    {
        return $this->render($request, function ($request) use ($_skill) {
            $user = $request->user();
            $_skill = $this->skillRepository->findCategory($_skill);
            $this->view = view('skill.edit', compact('_skill', 'user'));
            return $this->view->render();
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $_skill)
    {
        $this->category = $_skill;
        $paths = [...Helper::uploadFiles('icon', 'assets/icon/category/skill', $request)];
        broadcast(new UpdateCategoryEvent($this->category, Arr::collapse([$request->all(), $paths]), Skill::class));
        $this->redirect = redirect(route('_skills.index'));
        return $this->redirect->with('success', 'skill updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $_skill)
    {
        $_skill->delete_at = new DateTime();
        $_skill->save();
        $this->redirect = redirect(route('_skills.index'));
        return $this->redirect->with('success', 'skill delete successfully');
    }
}
