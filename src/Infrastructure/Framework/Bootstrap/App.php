<?php

namespace App\Infrastructure\Framework\Bootstrap;

use App\Exception\RouteNotFoundException;

class App
{
    public function __construct(
        protected Container $container,
        protected Router $router,
        protected array $request,
        protected Config $config
    )
    {
    }

    public function run()
    {
        try {
            $this->router->resolve($this->request['uri'],$this->request['method']);
        }catch (RouteNotFoundException $exception){
            http_response_code(404);
        }
    }
}