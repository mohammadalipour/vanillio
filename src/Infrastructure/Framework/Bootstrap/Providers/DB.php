<?php

namespace App\Infrastructure\Framework\Bootstrap\Providers;

use App\Infrastructure\Framework\Db\ORM;

class DB implements ProviderInterface
{
    public function run()
    {
        $doctrine = new ORM\Doctrine();
        $orm = new ORM($doctrine);

        return $orm->resolve();
    }
}