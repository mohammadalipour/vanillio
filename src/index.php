<?php
use App\Infrastructure\Framework\Config\Config;
use App\Infrastructure\Framework\Config\Container;
use App\Infrastructure\Framework\Config\Router;
use App\Infrastructure\Framework\Kernel;
use Dotenv\Dotenv;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require_once __DIR__ . '/../vendor/autoload.php';

$kernel = new Kernel();
$config = new Config($_ENV);
$container = new Container();
$router = new Router($container);
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$whoops = new Run;

//loading .env file
$dotenv->load();

//loading whoops package
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

//routes
require_once __DIR__ . '/../routes/route.php';

//build project
$kernel->build($container,$router,$config);

