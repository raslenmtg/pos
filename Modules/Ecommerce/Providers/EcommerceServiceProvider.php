<?php

namespace Modules\Ecommerce\Providers;

use Illuminate\Support\ServiceProvider;

class EcommerceServiceProvider extends ServiceProvider
{
    public function boot()
    {
      //  $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('ecommerce.php'),
        ], 'config');
        $this->mergeConfigFrom(__DIR__.'/../Config/config.php', 'ecommerce');
    }

    protected function registerViews()
    {
        $sourcePath = __DIR__.'/../Resources/views';

        $this->loadViewsFrom($sourcePath, 'ecommerce');
    }

    public function provides()
    {
        return [];
    }
}
