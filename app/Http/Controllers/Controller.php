<?php

namespace App\Http\Controllers;

use App\Models\User;
use Closure;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected RedirectResponse $redirect;

    protected User $user;

    

    public function render(Request $request, $render): Response|string
    {
        if (app()->environment() == "local") {
            return $render($request);
        }
        $html = Cache::get($request->fullUrl());
        if (is_null($html)) {
            // dd(get_class($render), $render);
            if (!$render instanceof \Closure) {
                $html = $render($request)->render();
            } else {
                $html = $render($request);
            }
            Cache::put($request->fullUrl(), $html);
        }
        return $html;
    }
}
