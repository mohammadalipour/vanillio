<?php

namespace Tests\Unit\Entity\Operation\Aggregation;

use App\Entity\Operation\Aggregation\Concat;
use PHPUnit\Framework\TestCase;

class ConcatTest extends TestCase
{
    /** @test */
    public function concat_aggregation_execute_test()
    {
        //arrange
        $items = $this->makeItemArray();

        //act
        $operation = new Concat($items, 'a');
        $result = $operation->execute();

        //assert
        self::assertCount(1, $result);
        self::assertEquals('b1/b2', $result[0]['a']);
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

            ]
        ];
    }
}