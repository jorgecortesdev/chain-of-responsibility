<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Transaction;
use App\Operations\MultipleOfFifty;
use App\Operations\BalanceChecker;
use App\Operations\FiveHundredBillDispenser;
use App\Operations\TwoHundredBillDispenser;
use App\Operations\OneHundredBillDispenser;
use App\Operations\FiftyBillDispenser;

$transaction = new Transaction();
$transaction->amount = 1350;
$transaction->balance = 10000;

$multiple = new MultipleOfFifty();
$balance = new BalanceChecker();
$fiveHundred = new FiveHundredBillDispenser();
$twoHundred = new TwoHundredBillDispenser();
$oneHundred = new OneHundredBillDispenser();
$fifty = new FiftyBillDispenser();

$multiple
    ->then($balance)
    ->then($fiveHundred)
    ->then($twoHundred)
    ->then($oneHundred)
    ->then($fifty);

$multiple->process($transaction);
