<?php

namespace Modules\ERP;

use Illuminate\Support\ServiceProvider;

class ERPServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register ERP module bindings
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load ERP routes
        $this->loadRoutesFrom(__DIR__ . '/src/Routes/web.php');

        // Load ERP migrations
        $this->loadMigrationsFrom(__DIR__ . '/src/Migrations');

        // Load ERP views (if using blade)
        // $this->loadViewsFrom(__DIR__ . '/src/Views', 'erp');

        // Publish ERP config
        $this->publishes([
            __DIR__ . '/config/erp.php' => config_path('erp.php'),
        ], 'erp-config');
    }
}
