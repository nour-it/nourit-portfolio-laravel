<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\UpdateSkillEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Models\Category;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\Social;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->user = $request->user();
        return $this->render($request, function ($request) {
            $skills = Social::paginate(15);
            $this->view = view("pages.admin", compact('skills'));
            return $this->view->render();
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $this->render($request, function ($request) {
            $skill = new Skill();
            $categories = Category::where('type', Skill::class)->get();
            $this->view = view("skill.edit", compact('skill', "categories"));
            return $this->view->render();
        });
    }

      
    /**
     * store a newly created resource in storage.
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(StoreSkillRequest $request): RedirectResponse
    {
        $skill = new Skill();
        UpdateSkillEvent::dispatch($skill, $request);
        $this->redirect = redirect(route("skills.index"));
        return $this->redirect->with("success", "skill add successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $skill)
    {
        return $this->render($request, function ($request) use ($skill) {
            $skill = Skill::findOrFail($skill);
            $categories = Category::where('type', Skill::class)->get();
            $this->view = view("skill.edit", compact('skill', 'categories'));
            return $this->view->render();
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSkillRequest $request, Skill $skill)
    {
        UpdateSkillEvent::dispatch($skill, $request);
        $this->redirect = redirect(route("skills.index"));
        return $this->redirect->with("success", "skill updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete_at = new DateTime();
        $skill->save();
        $this->redirect = redirect(route("skills.index"));
        return $this->redirect->with("success", "skill delete successfully");
    }
}
