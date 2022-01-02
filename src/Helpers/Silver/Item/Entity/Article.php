<?php

namespace App\Helpers\Silver\Item\Entity;

use App\Helpers\Silver\Item\ItemInterface;

class Article implements ItemInterface
{
    private array $items = [
        [
            'name' => 'BB',
            'group' => '1',
            'price' => '50'
        ],
        [
            'name' => 'CC',
            'group' => '2',
            'price' => '75'
        ],
        [
            'name' => 'AA',
            'group' => '1',
            'price' => '20'
        ],
        [
            'name' => 'AA',
            'group' => '0',
            'price' => '100'
        ],
        [
            'name' => 'AA',
            'group' => '1',
            'price' => '100'
        ],
        [
            'name' => 'BB',
            'group' => '2',
            'price' => '75'
        ],
        [
            'name' => 'CC',
            'group' => '2',
            'price' => '80'
        ],
        [
            'name' => 'AA',
            'group' => '0',
            'price' => '20'
        ]
    ];

    public function get(): array
    {
        return  $this->items;
    }
}