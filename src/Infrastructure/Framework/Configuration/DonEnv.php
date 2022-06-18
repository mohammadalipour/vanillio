<?php

namespace App\Infrastructure\Framework\Configuration;

use App\Infrastructure\Framework\Instance;
use Dotenv\Dotenv;

class DonEnv extends Instance implements ApplicationEnvironmentConfigurationInterface
{
    private array $config;

    public function load(): array|null
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__.'/../../../../../'));

        $this->config = $dotenv->load();

        return $this->config;
    }

    public function getValue(string $key): string
    {
        return $this->config[$key];
    }

    public function setValue(string $key, string $value): void
    {
        $this->config[$key] = $value;
    }
}