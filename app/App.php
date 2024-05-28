<?php

namespace App;

use App\DTO\Request;
use App\Exceptions\RouteNotFoundException;
use App\Routing\Router;
use PDO;

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
        }
    }
}