<?php

namespace App\Contracts;

use App\DTO\Request;

interface Middleware
{

    public function handle(Request $request, callable|array $next);
}