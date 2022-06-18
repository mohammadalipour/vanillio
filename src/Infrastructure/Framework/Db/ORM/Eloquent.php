<?php

namespace App\Infrastructure\Framework\Db\ORM;

use App\Infrastructure\Framework\Bootstrap\Application;
use App\Infrastructure\Framework\Db\DatabaseInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class Eloquent implements DatabaseInterface
{

    public function create()
    {
        $capsule = new Capsule;

        $capsule->addConnection($this->getConnection());

        $capsule->setAsGlobal();

        $capsule->bootEloquent();

        return;
    }


    public function getConnection(string $driver='mysql'): array
    {
        $env = Application::env();

        $connection = [
            'sqlite' => [
                'driver' => 'sqlite',
                'url' => $env['DATABASE_URL'],
                'database' => $env['DB_DATABASE'],
                'prefix' => '',
                'foreign_key_constraints' => $env['DB_FOREIGN_KEYS'] ?? '',
            ],
            'mysql' => [
                'driver' => $env['DB_DRIVER'],
                'url' => $env['DATABASE_URL'],
                'host' => $env['DB_HOST']  ?? '',
                'port' => $env['DB_PORT'],
                'database' => $env['DB_DATABASE']  ?? '',
                'username' => $env['DB_USERNAME']  ?? '',
                'password' => $env['DB_PASSWORD']  ?? '',
                'unix_socket' => $env['DB_SOCKET']  ?? '',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'prefix_indexes' => true,
                'strict' => true,
                'engine' => null,
            ],

            'pgsql' => [
                'driver' => 'pgsql',
                'url' => $env['DATABASE_URL'],
                'host' => $env['DB_HOST']  ?? '',
                'port' => $env['DB_PORT'],
                'database' => $env['DB_DATABASE']  ?? '',
                'username' => $env['DB_USERNAME']  ?? '',
                'password' => $env['DB_PASSWORD']  ?? '',
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
                'schema' => 'public',
                'sslmode' => 'prefer',
            ],

            'sqlsrv' => [
                'driver' => 'sqlsrv',
                'url' => $env['DATABASE_URL'],
                'host' => $env['DB_HOST'],
                'port' => $env['DB_PORT'],
                'database' => $env['DB_DATABASE']  ?? '',
                'username' => $env['DB_USERNAME']  ?? '',
                'password' => $env['DB_PASSWORD']  ?? '',
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
            ],
        ];

        return $connection[$driver];
    }
}