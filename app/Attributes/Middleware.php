<?php

namespace App\Attributes;

use Attribute;
use App\Contracts\Middleware as MiddlewareContract;
use RuntimeException;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Middleware
{
    public function __construct(public string $middleware)
    {
        if (!($this->middleware instanceof MiddlewareContract)) {
            throw new RuntimeException('Middleware must implement MiddlewareContract');
        }
    }
}