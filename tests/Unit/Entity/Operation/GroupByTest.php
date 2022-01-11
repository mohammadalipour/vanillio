<?php

namespace Tests\Unit\Entity\Operation;

use App\Entity\Operation\GroupBy;
use App\Entity\Operation\Operation;
use PHPUnit\Framework\TestCase;

class GroupByTest extends TestCase
{
    /** @test */
    public function group_by_items_without_aggregation_test()
    {
        //arrange
        $items = $this->makeItemArray();;

        //act
        $operation = new Operation($items);
        $operation->add(new GroupBy(['a']));
        $result = $operation->handle();

        //assert
        self::assertCount(2,$result);
        self::assertEquals('d1',$result[0]['c']);
        self::assertEquals('b2',$result[1]['a']);
    }

    /**
     * @return array
     */
    public function makeItemArray(): array
    {
        return [
            [
                'a' => 'b1',
                'c' => 'd1',
            ],
            [
                'a' => 'b2',
                'c' => 'd2'
            ],
            [
                'a' => 'b1',
                'c' => 'd3'
            ]
        ];
    }
}