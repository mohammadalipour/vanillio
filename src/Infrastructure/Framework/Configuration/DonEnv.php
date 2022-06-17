<?php

namespace App\Infrastructure\Framework\Configuration;

use Dotenv\Dotenv;

class DonEnv implements ApplicationEnvironmentConfigurationInterface
{
    public function load(): array|null
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__.'/../../../../../'));

        return $dotenv->load();
    }
}