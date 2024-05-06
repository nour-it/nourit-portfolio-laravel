<?php

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Page\AdminController;
use App\Http\Controllers\Page\HomeController;
use App\Http\Controllers\Page\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, "index"])->name('skill.page.index');
Route::get('/projects', [ProjectController::class, "index"])->name('project.page.index');
Route::get('/projects/{project}', [ProjectController::class, "show"])->name('project.page.show');

Route::fallback([HomeController::class, "index"]);

Route::prefix('admin')->group(function () {
    Route::get("/", [AdminController::class, "index"])->name("admin.home");
    Route::resource("/skills", AdminSkillController::class);
    Route::resource("/projects", AdminProjectController::class);
});