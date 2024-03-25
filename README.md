# laravel-db-connection-resolver

[![Latest Stable Version](http://poser.pugx.org/usmonaliyev/laravel-db-connection-resolver/v)](https://packagist.org/packages/usmonaliyev/laravel-db-connection-resolver)
[![Total Downloads](http://poser.pugx.org/usmonaliyev/laravel-db-connection-resolver/downloads)](https://packagist.org/packages/usmonaliyev/laravel-db-connection-resolver)
[![Latest Unstable Version](http://poser.pugx.org/usmonaliyev/laravel-db-connection-resolver/v/unstable)](https://packagist.org/packages/usmonaliyev/laravel-db-connection-resolver)
[![License](http://poser.pugx.org/usmonaliyev/laravel-db-connection-resolver/license)](https://packagist.org/packages/usmonaliyev/laravel-db-connection-resolver)
[![PHP Version Require](http://poser.pugx.org/usmonaliyev/laravel-db-connection-resolver/require/php)](https://packagist.org/packages/usmonaliyev/laravel-db-connection-resolver)

## Installation

You can install the package via composer:

```bash
composer require usmonaliyev/laravel-db-connection-resolver
```

You can publish the config and migration files with:

```bash
php artisan vendor:publish --provider="Usmonaliyev\DbConnectionResolver\DbConnectionResolverServiceProvider"
```

You can run migrations with:

```bash
php artisan migrate
```

## Usage

Add database connection to your `config/database.php`:

```bash
'connections' => [
    ...
    'pgsql' => [
        'driver' => 'pgsql',
        'url' => env('DATABASE_URL'),
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '5432'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        ...
    ],
    'foo' => [
      ...
    ],
    'bar' => [
        ...
    ]
]
```

You need to implement `resolveConnectionName` function into your `app/Models/User.php` file.

Or add `Usmonaliyev\DbConnectionResolver\Traits\ConnectionResolver` trait your User class. 

```bash
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Usmonaliyev\DbConnectionResolver\Traits\ConnectionResolver;

class User extends Authenticatable
{
    use ConnectionResolver, HasFactory, HasApiTokens;
    
    ...
```

To resolve database connection while accepting request, assign middleware to your routes.

```bash
use Usmonaliyev\DbConnectionResolver\Middleware\ConnectionResolverMiddleware; 
 
Route::middleware([ConnectionResolverMiddleware::class])->group(function () {
    
    Route::get('/', function () {
        //
    });
});
```

[Assigning middleware to routes](https://laravel.com/docs/8.x/middleware#assigning-middleware-to-routes)

## License

The MIT License ([MIT](LICENSE.md)).
