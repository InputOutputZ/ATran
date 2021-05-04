<?php

namespace ATran\Translate;

use Illuminate\Support\ServiceProvider;

class ATranServiceProvider extends ServiceProvider
{

    protected $defer = false;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/config/atran.php' => config_path('atran.php')]);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/atran.php', 'atran'
        );

        $this->app->singleton('atran', function ($app) {
            return new ATran(
                $app['config']['atran.key'],
                $app['config']['atran.host'],
                $app['config']['atran.detectpath'],
                $app['config']['atran.transpath'],
                $app['config']['atran.transliterpath'],
                $app['config']['atran.languagepath']
            );
        });

        $this->app->make('\ATran\Translate\PlayWithAPIController');
    }

    public function provides()
    {
        return ['atran'];
    }
}
