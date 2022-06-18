<?php

namespace App\Infrastructure\Framework\Bootstrap;

use App\Infrastructure\Framework\Bootstrap\Providers\DB;
use App\Infrastructure\Framework\Bootstrap\Providers\ErrorHandler;
use App\Infrastructure\Framework\Bootstrap\Providers\Kernel;
use App\Infrastructure\Framework\Bootstrap\Providers\ProviderInterface;
use App\Infrastructure\Framework\Configuration\DonEnv;

class Application
{
    private array $providers = [
        ErrorHandler::class,
        Kernel::class,
        DB::class
    ];

    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        /** @var ProviderInterface $provider */
        foreach ($this->providers as $provider){
            if (!new $provider() instanceof ProviderInterface){
                throw new \Exception('The provider dose not be instance of provider interface');
            }

            (new $provider())->run();
        }
    }

    public static function env(): array
    {
        $env = DonEnv::getInstance();

        return $env->load();
    }

}