<?php

use App\Http\Controllers\AccountDataController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TeacherController;
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
    Route::post("/dashboard",[DashboardController::class,"student"])->name("student.submit");
    Route::put("/dashboard/{id}",[DashboardController::class,"update"])->name("student.update");
    Route::delete("/dashboard/{id}",[DashboardController::class,"destroy"])->name("student.delete");

    Route::get("/teacher",[TeacherController::class,"showTeacher"])->name("teacher");
    Route::post("/teacher",[TeacherController::class,"teacher"])->name("teacher.submit");
    Route::put("/teacher/{id}",[TeacherController::class,"update"])->name("teacher.update");

    Route::get("/account",[AccountDataController::class,"showAccount"])->name("account");
    Route::post("/logout",[LoginController::class,"logout"])->name("logout"); 
    
    Route::post('/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('update-picture.submit');

    Route::post('/update-username', [AccountDataController::class, 'updateUsername'])->name('update-username');
    Route::post('/update-gender', [AccountDataController::class, 'updateGender'])->name('update-gender');
    Route::post('/update-role', [ProfileController::class, 'updateRole'])->name("update-role");
    Route::post('/update-dob', [AccountDataController::class, 'updateDob'])->name('update-dob');

    Route::get("/course",[CourseController::class, "showCourse"])->name("course");
    Route::post("/course",[CourseController::class, "course"])->name("course.submit");

    Route::delete("/course/delete/{id}", [CourseController::class, "destroy"])->name("course.delete");
    Route::put("/course/update/{id}", [CourseController::class, "update"])->name("course.update");
});