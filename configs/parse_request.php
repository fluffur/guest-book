<?php

use App\DTO\Request;
use App\Enums\RequestMethod;

$body = [];

parse_str(file_get_contents('php://input'), $body);

return new Request(
    RequestMethod::from($_SERVER['REQUEST_METHOD']),
    $_SERVER['REQUEST_URI'],
    $body
);