<?php

namespace App\Infrastructure\Framework\Bootstrap;

use App\Infrastructure\Framework\Configuration\ApplicationEnvironmentConfigurationInterface;
use Dotenv\Dotenv;

class Config
{
    protected array $config = [];

    public function __construct(private readonly ApplicationEnvironmentConfigurationInterface $configuration)
    {
        $this->config = $this->configuration->load();
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return [
            'application_name'=> $this->config['APPLICATION_NAME'] ?? '',
            'debug'=> $this->config['APPLICATION_DEBUG'] ?? '',
        ];
    }
}