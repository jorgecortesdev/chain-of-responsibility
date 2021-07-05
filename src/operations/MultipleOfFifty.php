<?php

namespace App\Operations;

use App\Transaction;

class MultipleOfFifty extends OperationAbstract
{
    public function process(Transaction $transaction)
    {
        if ($transaction->amount % 50 !== 0) {
            echo "La cantidad debe ser multiple de $50\n";
            return;
        }

        $this->next($transaction);
    }
}