<?php

namespace App\Middlewares;

use App\Contracts\MiddlewareInterface;
use App\DTO\Request;
use App\Enums\RequestMethod;
use App\Services\CsrfService;

class CsrfMiddleware implements MiddlewareInterface
{

    public function __construct(protected CsrfService $csrfService)
    {

    }

    public function handle(Request $request, callable|array $next)
    {
        if ($request->method !== RequestMethod::Post) {
            return $next($request);
        }
        if (!$this->csrfService->validateToken($request->body['csrf_token'] ?? '')) {
            die('CSRF Token validation failed');
        }

        return $next($request);

    }
}