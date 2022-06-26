<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$routes = require_once __DIR__ . '/../routes/route.php';
$container = require_once __DIR__ . '/Infrastructure/Framework/container.php';

$request = Request::createFromGlobals();
$response = $container->get('kernel')->handle($request);

$response->send();