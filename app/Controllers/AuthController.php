<?php

namespace App\Controllers;

use App\Attributes\Controller;
use App\Attributes\Get;
use App\Attributes\Middleware;
use App\Attributes\Post;
use App\DTO\Request;
use App\Middlewares\CsrfMiddleware;
use App\Middlewares\SessionMiddleware;
use App\Services\AuthService;
use App\Services\CsrfService;
use App\View;

#[Controller]
class AuthController
{

    public function __construct(protected AuthService $authService,
                                protected CsrfService $csrfService)
    {
    }

    #[Get('/login')]
    #[Middleware(SessionMiddleware::class)]
    public function showLogin(Request $request): View
    {
        $csrfToken = $this->csrfService->generateToken();
        return View::make('auth/login', ['csrf_token' => $csrfToken]);
    }

    #[Get('/register')]
    #[Middleware(SessionMiddleware::class)]
    public function showRegister(Request $request): View
    {
        $csrfToken = $this->csrfService->generateToken();
        return View::make('auth/register', ['csrf_token' => $csrfToken]);
    }


    #[Post('/login')]
    #[Middleware(SessionMiddleware::class)]
    #[Middleware(CsrfMiddleware::class)]
    public function doLogin(Request $request): void
    {
        $this->authService->processLogin($request->username, $request->password);

        header('Location: /');

    }

    #[Post('/register')]
    #[Middleware(SessionMiddleware::class)]
    #[Middleware(CsrfMiddleware::class)]
    public function doRegister(Request $request): void
    {
        $this->authService->processRegister($request->username, $request->password);

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