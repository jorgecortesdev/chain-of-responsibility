<?php

namespace App\Operations;

use App\Transaction;

class FiveHundredBillDispenser extends OperationAbstract
{
    public function process(Transaction $transaction)
    {
        if ($transaction->amount < 500) {
            $this->next($transaction);
            return;
        }

        $bills = intval($transaction->amount / 500);
        $remain = $transaction->amount % 500;

        echo "Entrega billetes de $500: {$bills}\n";

        if ($remain !== 0) {
            $transaction->amount = $remain;
            $this->next($transaction);
        }
    }
}