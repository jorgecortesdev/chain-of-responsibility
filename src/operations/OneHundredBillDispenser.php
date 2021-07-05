<?php

namespace App\Operations;

use App\Transaction;

class OneHundredBillDispenser extends OperationAbstract
{
    public function process(Transaction $transaction)
    {
        if ($transaction->amount < 100) {
            $this->next($transaction);
            return;
        }

        $bills = intval($transaction->amount / 100);
        $remain = $transaction->amount % 100;

        echo "Entrega billetes de $100: {$bills}\n";

        if ($remain !== 0) {
            $transaction->amount = $remain;
            $this->next($transaction);
        }
    }
}