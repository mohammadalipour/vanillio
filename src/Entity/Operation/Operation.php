<?php

namespace App\Entity\Operation;

class Operation
{
    private array $operation;

    public function __construct(protected array $items)
    {
    }

    public function add(AbstractOperation $operation)
    {
        $this->operation[] = $operation;
    }

    public function handle(): array
    {
        foreach ($this->operation as $operation) {
            $this->items = $operation->handle($this->items);
        }

        return $this->items;
    }
}