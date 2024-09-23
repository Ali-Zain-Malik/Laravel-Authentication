<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get("/user/login", [LoginController::class, "index"])->name("user.login");
Route::post("/user/authenticate", [LoginController::class, "authenticate"])->name("user.authenticate");