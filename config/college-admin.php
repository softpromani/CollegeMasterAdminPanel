<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Package Version
    |--------------------------------------------------------------------------
    */
    'version' => \CollegeAdmin\CollegeAdmin::VERSION,

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Route Configuration
    |--------------------------------------------------------------------------
    */
    'route' => [
        'prefix' => env('COLLEGE_ADMIN_PREFIX', 'admin'),
        'middleware' => ['web', 'localization'],
        'name_prefix' => 'admin.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guard & User Model
    |--------------------------------------------------------------------------
    */
    'auth' => [
        'guard' => 'web',
        'user_model' => \CollegeAdmin\Models\User::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Remote Version & Update Checking
    |--------------------------------------------------------------------------
    |
    | Configure the GitHub repository or custom API endpoint to check for
    | new updates and display update notifications in the admin dashboard.
    |
    */
    'updates' => [
        'check_enabled' => env('COLLEGE_ADMIN_CHECK_UPDATES', true),
        'github_repo' => env('COLLEGE_ADMIN_GITHUB_REPO', 'softpromani/college-admin'),
        'cache_duration_hours' => 12,
    ],

    /*
    |--------------------------------------------------------------------------
    | College Branding & Information
    |--------------------------------------------------------------------------
    */
    'branding' => [
        'app_name' => env('COLLEGE_ADMIN_NAME', 'College Master Admin'),
        'logo_path' => 'vendor/college-admin/assets/img/logo.png',
        'footer_text' => 'College Master Admin Panel',
    ],
];
