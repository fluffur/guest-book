<?php

declare(strict_types=1);

namespace App\Routing;

use App\Attributes\Route;
use App\Container;
use App\DTO\RequestBody;
use App\Enums\RequestMethod;
use App\Exceptions\RouteNotFoundException;
use http\Exception\RuntimeException;
use ReflectionClass;
use ReflectionIntersectionType;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;

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

                    $this->register($route->method->value, $route->routePath, [$controller, $method->getName()]);
                }
            }
        }
    }

    public function register(string $requestMethod, string $route, callable|array $action): self
    {
        $this->routes[$requestMethod][$route] = $action;

        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->register('get', $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register('post', $route, $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }

    public function resolve(string $requestUri, RequestMethod $requestMethod)
    {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$requestMethod->value][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        [$class, $method] = $action;

        if (class_exists($class)) {
            $object = $this->container->get($class);

            if (method_exists($object, $method)) {

                return $object->$method();

            }
        }

        throw new RouteNotFoundException();
    }

}