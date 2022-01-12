<?php

namespace App\Entity\Operation;


class OrderBy extends AbstractOperation
{
    /**
     * @param array $items
     * @return array
     */
    public function handle(array $items): array
    {
        foreach ($this->value as $key => $sortType) {
            $columns = array_column($items, $key);
            $sortType = strtolower($sortType) == 'asc' ? SORT_ASC : SORT_DESC;
            array_multisort($columns, $sortType, $items);
        }

        return $items;
    }
}