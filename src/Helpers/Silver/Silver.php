<?php
namespace App\Helpers\Silver;

use App\Helpers\Silver\Item\Item;

class Silver
{
    /**
     * @return Item
     */
    public static function item(): Item
    {
        return new Item();
    }
}