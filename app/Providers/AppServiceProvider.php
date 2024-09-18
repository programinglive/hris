<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LogViewer;
use URL;

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
        LogViewer::auth(function ($request) {
            return $request->user()
                && $request->user()->email == config('app.admin_email');
        });

        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}