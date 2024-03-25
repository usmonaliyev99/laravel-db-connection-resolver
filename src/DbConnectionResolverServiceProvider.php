<?php

namespace Usmonaliyev\DbConnectionResolver;

use Illuminate\Support\ServiceProvider;

class DbConnectionResolverServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/db-connection-resolver.php', 'db-connection-resolver');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/db-connection-resolver.php' => config_path('db-connection-resolver.php'),
            ]);
        }
    }

    public function boot(): void
    {
    }
}
