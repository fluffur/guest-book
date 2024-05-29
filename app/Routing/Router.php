<?php

declare(strict_types=1);

namespace App\Routing;

use App\Attributes\Middleware;
use App\Attributes\Route;
use App\Container;
use App\Contracts\MiddlewareInterface;
use App\DTO\Request;
use App\Enums\RequestMethod;
use App\Exceptions\RouteNotFoundException;
use App\Middlewares\MiddlewarePipeline;
use ReflectionClass;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    public function __construct(
        protected Container $container,
    )
    {
    }

    public function registerRoutesFromControllersInNamespace(string $namespace): void
    {
        $this->registerRoutesFromControllerAttributes(
            $this->container->get(ControllerResolver::class)->getControllersFromNamespace($namespace)
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


    public function middleware(MiddlewareInterface $middleware, RequestMethod $method, string...$routes): self
    {
        foreach ($routes as $route) {
            $this->middlewares[$method->value][$route][] = $middleware;
        }
        return $this;
    }


    public function registerMiddlewaresFromControllerAttributes(array $controllers): void
    {
        foreach ($controllers as $controller) {
            $reflectionController = new ReflectionClass($controller);

            foreach ($reflectionController->getMethods() as $method) {
                $attributes = $method->getAttributes(Middleware::class, \ReflectionAttribute::IS_INSTANCEOF);
                $routes = $method->getAttributes(Route::class, \ReflectionAttribute::IS_INSTANCEOF);

                foreach ($attributes as $attribute) {
                    $middleware = $attribute->newInstance();
                    foreach ($routes as $route) {
                        $routeInstance = $route->newInstance();
                        $middlewareImpl = $this->container->get($middleware->middleware);
                        $this->middleware($middlewareImpl, $routeInstance->method, $routeInstance->routePath);
                    }
                }
            }
        }
    }

    public function registerMiddlewaresFromControllersInNamespace(string $namespace): void
    {
        $this->registerMiddlewaresFromControllerAttributes(
            $this->container->get(ControllerResolver::class)->getControllersFromNamespace($namespace)
        );
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

        $middlewares = $this->middlewares[$request->method->value][$route] ?? [];
        $middlewarePipeline = $this->container->get(MiddlewarePipeline::class);
        foreach ($middlewares as $middleware) {
            $middlewarePipeline->add($middleware);
        }

        $handler = function ($request) use ($action) {

            [$class, $method] = $action;

            if (class_exists($class)) {
                $object = $this->container->get($class);

                if (method_exists($object, $method)) {

                    return $object->$method($request);
                }
            }

            throw new RouteNotFoundException();
        };

        return $middlewarePipeline->handle($request, $handler);

    }

}