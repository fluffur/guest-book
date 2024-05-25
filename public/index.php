<?php

declare(strict_types=1);


use App\App;
use App\Config;
use App\Container;
use App\DTO\Request;
use App\Enums\RequestMethod;
use App\Routing\ControllerResolver;
use App\Routing\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../configs/path_constants.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

$container = new Container();
$router = new Router($container, new ControllerResolver());

$request = new Request(RequestMethod::from($_SERVER['REQUEST_METHOD']), $_SERVER['REQUEST_URI']);

(new App(
    $container,
    $router,
    $request,
    new Config($_ENV)
))->run();
