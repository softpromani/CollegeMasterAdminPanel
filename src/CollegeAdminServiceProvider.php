<?php

namespace CollegeAdmin;

use CollegeAdmin\Console\Commands\InstallCollegeAdminPackage;
use CollegeAdmin\Console\Commands\UpdateCollegeAdminPackage;
use CollegeAdmin\Http\Middleware\Localization;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CollegeAdminServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Merge package configuration
        $this->mergeConfigFrom(
            __DIR__ . '/../config/college-admin.php',
            'college-admin'
        );
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        // 1. Register Package Routes
        $this->registerRoutes();

        // 2. Register Package Views & Blade Components
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'college-admin');
        Blade::anonymousComponentPath(__DIR__ . '/../resources/views/components');
        Blade::anonymousComponentPath(__DIR__ . '/../resources/views/components', 'college-admin');

        // 3. Register Package Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // 4. Register Translations
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'college-admin');

        // 5. Register Middleware
        $this->app['router']->aliasMiddleware('localization', Localization::class);

        // 6. Console Publishing & Commands
        if ($this->app->runningInConsole()) {
            // Publish Configuration
            $this->publishes([
                __DIR__ . '/../config/college-admin.php' => config_path('college-admin.php'),
            ], 'college-admin-config');

            // Publish Static Assets (CSS/JS/Vendor)
            $this->publishes([
                __DIR__ . '/../public/assets' => public_path('vendor/college-admin/assets'),
            ], 'college-admin-assets');

            // Publish Views (Optional for customization)
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/college-admin'),
            ], 'college-admin-views');

            // Publish Migrations (Optional)
            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'college-admin-migrations');

            // Register Commands
            $this->commands([
                InstallCollegeAdminPackage::class,
                UpdateCollegeAdminPackage::class,
            ]);
        }
    }

    /**
     * Register the package routes.
     */
    protected function registerRoutes(): void
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    /**
     * Get the route group configuration array.
     */
    protected function routeConfiguration(): array
    {
        return [
            'prefix' => config('college-admin.route.prefix', 'admin'),
            'middleware' => config('college-admin.route.middleware', ['web', 'localization']),
        ];
    }
}
