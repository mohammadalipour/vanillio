<?php

namespace App\Helpers;

class Route
{
    /**
     * Keep all the routes
     *
     * @var array
     */
    private static array $routes = [];

    /**
     * Route Request Method
     *
     * @var string
     */
    private string $method;

    /**
     * Route Path
     *
     * @var string
     */
    private string $path;

    /**
     * Route Action
     *
     * @var string
     */
    private string $action;

    /**
     * Constructor
     *
     * @param string $method
     * @param string $path
     * @param string $action
     */
    public function __construct(string $method, string $path, string $action)
    {
        $this->method = $method;
        $this->path = $path;
        $this->action = $action;
    }

    /**
     * Add GET requests to routes
     *
     * @param string $path
     * @param string $action
     * @return void
     */
    public static function get(string $path, string $action): void
    {
        self::$routes[] = new Route('get', $path, $action);
    }

    /**
     * Add POST requests to routes
     *
     * @param string $path
     * @param string $action
     * @return void
     */
    public static function post(string $path, string $action): void
    {
        self::$routes[] = new Route('post', $path, $action);
    }

    /**
     * Get the routes array
     *
     * @return array
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    /**
     * Handle route to destinated controller function
     *
     * @param string $path
     * @return void
     */
    public static function handle(string $path): void
    {
        $desiredRoute = null;

        foreach (self::$routes as $route) {
            $pattern = $route->path;

            $pattern = str_replace('/', '\/', $pattern);

            $pattern = '/^' . $pattern . '$/i';
            $pattern = preg_replace('/{[A-Za-z0-9]+}/', '([A-Za-z0-9]+)', $pattern);
            $desiredRoute = $route;
        }

        $urlParts = explode('/', $path);
        $routeParts = explode('/', $desiredRoute->path);

        foreach ($routeParts as $key => $value) {
            if (!empty($value)) {
                $value = str_replace('{', '', $value, $count1);
                $value = str_replace('}', '', $value, $count2);

                if ($count1 == 1 && $count2 == 1) {
                    Params::set($value, $urlParts[$key]);
                }
            }
        }

        if ($desiredRoute) {
            if ($desiredRoute->method != strtolower($_SERVER['REQUEST_METHOD'])) {
                http_response_code(404);

                echo '<h1>Route Not Allowed</h1>';

                die();
            } else {
                $actions = explode('@', $desiredRoute->action);

                $class = '\\App\\Controller\\' . $actions[0];

                $obj = new $class();
                echo call_user_func(array($obj, $actions[1]));
            }

        } else {
            http_response_code(404);

            echo '<h1>404 - Not Found</h1>';

            die();
        }
    }
}