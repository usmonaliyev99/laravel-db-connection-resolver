# laravel-db-connection-resolver

[![Latest Version on Packagist](https://img.shields.io/packagist/v/usmonaliyev/laravel-db-connection-resolver.svg?style=flat-square)](https://packagist.org/packages/usmonaliyev/laravel-db-connection-resolver)
[![Total Downloads](https://img.shields.io/packagist/dt/usmonaliyev/laravel-db-connection-resolver.svg?style=flat-square)](https://packagist.org/packages/usmonaliyev/laravel-db-connection-resolver)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/usmonaliyev/laravel-db-connection-resolver/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/usmonaliyev/laravel-db-connection-resolver/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)

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
