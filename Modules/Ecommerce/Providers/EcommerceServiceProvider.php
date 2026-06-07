<?php

namespace Modules\Ecommerce\Providers;

use Illuminate\Support\ServiceProvider;

class EcommerceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerConfig();
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
        $viewPath = resource_path('views/modules/ecommerce');
        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([$sourcePath => $viewPath], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path.'/modules/ecommerce';
        }, config('view.paths')), [$sourcePath]), 'ecommerce');
    }

    public function provides()
    {
        return [];
    }
}
