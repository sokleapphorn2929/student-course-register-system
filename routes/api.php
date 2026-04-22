<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseAPIController;
use App\Http\Controllers\Api\EnrollmentAPIController;
use App\Http\Controllers\Api\StudentAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TeacherAPIController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post("/register",[AuthController::class,"store"]);
Route::post("/login",[AuthController::class,"login"]);
Route::post("/logout",[AuthController::class,"logout"]);

Route::prefix("auth")->middleware(["auth:sanctum",'Admin'])->group(function(){
    Route::get("/",[AuthController::class,"index"]);
    Route::get("/me",[AuthController::class,"me"]);
    Route::get("/{id}",[AuthController::class,"show"]);
    Route::put("/{id}",[AuthController::class,"update"]);
    Route::delete("/{id}",[AuthController::class,"destroy"]);
});

Route::prefix("teachers")->middleware(["auth:sanctum","Teacher"])->group(function(){
    Route::get("/",[TeacherAPIController::class,"index"]);
    Route::post("/",[TeacherAPIController::class,"store"]);
    Route::get("/{id}",[TeacherAPIController::class,"show"]);
    Route::put("/{id}",[TeacherAPIController::class,"update"]);
    Route::delete("/{id}",[TeacherAPIController::class,"destroy"]);
});

Route::prefix("course")->middleware("auth:sanctum")->group(function(){
    Route::get("/",[CourseAPIController::class,"index"]);
    Route::post("/",[CourseAPIController::class,"store"]);
    Route::get("/{id}",[CourseAPIController::class,"show"]);
    Route::put("/{id}",[CourseAPIController::class,"update"]);
    Route::delete("/{id}",[CourseAPIController::class,"destroy"]);
});

Route::prefix("student")->middleware("auth:sanctum")->group(function(){
    Route::get("/",[StudentAPIController::class,"index"]);
    Route::post("/",[StudentAPIController::class,"store"]);
    Route::get("/{id}",[StudentAPIController::class,"show"]);
    Route::put("/{id}",[StudentAPIController::class,"update"]);
    Route::delete("/{id}",[StudentAPIController::class,"destroy"]);
});

Route::prefix("enrollment")->middleware(["auth:sanctum","Teacher"])->group(function(){
    Route::get("/",[EnrollmentAPIController::class,"index"]);
    Route::post("/",[EnrollmentAPIController::class,"store"]);
    Route::get("/{id}",[EnrollmentAPIController::class,"show"]);
    Route::put("/{id}",[EnrollmentAPIController::class,"update"]);
    Route::delete("/{id}",[EnrollmentAPIController::class,"destroy"]);
});