<?php
use App\Infrastructure\Framework\Bootstrap\Config;
use App\Infrastructure\Framework\Bootstrap\Container;
use App\Infrastructure\Framework\Bootstrap\Router;
use App\Infrastructure\Framework\Configuration\DonEnv;
use App\Infrastructure\Framework\Kernel;
use Dotenv\Dotenv;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require_once __DIR__ . '/../vendor/autoload.php';

$kernel = new Kernel();
$container = new Container();
$router = new Router($container);
$config = new Config(new DonEnv());
$whoops = new Run;


//loading whoops package
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

//routes
require_once __DIR__ . '/../routes/route.php';

//build project
$kernel->build($container,$router,$config);

