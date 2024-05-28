<?php

declare(strict_types = 1);

namespace App\Attributes;

use App\Contracts\RouteInterface;
use App\Enums\RequestMethod;
use Attribute;

#[Attribute(Attribute::TARGET_METHOD|Attribute::IS_REPEATABLE)]
class Route implements RouteInterface
{
    public function __construct(public string $routePath, public RequestMethod $method = RequestMethod::Get)
    {
    }
}