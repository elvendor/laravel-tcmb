<?php

namespace Elvendor\Tcmb;

use Illuminate\Support\ServiceProvider;
use Elvendor\Tcmb\Commands\SyncRatesCommand;

class TcmbServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('tcmb.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../database/migrations/' => database_path('migrations')
            ], 'migrations');

            $this->commands([
                SyncRatesCommand::class
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'tcmb');
        $this->app->singleton('tcmb', function () {
            return new Tcmb;
        });
    }
}
