<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Optimize Vite asset loading strategy.
        Vite::usePrefetchStrategy('aggressive');
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
