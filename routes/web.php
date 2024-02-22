<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

Route::get('/skills', [SkillController::class, "index"])->name('skill.page.index');
Route::get('/projects', [ProjectController::class, "index"])->name('project.page.index');
