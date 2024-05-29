<?php

namespace App\Middlewares;

use App\Contracts\MiddlewareInterface;
use App\DTO\Request;

class SessionMiddleware implements MiddlewareInterface
{

    public function handle(Request $request, callable|array $next)
    {
        session_start();
        return $next($request);
    }
}