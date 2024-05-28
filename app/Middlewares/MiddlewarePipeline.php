<?php

namespace App\Middlewares;

use App\Contracts\Middleware;
use App\DTO\Request;

class MiddlewarePipeline
{

    private array $middlewares = [];

    public function getMiddlewares()
    {
        return $this->middlewares;
    }
    public function add(Middleware $middleware): self
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    public function handle(Request $request, callable $next)
    {
        $middlewareStack = array_reverse($this->middlewares);
        $next = array_reduce(
            $middlewareStack,
            fn($next, $middleware) => fn($request) => $middleware->handle($request, $next),
            $next
        );

        return $next($request);

    }
}