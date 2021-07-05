<?php

namespace App\Operations;

use App\Transaction;

class FiftyBillDispenser extends OperationAbstract
{
    public function process(Transaction $transaction)
    {
        if ($transaction->amount < 50) {
            $this->next($transaction);
            return;
        }

        $bills = intval($transaction->amount / 50);
        $remain = $transaction->amount % 50;

        echo "Entrega billetes de $50: {$bills}\n";

        if ($remain !== 0) {
            $transaction->amount = $remain;
            $this->next($transaction);
        }
    }
}