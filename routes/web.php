<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get("/",function(){
    return redirect()->route("login");
});

Route::middleware("guest")->group(function(){
    Route::get("/register",[RegisterController::class,"showRegister"])->name("register");
    Route::post("/register",[RegisterController::class,"register"])->name("register.submit");
    
    Route::get("/login",[LoginController::class,"showLogin"])->name("login");
    Route::post("/login",[LoginController::class,"login"])->name("login.submit");
    });
    
Route::middleware("auth")->group(function(){
    Route::get("/dashboard",[DashboardController::class,"showDashboard"])->name("dashboard");
    Route::post("/logout",[LoginController::class,"logout"])->name("logout");    
});
// Route::get("/register",[RegisterController::class,"showRegister"])->name("register");
// Route::post("/register",[RegisterController::class,"register"])->name("register.submit");

// Route::get("/login",[LoginController::class,"showLogin"])->name("login");
// Route::post("/login",[LoginController::class,"login"])->name("login.submit");

// Route::get("/home",[HomeController::class,"showHome"])->name("home");