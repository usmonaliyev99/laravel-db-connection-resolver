<?php

namespace Usmonaliyev\DbConnectionResolver\Traits;

trait ConnectionResolver
{
    public function resolveConnectionName(): string
    {
        return $this->resolver ?: config('db-connection-resolver.default');
    }
}
