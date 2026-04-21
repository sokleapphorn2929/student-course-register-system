<?php

use App\Http\Controllers\Api\CourseAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TeacherAPIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix("teachers")->group(function(){
    Route::get("/",[TeacherAPIController::class,"index"]);
    Route::post("/",[TeacherAPIController::class,"store"]);
    Route::get("/{id}",[TeacherAPIController::class,"show"]);
    Route::put("/{id}",[TeacherAPIController::class,"update"]);
    Route::delete("/{id}",[TeacherAPIController::class,"destroy"]);
});

Route::prefix("course")->group(function(){
    Route::get("/",[CourseAPIController::class,"index"]);
    Route::post("/",[CourseAPIController::class,"store"]);
    Route::get("/{id}",[CourseAPIController::class,"show"]);
    Route::put("/{id}",[CourseAPIController::class,"update"]);
    Route::delete("/{id}",[CourseAPIController::class,"destroy"]);
});

Route::prefix("student")->group(function(){
    Route::get("/",[CourseAPIController::class,"index"]);
    Route::post("/",[CourseAPIController::class,"store"]);
    Route::get("/{id}",[CourseAPIController::class,"show"]);
    Route::put("/{id}",[CourseAPIController::class,"update"]);
    Route::delete("/{id}",[CourseAPIController::class,"destroy"]);
});