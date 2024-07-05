<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class Helper
{

    const ADMIN_PAGE = "pages.admin";

    const USER_COUNT = 10;

    static public function uploadFiles(string $key, string $path, Request $request)
    {
        $files = $request->file($key);
        $paths = [];
        if (is_array($files)) {
            $paths[$key] = Arr::map($files, function ($file) use ($path) {
                if ($file === NULL) return;
                $name = $file->getClientOriginalName();
                $path = $file->storeAs($path, $name);
                return $path;
            });
        } else {
            $file = $files;
            if ($file !== NULL) {
                $name = $file->getClientOriginalName();
                $paths[$key] = $file->storeAs($path, $name);
            }
        }
        return $paths;
    }
}
