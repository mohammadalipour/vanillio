<?php

namespace App\Entity;

class Article extends Entity
{

    public function findAll()
    {
        $this->items= [
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

        return $this;
    }
}