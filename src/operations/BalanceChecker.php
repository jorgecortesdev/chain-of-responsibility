<?php

namespace App\Operations;

use App\Transaction;

class BalanceChecker extends OperationAbstract
{
    public function process(Transaction $transaction)
    {
        if ($transaction->balance < $transaction->amount) {
            echo "No tienes dinero suficiente.\n";
            return;
        }

        $this->next($transaction);
    }
}