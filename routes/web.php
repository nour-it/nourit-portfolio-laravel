<?php

// Dashboard Controller
use App\Http\Controllers\Dashboard\ProjectController as DashboardProjectController;
use App\Http\Controllers\Dashboard\QualificationController as DashboardQualificationController;
use App\Http\Controllers\Dashboard\ServiceController as DashboardServiceController;
use App\Http\Controllers\Dashboard\SkillController as DashboardSkillController;
use App\Http\Controllers\Dashboard\ProfileController as DashboardProfileController;
// use App\Http\Controllers\Dashboard\UserController as DashboardUserController;

// Admin Controller
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\QualificationController as AdminQualificationController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\SocialController as AdminSocialController;
// use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

// User Controller
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\ProjectController as UserProjectController;
use App\Http\Controllers\User\ServiceController as UserServiceController;
use App\Http\Controllers\User\SkillController as UserSkillController;

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Page\AdminController;
use App\Http\Controllers\Page\HomeController;
use App\Http\Controllers\Page\LoginController;
use App\Http\Controllers\Page\ProjectController;
use App\Http\Controllers\Page\RegisterController;
use App\Http\Controllers\Page\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/home',                 [HomeController::class, "index"])->name('home');

Route::get("/download", [FileController::class, "download"])->name("download");

Route::get('/projects',             [ProjectController::class, "index"])->name('project.page.index');
Route::get('/projects/{project}',   [ProjectController::class, "show"])->name('project.page.show');

Route::get('/services',             [ServiceController::class, "index"])->name('service.page.index');
Route::get('/services/{service}',   [ServiceController::class, "show"])->name('service.page.show');

Route::prefix("auth")
    ->group(function () {
        Route::get('/login',                [LoginController::class, "index"])->name('login');
        Route::post('/login',               [LoginController::class, "attempt"])->name('login.attempt');
        Route::post('/logout',              [LoginController::class, "logout"])->name('logout');

        Route::get('/redirect',        [SocialLoginController::class, "attempt"])->name("login.social");
        Route::get('/callback',        [SocialLoginController::class, "callback"])->name("auth.callback");

        Route::get('/register',             [RegisterController::class, "index"])->name('register');
        Route::post('/register',            [RegisterController::class, "store"])->name('register.new');
        Route::get('/register/{token}',     [RegisterController::class, "confirme"])->name('register.confirme');
    });

Route::prefix('dashboard')
    ->middleware('auth')
    ->group(function () {
        Route::get("/", [AdminController::class, "index"])->name("dashboard.home");
        Route::resource("/profile", DashboardProfileController::class)->only(["index", "update"]);
        Route::resource("/skills", DashboardSkillController::class);
        Route::resource("/projects", DashboardProjectController::class);
        Route::resource("/services", DashboardServiceController::class);
        Route::resource("/qualifications", DashboardQualificationController::class);
    })->name("dashboard.");

Route::prefix('admin')
    ->middleware('auth')
    ->middleware("can:admin")
    ->group(function () {
        Route::get("/_", [AdminController::class, "index"])->name("admin.home");
        Route::resource("/_skills", AdminSkillController::class);
        Route::resource("/_socials", AdminSocialController::class);
        Route::resource("/_projects", AdminProjectController::class);
        Route::resource("/_services", AdminServiceController::class);
        Route::resource("/_qualifications", AdminQualificationController::class);
        Route::resource("/_users", AdminUserController::class)->only(["index", "update"]);
    });

Route::prefix('{user}')
    ->group(function () {
        Route::get('/',                     [UserHomeController::class, "index"])->name('user.home');
        Route::get('/projects',             [UserProjectController::class, "index"])->name('user.project.page.index');
        Route::get('/services',             [UserServiceController::class, "index"])->name('user.service.page.index');
        Route::get('/skills',               [UserSkillController::class, "index"])->name('user.skill.page.index');
    });

Route::prefix("mail")
    ->group(function () {
        Route::post('contact', [HomeController::class, "mail"])->name("home.contact.mail");
        Route::post('contact/{user}', [UserHomeController::class, "mail"])->name("contact.mail");
    });



Route::fallback(fn () => redirect('/nour it'));
