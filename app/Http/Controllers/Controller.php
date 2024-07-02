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
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected RedirectResponse $redirect;

    protected User $user;

    protected View $view;

    public function render(Request $request, $render): Response|string
    {
        if (app()->environment() == "local") {
            return $render($request);
        }
        $cache_key = $request->fullUrl();
        $html = Cache::get($cache_key);
        if (is_null($html)) {
            if (!$render instanceof \Closure) {
                $html = $render($request)->render();
            } else {
                $html = $render($request);
            }
            Cache::put($cache_key, $html);
        }
        return $html;
    }
}
