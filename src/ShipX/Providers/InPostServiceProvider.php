<?php

namespace Pixtech\InPost\ShipX\Providers;

use Illuminate\Support\ServiceProvider;

class InPostServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $path = realpath($raw = __DIR__ . '/../../');

//        include $path . '/routes/web.php';

        if(!file_exists($this->app->databasePath() . '/config/inpost.php')){
            $this->publishes([$path . '/config/inpost.php' => config_path('inpost.php')], 'config');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $path = realpath($raw = __DIR__ . '/../../');
        $this->mergeConfigFrom($path . '/config/inpost.php', 'inpost');
    }
}
