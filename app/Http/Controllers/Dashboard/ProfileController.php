<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\Admin\UpdateProfileEvent;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileRequest;
use App\Models\Social;
use App\Models\User;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function index(Request $request)
    {
        return $this->render($request, function (Request $request) {
            $user = $request->user();
            $user->load(["link" => fn ($q) => $q->with("category"), "resume"]);
            $socials = Social::with(['images'])->get();
            $types = $this->categoryRepository->socialType();
            $this->view = view("pages.profile", compact("user", "socials", "types"));
            return $this->view->render();
        });
    }

    public function update(StoreProfileRequest $request, User $profile)
    {
        $this->user = $request->user();
        $folder = "upload" . DIRECTORY_SEPARATOR . $this->user->id . DIRECTORY_SEPARATOR ;
        $paths = [
            ...Helper::uploadFiles("resume", $folder . "images/resume", $request),
            ...Helper::uploadFiles("profile", $folder . "images/profile", $request),
            ...Helper::uploadFiles("about_img", $folder . "images/about", $request),
        ];
        broadcast(new UpdateProfileEvent([...$request->all(), ...$paths], $profile))->via('pusher');
        // UpdateProfileEvent::dispatch([...$request->all(), ...$paths], $profile);
        $this->redirect = redirect(route("profile.index"));
        return $this->redirect;
    }
}
