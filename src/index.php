<?php
use App\Config\App;
use App\Config\Config;
use App\Config\Container;
use App\Config\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$container = new Container();
$router = new Router($container);
$config = new Config($_ENV);

require_once __DIR__ . '/../routes/route.php';

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