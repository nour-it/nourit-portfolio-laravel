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
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected RedirectResponse $redirect;

    protected User $user;

    protected View $view;

    private ?string $html;

    public function render(Request $request, $render): Response|string
    {
        if (app()->environment() == "local") {
            $this->html = $render($request);
            $this->cleanHTML();
        } else {
            $cache_key = $request->fullUrl();
            $this->html = Cache::get($cache_key);
            if (is_null($this->html)) {
                if (!$render instanceof \Closure) {
                    $this->html = $render($request)->render();
                } else {
                    $this->html = $render($request);
                }
                $this->cleanHTML();
                Cache::put($cache_key, $this->html);
            }
        }
        return $this->html;
    }

    private function cleanHTML()
    {
        $this->html = Str::replace(["  ", "\t", "\n\n", " \n"], [" ", "\\", "\n", ""], $this->html);
    }
}
