<?php

namespace App\Infrastructure\Framework;

use App\Infrastructure\Framework\Bootstrap\Resolver;
use App\Infrastructure\Framework\Bootstrap\Config;
use App\Infrastructure\Framework\Bootstrap\Router;
use Psr\Container\ContainerInterface;

final class Kernel
{
    /**
     * @param ContainerInterface $container
     * @param Router $router
     * @param Config $config
     * @return void
     */
    public function build(ContainerInterface $container, Router $router, Config $config): void
    {
        $app = new Resolver(
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