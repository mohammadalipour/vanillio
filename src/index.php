<?php

use App\Infrastructure\Framework\Bootstrap\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$application = new Application();
$application->handle();

