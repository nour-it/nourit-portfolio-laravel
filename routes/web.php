<?php

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Page\AdminController;
use App\Http\Controllers\Page\HomeController;
use App\Http\Controllers\Page\LoginController;
use App\Http\Controllers\Page\ProjectController;
use App\Http\Controllers\Page\RegisterController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\ProjectController as UserProjectController;
use Illuminate\Support\Facades\Route;

// Route::get('/',                 [HomeController::class, "index"])->name('home');
Route::get('/home',                 [HomeController::class, "index"])->name('home');
Route::get('/projects',             [ProjectController::class, "index"])->name('project.page.index');
Route::get('/projects/{project}',   [ProjectController::class, "show"])->name('project.page.show');

Route::get('/login',                [LoginController::class, "index"])->name('login');
Route::post('/login',               [LoginController::class, "attempt"])->name('login.attempt');
Route::post('/logout',              [LoginController::class, "logout"])->name('logout');

Route::get('/auth/redirect',        [SocialLoginController::class, "attempt"])->name("login.social");
Route::get('/auth/callback',        [SocialLoginController::class, "callback"])->name("auth.callback");

Route::get('/register',             [RegisterController::class, "index"])->name('register');
Route::post('/register',            [RegisterController::class, "store"])->name('register.new');
Route::get('/register/{token}',     [RegisterController::class, "confirme"])->name('register.confirme');

Route::fallback(fn () => redirect('/nour it'));

Route::prefix('dashboard')
    ->middleware('auth')
    ->group(function () {
        Route::get("/", [AdminController::class, "index"])->name("admin.home");
        Route::resource("/skills", AdminSkillController::class);
        Route::resource("/projects", AdminProjectController::class);
    });


Route::prefix('{user}')
    ->group(function () {
        Route::get('/',                     [UserHomeController::class, "index"])->name('user.home');
        Route::get('/projects',             [UserProjectController::class, "index"])->name('user.project.page.index');
    });


Route::post('contact/mail', [HomeController::class, "mail"])->name("contact.mail");


