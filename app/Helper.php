<?php

namespace App;

use App\Jobs\ResizeImageJob;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class Helper
{

    const ADMIN_PAGE     = "pages.admin";
    const DASHBOARD_PAGE = "pages.dashboard";

    const USER_COUNT = 1;

    static public function uploadFiles(string $key, string $path, Request $request)
    {
        $files = $request->allFiles($key);
        $paths = [];
        if (is_array($files)) {
            $paths[$key] = Arr::map($files, function ($file) use ($path) {
                if ($file === NULL) return;
                $name = $file->getClientOriginalName();
                $path = $file->storeAs($path, $name);
                ResizeImageJob::dispatch($path, $path . "/");
                return $path;
            });
        } else {
            $file = $files;
            if ($file !== NULL) {
                $name = $file->getClientOriginalName();
                $paths[$key] = $file->storeAs($path, $name);
                ResizeImageJob::dispatch($paths[$key], $path . "/");
            }
        }
        // dd($path);
        return $paths[$key];
    }
}
