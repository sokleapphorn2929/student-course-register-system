<?php

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