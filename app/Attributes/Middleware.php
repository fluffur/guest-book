<?php

namespace App\Attributes;

use Attribute;
use App\Contracts\MiddlewareInterface;
use RuntimeException;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Middleware
{
    public function __construct(public string $middleware)
    {
        if (is_a($this->middleware, MiddlewareInterface::class)) {
            throw new RuntimeException('Middleware must implement MiddlewareInterface');
        }
    }
}