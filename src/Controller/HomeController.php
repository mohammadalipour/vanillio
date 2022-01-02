<?php

namespace App\Controller;

use App\Helpers\Silver\Item\Entity\Article;
use App\Helpers\Silver\Item\Operation\Aggregation\Concat;
use App\Helpers\Silver\Item\Operation\Aggregation\Sum;
use App\Helpers\Silver\Silver;
use Exception;

class HomeController
{
    /**
     * @throws Exception
     */
    public function index()
    {
        $article = Silver::item()
            ->select(Article::class)
            ->aggregation([
                Sum::class => 'price',
                Concat::class => 'name'
            ])
            ->groupBy(['group'], function ($items) {
                $expected = [];
                foreach ($items as $key => $item) {
                    if ($item['group'] == '0') {
                        $expected[] = $item;
                        unset($items[$key]);
                    }
                }

                return ['item' => $items, 'expected' => $expected];
            })
            ->orderBy(['name' => 'ASC', 'price' => 'DESC'])
            ->get();

        return response($article);
    }
}