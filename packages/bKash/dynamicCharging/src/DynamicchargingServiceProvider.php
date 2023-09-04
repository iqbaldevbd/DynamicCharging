<?php

namespace Bkash\Dynamiccharging;

use Illuminate\Support\ServiceProvider;

class DynamicchargingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->mergeConfigFrom(__DIR__.'/config/bkash.php', 'bkash');
        $this->publishes([
            __DIR__.'/config/bkash.php' => config_path('bkash.php'),
        ]);        
    }
}
