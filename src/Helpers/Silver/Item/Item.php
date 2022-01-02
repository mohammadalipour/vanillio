<?php
namespace App\Helpers\Silver\Item;


use App\Helpers\Silver\Item\Operation\GroupBy;
use App\Helpers\Silver\Item\Operation\Operation;
use App\Helpers\Silver\Item\Operation\OrderBy;

class Item
{
    private array $items;
    private array $aggregation =[];

    /**
     * @throws \Exception
     */
    public function select(string $className): self
    {
        $entity = new $className();
        if($entity instanceof ItemInterface){
            $this->items = $entity->get();
        }else{
            throw (new \Exception('entity does not exist'));
        }

        return $this;
    }

    public function aggregation(array $aggregation):self
    {
        $this->aggregation = $aggregation;

        return $this;
    }
    
    public function groupBy(array $groupBy,?callable $closure = null): self
    {
        $operation = new Operation(new GroupBy($this->items,$groupBy,$this->aggregation ,$closure));
        $this->items = $operation->handle();

        return $this;
    }

    public function orderBy(array $orderBy): self
    {
        $operation = new Operation(new OrderBy($this->items,$orderBy));
        $this->items = $operation->handle();

        return $this;
    }

    public function get() :array
    {
        return $this->items;
    }
}