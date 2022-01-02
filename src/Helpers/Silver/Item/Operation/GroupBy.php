<?php

namespace App\Helpers\Silver\Item\Operation;


use App\Helpers\Silver\Item\Operation\Aggregation\AbstractItemAggregation;

class GroupBy extends AbstractOperation
{
    private $closure;
    private array $aggregation;

    public function __construct(array $item, array $value, ?array $aggregation, ?callable $closure)
    {
        parent::__construct($item, $value);
        $this->closure = $closure;
        $this->aggregation = $aggregation;
    }

    public function handle(): array
    {
        if (is_callable($this->closure)) {
            $func = call_user_func($this->closure, $this->item);
        }

        $items = $func['item'];
        $finalResults = [];

        foreach ($this->value as $value) {
            $finalItems = [];

            foreach ($items as $item) {
                $finalItems[$item[$value]][] = $item;
            }

            if (!$this->aggregation) {
                foreach ($finalItems as $finalItem) {
                    $finalResults = $finalItem[0];
                }
            } else {
                $finalResults = $this->executeAggregations($this->aggregation,$finalItems, $value);
            }
        }

        return array_merge($finalResults, $func['expected']);
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
            $aggregationClass = new $aggregationKey($finalItems, $aggregation);
            /** @var AbstractItemAggregation $aggregationClass */
            $results = $aggregationClass->execute();

            foreach ($results as $resultKey => $result) {
                $finalResults[$resultKey][$aggregation] = $result[$aggregation];
                $finalResults[$resultKey][$value] = $finalItems[$resultKey][0][$value];

            }
        }

        return $finalResults;
    }
}