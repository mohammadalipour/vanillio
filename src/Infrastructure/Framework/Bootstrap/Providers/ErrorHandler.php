<?php

namespace App\Infrastructure\Framework\Bootstrap\Providers;

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class ErrorHandler implements ProviderInterface
{
    public function run()
    {
        $whoops = new Run;

        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();
    }
}