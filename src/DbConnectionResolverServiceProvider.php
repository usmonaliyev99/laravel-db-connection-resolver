<?php

namespace Usmonaliyev\DbConnectionResolver;

use Illuminate\Support\ServiceProvider;
use Usmonaliyev\DbConnectionResolver\Commands\DbConnectionResolverCommand;

class DbConnectionResolverServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/db-connection-resolver.php', 'db-connection-resolver');

        if ($this->app->runningInConsole()) {

            $this->commands([
                DbConnectionResolverCommand::class,
            ]);
        }
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../database/migrations/2024_03_25_152148_add_resolver_to_users_table.php' => database_path('migrations/2024_03_25_152148_add_resolver_to_users_table.php'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../config/db-connection-resolver.php' => config_path('db-connection-resolver.php'),
        ], 'config');
    }
}
