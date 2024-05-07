<?php

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Page\AdminController;
use App\Http\Controllers\Page\HomeController;
use App\Http\Controllers\Page\LoginController;
use App\Http\Controllers\Page\ProjectController;
use App\Http\Controllers\Page\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, "index"])->name('home');
Route::get('/projects', [ProjectController::class, "index"])->name('project.page.index');
Route::get('/projects/{project}', [ProjectController::class, "show"])->name('project.page.show');

Route::get('/login', [LoginController::class, "index"])->name('login');
Route::get('/register', [RegisterController::class, "index"])->name('register');
Route::post('/register', [RegisterController::class, "store"])->name('register.new');
Route::get('/register/{token}', [RegisterController::class, "confirme"])->name('register.confirme');

// Route::fallback([HomeController::class, "index"]);

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get("/", [AdminController::class, "index"])->name("admin.home");
        Route::resource("/skills", AdminSkillController::class);
        Route::resource("/projects", AdminProjectController::class);
    });

Route::post('contact/mail', [HomeController::class, "mail"])->name("contact.mail");
