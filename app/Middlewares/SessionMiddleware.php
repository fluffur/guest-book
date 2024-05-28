<?php

namespace App\Middlewares;

use App\Contracts\Middleware;
use App\DTO\Request;

class SessionMiddleware implements Middleware
{

    public function handle(Request $request, callable|array $next)
    {
        session_start();
        return $next($request);
    }
}