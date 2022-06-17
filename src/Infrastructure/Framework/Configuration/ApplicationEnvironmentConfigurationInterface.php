<?php

namespace App\Infrastructure\Framework\Configuration;

interface ApplicationEnvironmentConfigurationInterface
{
    public function load(): array|null;
}