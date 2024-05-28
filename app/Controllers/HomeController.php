<?php

namespace App\Controllers;

use App\Attributes\Controller;
use App\Attributes\Get;
use App\DTO\Request;
use App\View;

#[Controller]
class HomeController
{
    #[Get('/')]
    public function index(Request $request): View
    {
        return View::make('home');

    }
}