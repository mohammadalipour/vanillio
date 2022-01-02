<?php

namespace App\Helpers\Silver\Item\Operation\Aggregation;

abstract class AbstractItemAggregation
{
    protected array $item;
    protected string $key;
    protected array $result =[];

    /**
     * @param array $item
     * @param string $key
     */
    public function __construct(array $item, string $key)
    {
        $this->item = $item;
        $this->key = $key;
    }

    public abstract function execute();
}