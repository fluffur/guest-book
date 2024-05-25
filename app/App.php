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
        protected Config    $config
    )
    {
        $db = new DB($this->config->db ?? []);
        $this->router->registerRoutesFromControllersInNamespace('\\App\\Controllers\\');
        $this->container->set(DB::class, fn($container) => $db);
    }

    public function run(): void
    {
        try {
            echo $this->router->resolve($this->request->uri, $this->request->method);
        } catch (RouteNotFoundException) {
            http_response_code(404);

            echo View::make('error/404');
        }
    }
}