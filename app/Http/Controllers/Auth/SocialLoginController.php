<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Lib\Auth\GoogleAuthenticationService;
use App\Lib\Auth\SocialAuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class SocialLoginController extends Controller
{
    /**
     * @var string[]
     */
    private array $activeAuthService = [
        "google" => "google"
    ];

    /**
     * @var SocialAuthServiceInterface[]
     */
    private array $services;

    public function __construct()
    {
        $this->services = [
            "google" => new GoogleAuthenticationService()
        ];
    }

    public function attempt(Request $request)
    {
        return $this->services[$request->get("type")]?->getPage();
    }

    public function callback()
    {
        $prev = url()->previous();
        $socialType = substr($prev, strpos($prev, "=") + 1);
        // check if authentication type implemented
        if (Arr::has($this->activeAuthService, $socialType)) {
            $user = $this->services[$socialType]->getUser();
            Auth::login($user);
            $this->redirect = redirect(route("dashboard.home"));
            return $this->redirect->with("success", "Connected successfully");
        } else {
            $this->redirect = redirect(route("dashboard.home"));
            return $this->redirect->with("error", "this kind of authentication not implemented");
        }
    }
}
