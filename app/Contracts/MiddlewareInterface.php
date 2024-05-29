<?php

namespace App\Contracts;

use App\DTO\Request;

interface MiddlewareInterface
{

    public function handle(Request $request, callable|array $next);
}