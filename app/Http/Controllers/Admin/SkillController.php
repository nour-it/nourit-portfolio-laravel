<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\UpdateSkillEvent;
use App\Events\ViewSkillPageEvent;
use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\SkillCategory;
use DateTime;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            $skills = Skill::paginate(15);
            return view("pages.admin", compact('skills'))->render();
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $this->render($request, function ($request) {
            $skill = new Skill();
            $categories = SkillCategory::all();
            return view("skill.edit", compact('skill', "categories"))->render();
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $skill = new Skill();
        UpdateSkillEvent::dispatch($skill, $request);
        return redirect(route("skills.index"))->with("success", "skill add successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $skill)
    {
        return $this->render($request, function ($request) use ($skill) {
            $skill = Skill::findOrFail($skill);
            return view("skill.edit", compact('skill'))->render();
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        UpdateSkillEvent::dispatch($skill, $request);
        return redirect(route("skills.index"))->with("success", "skill updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete_at = new DateTime();
        $skill->save();
        return redirect(route("skills.index"))->with("success", "skill delete successfully");
    }
}
