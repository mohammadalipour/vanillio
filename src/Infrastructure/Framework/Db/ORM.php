<?php

namespace App\Infrastructure\Framework\Db;

class ORM
{
    public function __construct(private readonly DatabaseInterface $orm)
    {
    }

    public function resolve()
    {
        return $this->orm->create();
    }
}