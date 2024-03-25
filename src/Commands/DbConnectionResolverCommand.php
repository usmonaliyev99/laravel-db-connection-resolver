<?php

namespace Usmonaliyev\DbConnectionResolver\Commands;

use Illuminate\Console\Command;

class DbConnectionResolverCommand extends Command
{
    public $signature = 'laravel-db-connection-resolver';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
