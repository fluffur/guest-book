<?php

namespace App\Controllers;

use App\Attributes\Controller;
use App\Attributes\Get;
use App\Attributes\Middleware;
use App\Attributes\Post;
use App\DTO\Request;
use App\Middlewares\SessionMiddleware;
use App\Services\AuthService;
use App\View;

#[Controller]
class AuthController
{

    public function __construct(protected AuthService $authService)
    {
    }

    #[Get('/login')]
    public function login(Request $request): View
    {
        return View::make('auth/login');
    }

    #[Get('/register')]
    public function register(Request $request): View
    {
        return View::make('auth/register');
    }


    #[Post('/login')]
    #[Middleware(SessionMiddleware::class)]
    public function processLogin(Request $request): void
    {
        $username = $request->body['username'] ?? null;
        $password = $request->body['password'] ?? null;

        $this->authService->processLogin($username, $password);

        header('Location: /');

    }

    #[Post('/register')]
    #[Middleware(SessionMiddleware::class)]
    public function processRegister(Request $request): void
    {
        $username = $request->body['username'] ?? null;
        $password = $request->body['password'] ?? null;

        $this->authService->processRegister($username, $password);

        header('Location: /');

    }

    #[Get('/logout')]
    #[Middleware(SessionMiddleware::class)]
    public function logout(Request $request): void
    {
        session_destroy();

        header('Location: /');

    }
}