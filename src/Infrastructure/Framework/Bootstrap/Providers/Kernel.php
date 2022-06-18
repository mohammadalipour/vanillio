<?php

namespace App\Infrastructure\Framework\Bootstrap\Providers;

use App\Infrastructure\Framework\Bootstrap\Resolver;
use App\Infrastructure\Framework\Bootstrap\Container;
use App\Infrastructure\Framework\Bootstrap\Router;

class Kernel implements ProviderInterface
{
    public function run()
    {
        $container = new Container();
        $router = new Router($container);

        require_once __DIR__ . '/../../../../../routes/route.php';

        $app = new Resolver(
            $container,
            $router,
            [
                'uri' => $_SERVER['REQUEST_URI'],
                'method' => $_SERVER['REQUEST_METHOD']
            ]
        );

        $app->run();
    }
}