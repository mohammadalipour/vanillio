<?php

namespace App\Entity;

use App\Entity\Operation\GroupBy;
use App\Entity\Operation\Operation;
use App\Entity\Operation\OrderBy;

class Entity
{
    protected array $items = [];
    private array $groupBy = [];
    private array $orderBy = [];
    private array $aggregation = [];

    public function groupBy(string $column, ?callable $callable = null): static
    {
        $this->groupBy[$column] = $callable;

        return $this;
    }

    public function aggregation(string $column, string $aggregation): static
    {
        $this->aggregation[$column] = $aggregation;

        return $this;
    }

    public function orderBy(string $column, string $sortType = 'ASC'): static
    {
        $this->orderBy[$column] = $sortType;

        return $this;
    }

    public function get(): array
    {
        $operation = new Operation($this->items);
        $operation->add(new GroupBy($this->groupBy, $this->aggregation));
        $operation->add(new OrderBy($this->orderBy));

        return $operation->handle();
    }
}