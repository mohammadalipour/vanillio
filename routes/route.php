<?php
use Symfony\Component\Routing;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();
$routes->add('hello', new Routing\Route('/hello/{name}', ['name' => 'World']));
$routes->add('bye', new Routing\Route('/',[
    '_controller'=> function(){
        dd('OKmaaa');
    }
]));

return $routes;