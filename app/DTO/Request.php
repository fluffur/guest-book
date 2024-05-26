<?php

namespace App\DTO;

use App\Enums\RequestMethod;

class Request
{
    public function __construct(
        public readonly RequestMethod $method,
        public readonly string        $uri
    )
    {
    }
}
