<?php

use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->encryptCookies(except: ['appearance']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        \Sentry\Laravel\Integration::handles($exceptions);

        // Initialize Sentry
        \Sentry\SentrySdk::init([
            'dsn' => env('SENTRY_LARAVEL_DSN'),
            'traces_sample_rate' => env('SENTRY_TRACES_SAMPLE_RATE', 1.0),
            'environment' => env('APP_ENV', 'production'),
            'release' => trim(exec('git log --pretty="%h" -n1 HEAD')),
            'send_default_pii' => true,
            'debug' => env('APP_DEBUG', false),
        ]);
    })->create();
