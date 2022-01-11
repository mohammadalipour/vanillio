<?php

namespace App\Entity\Operation;


use App\Entity\Operation\Aggregation\AbstractItemAggregation;

class GroupBy extends AbstractOperation
{
    private array $aggregation;

    public function __construct( array $value, ?array $aggregation)
    {
        parent::__construct($value);
        $this->aggregation = $aggregation;
    }

    public function handle(array $items): array
    {
        $expected = [];
        $finalResults = [];


        foreach ($this->value as $value => $closure) {
            if (is_callable($closure)) {
                $expected = call_user_func($closure, $items);
            }
            $diffItems = array_diff_key($items,$expected);

            $finalItems = [];

            foreach ($diffItems as $item) {
                $finalItems[$item[$value]][] = $item;
            }


            if (!$this->aggregation) {
                foreach ($finalItems as $finalItem) {
                    $finalItem = array_values($finalItem);
                    $finalResults[] = reset($finalItem);
                }
            } else {
                $finalResults = $this->executeAggregations($this->aggregation,$finalItems, $value);
            }
        }

        return array_merge($finalResults, $expected);
    }

    /**
     * @param array $aggregations
     * @param array $finalItems
     * @param mixed $value
     * @return array
     */
    private function executeAggregations(array $aggregations ,array $finalItems, mixed $value): array
    {
        $finalResults= [];

        foreach ($aggregations as $aggregationKey => $aggregation) {
            $aggregationClass = new $aggregation($finalItems, $aggregationKey);
            /** @var AbstractItemAggregation $aggregationClass */
            $results = $aggregationClass->execute();

            foreach ($results as $resultKey => $result) {
                $finalResults[$resultKey][$aggregationKey] = $result[$aggregationKey];
                $finalResults[$resultKey][$value] = $finalItems[$resultKey][0][$value];
            }
        }

        return $finalResults;
    }
}