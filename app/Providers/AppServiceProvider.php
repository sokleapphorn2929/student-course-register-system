<?php

namespace App\Providers;

use App\Models\Courses;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

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
        // View::share('courses', Courses::all());
        try {
            $courses = Courses::all();
            View::share('courses', $courses);
        } catch (\Exception $e) {
            // Log the error but don't crash
            Log::warning('Failed to load courses for view share: ' . $e->getMessage());
            View::share('courses', collect([]));
        }
        
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}
