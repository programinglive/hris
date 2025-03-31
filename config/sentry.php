<?php

return [
    'dsn' => env('SENTRY_LARAVEL_DSN'),

    // Capture release as git sha
    'release' => trim(exec('git log --pretty="%h" -n1 HEAD')),

    // Capture bindings on SQL queries
    'breadcrumbs.sql_bindings' => true,

    // Capture default user context
    'send_default_pii' => true,

    // Capture database queries
    'traces_sample_rate' => env('SENTRY_TRACES_SAMPLE_RATE', 0.1),

    // Environment
    'environment' => env('APP_ENV', 'production'),

    // Debug mode
    'debug' => env('APP_DEBUG', false),

    // Client configuration
    'client' => [
        'dsn' => env('SENTRY_LARAVEL_DSN'),
        'release' => trim(exec('git log --pretty="%h" -n1 HEAD')),
        'traces_sample_rate' => env('SENTRY_TRACES_SAMPLE_RATE', 0.1),
        'send_default_pii' => true,
        'breadcrumbs.sql_bindings' => true,
        'environment' => env('APP_ENV', 'production'),
        'debug' => env('APP_DEBUG', false),
    ],
];
