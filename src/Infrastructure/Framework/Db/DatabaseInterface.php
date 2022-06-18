<?php

namespace App\Infrastructure\Framework\Db;

interface DatabaseInterface
{
    public function create();

    public function getConnection(string $driver = ''): array;
}