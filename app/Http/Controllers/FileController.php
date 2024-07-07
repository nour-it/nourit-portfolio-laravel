<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download(Request $request)
    {
        if (Storage::fileExists($request->get("file"))) {
            return Storage::download($request->get("file"));
        }
        return "not found";
    }
}
