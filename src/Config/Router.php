<?php

namespace App\Config;

use App\Exception\RouteNotFoundException;
use Symfony\Component\HttpFoundation\Request;

class Router
{
    private array $routes = [];

    public function __construct(private Container $container)
    {
    }

    /**
     * @param string $route
     * @param callable|array $action
     * @return $this
     */
    public function get(string $route, callable|array $action): static
    {
        return $this->register('GET', $route, $action);
    }

    /**
     * @param string $requestMethod
     * @param string $route
     * @param callable|array $action
     * @return $this
     */
    private function register(string $requestMethod, string $route, callable|array $action): static
    {
        $this->routes[$requestMethod][$route] = $action;

        return $this;
    }

    /**
     * @param string $route
     * @param callable|array $action
     * @return $this
     */
    public function post(string $route, callable|array $action): static
    {
        return $this->register('POST', $route, $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }

    /**
     * @param string $requestUri
     * @param string $requestMethod
     * @return false|mixed
     * @throws RouteNotFoundException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function resolve(string $requestUri, string $requestMethod): mixed
    {
        $route = explode('?', $requestUri)[0];
        if (!$action = $this->routes[$requestMethod][$route]) {
            throw new RouteNotFoundException();
        }

        $request = Request::createFromGlobals();

        if (is_callable($action)) {
            return call_user_func($action);
        }

        [$class, $method] = $action;
        if (class_exists($class)) {
            $class = $this->container->get($class);
            if (method_exists($class,$method)) {
                return call_user_func_array([$class,$method], [$request]);
            }
        }

        throw new RouteNotFoundException();
    }
}