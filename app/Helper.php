<?php

namespace App;

use App\Jobs\ResizeImageJob;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class Helper
{

    CONST ADMIN_PAGE        = "pages.admin";
    CONST ADMIN_REPORT_PAGE = "pages.report";
    CONST DASHBOARD_PAGE    = "pages.dashboard";
    CONST USER_COUNT        = 1;

    static public function uploadFiles(string $key, string $path, Request $request)
    {
        $files = $request->allFiles($key);
        $paths = [];
        if (is_array($files)) {
            $paths[$key] = Arr::map($files, function ($file) use ($path) {
                if ($file === NULL) return;
                $name = $file->getClientOriginalName();
                $folder = $path;
                $path = $file->storeAs($path, $name);
                ResizeImageJob::dispatch($path, $folder . "/");
                return $path;
            });
        } else {
            $file = $files;
            if ($file !== NULL) {
                $name = $file->getClientOriginalName();
                $folder = $path;
                $paths[$key] = $file->storeAs($path, $name);
                ResizeImageJob::dispatch($paths[$key], $folder . "/");
            }
        }

        return $paths[$key];
    }
}
