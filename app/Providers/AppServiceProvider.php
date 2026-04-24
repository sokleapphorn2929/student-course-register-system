<?php

namespace App\Providers;

use App\Models\Courses;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use App\Services\CloudinaryService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CloudinaryService::class, fn() => new CloudinaryService());
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
