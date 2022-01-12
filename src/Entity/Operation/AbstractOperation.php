<?php

namespace App\Entity\Operation;

abstract class AbstractOperation
{
    protected array $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    abstract function handle(array $items): array;
}