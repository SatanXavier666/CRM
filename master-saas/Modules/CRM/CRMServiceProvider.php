<?php

namespace Modules\CRM;

use Illuminate\Support\ServiceProvider;

class CRMServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register CRM module bindings
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load CRM routes
        $this->loadRoutesFrom(__DIR__ . '/src/Routes/web.php');

        // Load CRM migrations
        $this->loadMigrationsFrom(__DIR__ . '/src/Migrations');

        // Load CRM views (if using blade)
        // $this->loadViewsFrom(__DIR__ . '/src/Views', 'crm');

        // Publish CRM config
        $this->publishes([
            __DIR__ . '/config/crm.php' => config_path('crm.php'),
        ], 'crm-config');
    }
}
