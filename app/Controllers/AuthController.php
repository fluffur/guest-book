<?php

namespace App\Controllers;

use App\Attributes\Controller;
use App\Attributes\Get;
use App\View;

#[Controller]
class AuthController
{

    #[Get('/login')]
    public function login(): View
    {
        return View::make('auth/login');
    }

    #[Get('/register')]
    public function register(): View
    {
        return View::make('auth/register');
    }

}