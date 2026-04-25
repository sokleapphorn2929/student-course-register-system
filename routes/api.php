<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseAPIController;
use App\Http\Controllers\Api\EnrollmentAPIController;
use App\Http\Controllers\Api\StudentAPIController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TeacherAPIController;

Route::post("/register", [AuthController::class, "store"]);
Route::post("/login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"]);

Route::get("public/student", [StudentAPIController::class, "index"]);
Route::get("public/student/{id}", [StudentAPIController::class, "show"]);

Route::middleware(["auth:sanctum", "Admin"])->group(function() {
    Route::prefix("auth")->group(function() {
        Route::get("/", [AuthController::class, "index"]);
        Route::get("/me", [AuthController::class, "me"]);
        Route::get("/{id}", [AuthController::class, "show"]);
        Route::put("/{id}", [AuthController::class, "update"]);
        Route::delete("/{id}", [AuthController::class, "destroy"]);
    });

    Route::prefix("teachers")->group(function() {
        Route::get("/", [TeacherAPIController::class, "index"]);
        Route::post("/", [TeacherAPIController::class, "store"]);
        Route::get("/{id}", [TeacherAPIController::class, "show"]);
        Route::put("/{id}", [TeacherAPIController::class, "update"]);
        Route::delete("/{id}", [TeacherAPIController::class, "destroy"]);
    });

    Route::prefix("course")->group(function() {
        Route::get("/", [CourseAPIController::class, "index"]);
        Route::post("/", [CourseAPIController::class, "store"]);
        Route::get("/{id}", [CourseAPIController::class, "show"]);
        Route::put("/{id}", [CourseAPIController::class, "update"]);
        Route::delete("/{id}", [CourseAPIController::class, "destroy"]);
    });

    Route::prefix("student")->group(function() {
        Route::get("/", [StudentAPIController::class, "index"]);
        Route::post("/", [StudentAPIController::class, "store"]);
        Route::get("/{id}", [StudentAPIController::class, "show"]);
        Route::put("/{id}", [StudentAPIController::class, "update"]);
        Route::delete("/{id}", [StudentAPIController::class, "destroy"]);
    });

    Route::prefix("enrollment")->group(function() {
        Route::get("/", [EnrollmentAPIController::class, "index"]);
        Route::post("/", [EnrollmentAPIController::class, "store"]);
        Route::get("/{id}", [EnrollmentAPIController::class, "show"]);
        Route::put("/{id}", [EnrollmentAPIController::class, "update"]);
        Route::delete("/{id}", [EnrollmentAPIController::class, "destroy"]);
    });
});

Route::middleware(["auth:sanctum", "Teacher"])->group(function() {
    Route::prefix("student")->group(function() {
        Route::get("/", [StudentAPIController::class, "index"]);
        Route::post("/", [StudentAPIController::class, "store"]);
        Route::get("/{id}", [StudentAPIController::class, "show"]);
        Route::put("/{id}", [StudentAPIController::class, "update"]);
        Route::delete("/{id}", [StudentAPIController::class, "destroy"]);
    });

    Route::prefix("enrollment")->group(function() {
        Route::get("/", [EnrollmentAPIController::class, "index"]);
        Route::get("/{id}", [EnrollmentAPIController::class, "show"]);
        Route::put("/{id}", [EnrollmentAPIController::class, "update"]);
    });
});

Route::middleware(["auth:sanctum", "Student"])->group(function() {
    Route::get("/student/me", [StudentAPIController::class, "me"]);
    Route::get("/student/{id}", [StudentAPIController::class, "show"]);
    
    Route::prefix("enrollment")->group(function() {
        Route::get("/", [EnrollmentAPIController::class, "index"]);
        Route::get("/my-enrollments", [EnrollmentAPIController::class, "myEnrollments"]);
        Route::get("/{id}", [EnrollmentAPIController::class, "show"]);
    });
    
    Route::prefix("course")->group(function() {
        Route::get("/", [CourseAPIController::class, "index"]);
        Route::get("/{id}", [CourseAPIController::class, "show"]);
    });
});

Route::middleware("auth:sanctum")->group(function() {
    Route::prefix("teachers")->group(function() {
        Route::get("/", [TeacherAPIController::class, "index"]);
        Route::get("/{id}", [TeacherAPIController::class, "show"]);
    });

    Route::prefix("course")->group(function() {
        Route::get("/", [CourseAPIController::class, "index"]);
        Route::get("/{id}", [CourseAPIController::class, "show"]);
    });
    
    Route::prefix("student")->group(function() {
        Route::get("/", [StudentAPIController::class, "index"]);
        Route::get("/{id}", [StudentAPIController::class, "show"]);
    });

    Route::prefix("enrollment")->group(function() {
        Route::get("/", [EnrollmentAPIController::class, "index"]);
        Route::get("/{id}", [EnrollmentAPIController::class, "show"]);
    });
});