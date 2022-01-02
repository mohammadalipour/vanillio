<?php

namespace App\Helpers\Silver\Item\Operation;


class OrderBy extends AbstractOperation
{
    /**
     * @return array
     */
    public function handle(): array
    {
        foreach ($this->value as $key => $sortType) {
            $columns = array_column($this->item, $key);
            $sortType = strtolower($sortType) == 'asc' ? SORT_ASC : SORT_DESC;
            array_multisort($columns, $sortType, $this->item);
        }

        return $this->item;
    }
}