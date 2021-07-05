<?php

namespace App\Operations;

use App\Transaction;

abstract class OperationAbstract
{
    /**
     * @var OperationAbstract
     */
    protected OperationAbstract $operation;

    public function then(OperationAbstract $operation): OperationAbstract
    {
        $this->operation = $operation;

        return $operation;
    }

    public function next(Transaction $transaction)
    {
        if ($this->operation) {
            $this->operation->process($transaction);
        }
    }

    abstract public function process(Transaction $transaction);
}