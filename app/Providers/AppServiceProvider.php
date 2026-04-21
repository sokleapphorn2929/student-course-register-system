<?php

namespace App\Providers;

use App\Models\Courses;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('courses', Courses::all());
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
