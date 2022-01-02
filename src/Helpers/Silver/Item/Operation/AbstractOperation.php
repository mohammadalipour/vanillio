<?php

namespace App\Helpers\Silver\Item\Operation;

abstract class AbstractOperation
{
    protected array $item;
    protected array $value;

    public function __construct(array $item,array $value)
    {
        $this->item = $item;
        $this->value = $value;
    }

    public abstract function handle(): array;
}