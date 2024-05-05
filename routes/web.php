<?php

use App\Http\Controllers\Page\HomeController;
use App\Http\Controllers\Page\ProjectController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

Route::get('/skills', [SkillController::class, "index"])->name('skill.page.index');
Route::get('/home', [HomeController::class, "index"])->name('skill.page.index');
Route::get('/projects', [ProjectController::class, "index"])->name('project.page.index');
Route::get('/projects/{project}', [ProjectController::class, "show"])->name('project.page.show');


Route::fallback([HomeController::class, "index"]);