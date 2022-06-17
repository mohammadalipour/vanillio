<?php

namespace App\Infrastructure\Framework;

use App\Infrastructure\Framework\Bootstrap\App;
use App\Infrastructure\Framework\Bootstrap\Config;
use App\Infrastructure\Framework\Bootstrap\Router;
use Psr\Container\ContainerInterface;

final class Kernel
{
    public function build(ContainerInterface $container,Router $router, Config $config): void
    {
        $app = new App(
            $container,
            $router,
            [
                'uri' => $_SERVER['REQUEST_URI'],
                'method' => $_SERVER['REQUEST_METHOD']
            ],
            $config
        );

        $app->run();
    }
}