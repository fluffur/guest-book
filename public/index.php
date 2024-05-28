<?php

declare(strict_types=1);


use App\App;
use App\Config;
use App\Container;
use App\Enums\RequestMethod;
use App\Middlewares\SessionMiddleware;
use App\Routing\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../configs/path_constants.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

$container = new Container();
$router = new Router($container);

$request = require_once './../configs/parse_request.php';

(new App(
    $container,
    $router,
    $request,
    new Config($_ENV)
))->run();
