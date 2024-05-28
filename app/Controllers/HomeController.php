<?php

namespace App\Controllers;

use App\Attributes\Controller;
use App\Attributes\Get;
use App\Attributes\Middleware;
use App\DTO\Request;
use App\Middlewares\SessionMiddleware;
use App\View;

#[Controller]
class HomeController
{
    #[Get('/')]
    public function index(Request $request): View|string
    {
        return View::make('home');

    }
}