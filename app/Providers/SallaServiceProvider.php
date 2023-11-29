<?php

namespace App\Providers;

use App\Services\SallaAuthService;
use App\Services\Salla\SallaService;
use Illuminate\Support\ServiceProvider;

class SallaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SallaService::class, function($app) {
            return new SallaService(
                config('salla.base_url')
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
