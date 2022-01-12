<?php

namespace App\Entity\Operation\Aggregation;

class Sum extends AbstractItemAggregation
{
    public function execute()
    {
        $result = [];
        foreach ($this->item as $key => $item) {
            $result[$key][$this->key] = array_sum(array_column($item, $this->key));
        }

        return $result;
    }
}