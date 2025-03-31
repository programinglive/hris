<?php

/**
 * Sentry Laravel SDK configuration file.
 *
 * @see https://docs.sentry.io/platforms/php/guides/laravel/configuration/options/
 */
return [
    'dsn' => env('SENTRY_LARAVEL_DSN'),
    'release' => trim(exec('git log --pretty="%h" -n1 HEAD')),
    'traces_sample_rate' => (float) env('SENTRY_TRACES_SAMPLE_RATE', 1.0),
    'environment' => env('APP_ENV', 'production'),
    'send_default_pii' => true,
];
