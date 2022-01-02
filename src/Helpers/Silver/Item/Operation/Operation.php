<?php

namespace App\Helpers\Silver\Item\Operation;

class Operation
{
    private AbstractOperation $operation;

    /**
     * @param AbstractOperation $operation
     */
    public function __construct(AbstractOperation $operation)
    {
        $this->operation = $operation;
    }

    public function handle():array
    {
        return $this->operation->handle();
    }
}