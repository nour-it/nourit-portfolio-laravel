<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function render(Request $request, $render)
    {
        if (app()->environment() == "local") {
            return $render($request);
        }
        $html = Cache::get($request->fullUrl());
        if (is_null($html)) {
            $html = $render($request);
            Cache::put($request->fullUrl(), $html);
        }
        return $html;
    }
}
