<?php

namespace Usmonaliyev\DbConnectionResolver\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Usmonaliyev\DbConnectionResolver\DbConnectionResolver
 */
class DbConnectionResolver extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Usmonaliyev\DbConnectionResolver\DbConnectionResolver::class;
    }
}
