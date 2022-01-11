<?php

namespace Tests\Unit\Entity\Operation\Aggregation;

use App\Entity\Operation\Aggregation\Sum;
use PHPUnit\Framework\TestCase;

class SumTest extends TestCase
{
    /** @test */
    public function sum_aggregation_execute_test()
    {
        //arrange
        $items = $this->makeItemArray();

        //act
        $operation = new Sum($items, 'c');
        $result = $operation->execute();


        //assert
        self::assertCount(1, $result);
        self::assertEquals(73, $result[0]['c']);
    }

    /**
     * @return array
     */
    public function makeItemArray(): array
    {
        return [
            [
                [
                    'a' => 'b1',
                    'c' => '20',
                ],
                [
                    'a' => 'b1',
                    'c' => '36'
                ],
                [
                    'a' => 'b1',
                    'c' => '17'
                ]

            ]
        ];
    }
}