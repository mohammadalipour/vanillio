<?php

namespace App\Infrastructure\Framework\Db\ORM;

use App\Infrastructure\Framework\Bootstrap\Application;
use App\Infrastructure\Framework\Db\DatabaseInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Doctrine implements DatabaseInterface
{
    /**
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function create()
    {
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

        return EntityManager::create($this->getConnection(), $config);
    }

    public function getConnection(string $driver='mysql'): array
    {
        $env = Application::env();

        $connection = [
            'mysql' => [
                'driver' => $env['DB_DRIVER'],
                'host' => $env['DB_HOST'],
                'port' => $env['DB_PORT'],
                'dbname' => $env['DB_DATABASE'],
                'user' => $env['DB_USERNAME'],
                'password' => $env['DB_PASSWORD'],
            ]
        ];

        return $connection[$driver];
    }
}