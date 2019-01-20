<?php

namespace AzureTran\Translate;

use Illuminate\Support\ServiceProvider;

class AzureTranServiceProvider extends ServiceProvider
{

    protected $defer = false;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/config/azure.php' => config_path('azure.php')]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/azure.php', 'azuretranslate'
        );
        
        $this->app->singleton('azuretranslate', function ($app) {
            return new AzureTran(
                $app['config']['azure.key'],
                $app['config']['azure.host'],
                $app['config']['azure.detectpath'],
                $app['config']['azure.transpath'],
                $app['config']['azure.transliterpath'],
                $app['config']['azure.languagepath']
            );
        });
    }

    public function provides()
    {
        return ['azuretranslate'];
    }
}
