<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\UpdateSkillEvent;
use App\Events\Admin\UpdateSocialEvent;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\StoreSocialRequest;
use App\Models\Category;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\Social;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->user = $request->user();
        return $this->render($request, function ($request) {
            $user = $request->user();
            $socials = Social::paginate(15);
            $this->view = view("pages.admin", compact('socials', 'user'));
            return $this->view->render();
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $this->render($request, function ($request) {
            $_social = new Social();
            $user = $request->user();
            $this->view = view("social.edit", compact("_social", "user"));
            return $this->view->render();
        });
    }


    /**
     * store a newly created resource in storage.
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(StoreSocialRequest $request): RedirectResponse
    {
        $social = new Social();
        $paths = [...Helper::uploadFiles("icon", "assets/icon/social", $request)];
        broadcast(new UpdateSocialEvent($social, Arr::collapse([$request->all(), $paths])));
        $this->redirect = redirect(route("skills.index"));
        return $this->redirect->with("success", "skill add successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $_social)
    {
        return $this->render($request, function ($request) use ($_social) {
            $_social = Social::findOrFail($_social);
            $user = $request->user();
            $this->view = view("social.edit", compact('_social', 'user'));
            return $this->view->render();
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSocialRequest $request, Social $_social)
    {
        $paths = [...Helper::uploadFiles("icon", "assets/icon/social", $request)];
        broadcast(new UpdateSocialEvent($_social, Arr::collapse([$request->all(), $paths])));
        $this->redirect = redirect(route("_socials.index"));
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
