<?php

use App\Http\Controllers\admin\dashboardController as AdminDashboardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(["prefix" => "user"], function()
{
    Route::group(["middleware" => "guest"], function()
    {
        Route::get("/register", [LoginController::class, "register"])->name("user.register");
        Route::post("/register-process", [LoginController::class, "registerProcess"])->name("user.registerProcess");
        Route::get("/login", [LoginController::class, "index"])->name("user.login");
        Route::post("/authenticate", [LoginController::class, "authenticate"])->name("user.authenticate");
    });

    Route::group(["middleware" => "auth"], function()
    {
        Route::get("/dashboard", [dashboardController::class, "index"])->name("user.dashboard");
        Route::get("/logout", [LoginController::class, "logout"])->name("user.logout");
    });
});


Route::group(["prefix" => "admin"], function()
{
    Route::group(["middleware" => "admin.guest"], function()
    {
        Route::get("/login", [AdminLoginController::class, "index"])->name("admin.login");
        Route::post("/authenticate", [AdminLoginController::class, "authenticate"])->name("admin.authenticate");
    });

    Route::group(["middleware" => "admin.auth"], function()
    {
        Route::get("/dashboard", [AdminDashboardController::class, "index"])->name("admin.dashboard");
        Route::get("/logout", [AdminLoginController::class, "logout"])->name("admin.logout");
    });
});


