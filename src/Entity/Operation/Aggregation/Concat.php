<?php

namespace App\Entity\Operation\Aggregation;

class Concat extends AbstractItemAggregation
{
    public function execute()
    {
        foreach ($this->item as $key => $item) {
            $this->result[$key][$this->key] = implode('/',array_unique(array_column($item, $this->key)));
        }

        return $this->result;
    }
}