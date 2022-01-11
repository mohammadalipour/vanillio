<?php

namespace Tests\Unit\Entity\Operation;

use App\Entity\Operation\Operation;
use App\Entity\Operation\OrderBy;
use PHPUnit\Framework\TestCase;

class OrderByTest extends TestCase
{
    /** @test */
    public function order_by_items_operation_test()
    {
        //arrange
        $items = $this->makeItemArray();

        //act
        $operation = new Operation($items);
        $operation->add(new OrderBy(['a'=>'ASC']));
        $result = $operation->handle();

        //assert
        self::assertCount(3, $result);
        self::assertEquals('jack', $result[0]['a']);
        self::assertEquals('john', $result[1]['a']);
        self::assertEquals('mohammad', $result[2]['a']);
    }

    /**
     * @return array
     */
    public function makeItemArray(): array
    {
        return [
            [
                'a' => 'mohammad',
                'c' => 'd1',
            ],
            [
                'a' => 'jack',
                'c' => 'd2'
            ],
            [
                'a' => 'john',
                'c' => 'd3'
            ]
        ];
    }
}