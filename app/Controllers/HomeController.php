<?php

namespace App\Controllers;

use App\Attributes\Controller;
use App\Attributes\Get;
use App\DB;
use App\View;

#[Controller]
class HomeController
{
    #[Get('/')]
    public function index(): View|string
    {
        session_start();

        return View::make('home');

    }
}