<?php

use App\Http\Controllers\AccountDataController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
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
    Route::get("/account",[AccountDataController::class,"showAccount"])->name("account");
    Route::post("/logout",[LoginController::class,"logout"])->name("logout"); 
    
    Route::post('/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('update-picture.submit');

    Route::post('/update-username', [AccountDataController::class, 'updateUsername'])->name('update-username');
    Route::post('/update-gender', [AccountDataController::class, 'updateGender'])->name('update-gender');
    Route::post('/update-dob', [AccountDataController::class, 'updateDob'])->name('update-dob');

    Route::get("/course",[CourseController::class, "showCourse"])->name("course");
    Route::post("/course",[CourseController::class, "course"])->name("course.submit");
});
// Route::get("/register",[RegisterController::class,"showRegister"])->name("register");
// Route::post("/register",[RegisterController::class,"register"])->name("register.submit");

// Route::get("/login",[LoginController::class,"showLogin"])->name("login");
// Route::post("/login",[LoginController::class,"login"])->name("login.submit");

// Route::get("/home",[HomeController::class,"showHome"])->name("home");