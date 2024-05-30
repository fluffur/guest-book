<?php

namespace App;

use App\DTO\Request;
use App\Exceptions\Auth\InvalidCredentialsException;
use App\Exceptions\Auth\UsernameTakenException;
use App\Exceptions\RouteNotFoundException;
use App\Routing\Router;

class App
{
    public function __construct(
        protected Container $container,
        protected Router    $router,
        protected Request   $request,
        protected Config    $config,
    )
    {
        $this->router->registerRoutesFromControllersInNamespace('\\App\\Controllers\\');
        $this->router->registerMiddlewaresFromControllersInNamespace('\\App\\Controllers\\');

        $db = new DB($this->config->db ?? []);
        $this->container->set(DB::class, fn($container) => $db);
    }

    public function run(): void
    {
        try {
            echo $this->router->resolve($this->request);
        } catch (RouteNotFoundException) {
            http_response_code(404);

            echo View::make('error/404');
        } catch (InvalidCredentialsException) {
            echo View::make('error/invalid_credentials',  ['csrf_token' => $_SESSION['csrf_token']]);
        } catch (UsernameTakenException) {
            echo View::make('error/username_taken', ['csrf_token' => $_SESSION['csrf_token']]);
        }
    }
}