<?php

declare(strict_types=1);

namespace App\Routing;

use App\Attributes\Route;
use App\Container;
use App\DTO\Request;
use App\Enums\RequestMethod;
use App\Exceptions\RouteNotFoundException;
use ReflectionClass;

class Router
{
    private array $routes = [];

    public function __construct(
        private Container          $container,
        private ControllerResolver $controllerResolver
    )
    {
    }

    public function registerRoutesFromControllersInNamespace(string $namespace): void
    {
        $this->registerRoutesFromControllerAttributes(
            $this->controllerResolver->getControllersFromNamespace($namespace)
        );
    }


    public function registerRoutesFromControllerAttributes(array $controllers): void
    {
        foreach ($controllers as $controller) {
            $reflectionController = new ReflectionClass($controller);

            foreach ($reflectionController->getMethods() as $method) {
                $attributes = $method->getAttributes(Route::class, \ReflectionAttribute::IS_INSTANCEOF);

                foreach ($attributes as $attribute) {
                    $route = $attribute->newInstance();

                    $this->register(new Request($route->method, $route->routePath), [$controller, $method->getName()]);
                }
            }
        }
    }


    public function register(Request $request, callable|array $action): self
    {
        $this->routes[$request->method->value][$request->uri] = $action;

        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->register(new Request(RequestMethod::Get, $route), $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register(new Request(RequestMethod::Post, $route), $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }

    public function resolve(Request $request)
    {
        $uriSplit = explode('?', $request->uri);
        $route = $uriSplit[0];

        if (isset($uriSplit[1])) {
            $rawQueryString = $uriSplit[1];
            parse_str($rawQueryString, $queryString);
            $request->queryString = $queryString;
        }
        $action = $this->routes[$request->method->value][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return $action($request);
        }

        [$class, $method] = $action;

        if (class_exists($class)) {
            $object = $this->container->get($class);

            if (method_exists($object, $method)) {

                return $object->$method($request);
            }
        }

        throw new RouteNotFoundException();
    }

}