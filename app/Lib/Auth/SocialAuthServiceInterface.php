<?php

namespace App\Lib\Auth;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

interface SocialAuthServiceInterface {

    public function getPage(): RedirectResponse;

    public function getUser(): User|null;
}