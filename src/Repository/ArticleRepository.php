<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Operation\Aggregation\Concat;
use App\Entity\Operation\Aggregation\Sum;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function __construct(private Article $article)
    {
    }

    public function findAll(): array
    {
        return $this->article
            ->findAll()
            ->aggregation('price',Sum::class)
            ->aggregation('name',Concat::class)
            ->groupBy('group',function ($items) {
                return array_filter($items, function($item) {
                    return $item['group'] === '0';
                });
            })
            ->orderBy('name')
            ->get();
    }
}