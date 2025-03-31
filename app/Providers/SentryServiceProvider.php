<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Sentry\SentrySdk;
use Sentry\State\HubInterface;

class SentryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(HubInterface::class, function () {
            return SentrySdk::getCurrentHub();
        });

        // Initialize Sentry
        SentrySdk::init(config('sentry.client'));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // No need to do anything in boot method since we're initializing in register
    }
}
