<?php

namespace Usmonaliyev\DbConnectionResolver\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ConnectionResolverMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     *
     * @throws Exception
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth = auth()->user();

        if (! method_exists($auth, 'resolveConnectionName')) {
            throw new Exception('The resolveConnectionName function is not implemented in User class');
        }

        DB::setDefaultConnection($auth->resolveConnectionName());

        return $next($request);
    }
}
