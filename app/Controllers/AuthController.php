<?php

namespace App\Controllers;

use App\Attributes\Controller;
use App\Attributes\Get;
use App\Attributes\Post;
use App\Services\AuthService;
use App\View;

#[Controller]
class AuthController
{

    public function __construct(protected AuthService $authService)
    {
    }

    #[Get('/login')]
    public function login(): View
    {
        session_start();

        return View::make('auth/login');
    }

    #[Get('/register')]
    public function register(): View
    {
        session_start();

        return View::make('auth/register');
    }


    #[Post('/login')]
    public function processLogin(): void
    {
        session_start();

        $this->authService->processLogin();

        header('Location: /');
    }

    #[Post('/register')]
    public function processRegister(): void
    {
        $this->authService->processRegister();

        header('Location: /');
    }

    #[Get('/logout')]
    public function logout()
    {
        session_start();

        session_destroy();

        header('Location: /');
    }
}