<?php
namespace Tests;

use App\Operations\BalanceChecker;
use App\Operations\FiftyBillDispenser;
use App\Operations\FiveHundredBillDispenser;
use App\Operations\MultipleOfFifty;
use App\Operations\OneHundredBillDispenser;
use App\Operations\TwoHundredBillDispenser;
use App\Transaction;
use PHPUnit\Framework\TestCase;

class AutomatedTellerMachineTest extends TestCase
{
    /** @test */
    public function it_fails_if_the_requested_amount_is_not_multiple_of_fifty()
    {
        $transaction = new Transaction();
        $transaction->amount = 925;

        ob_start();
        $operation = new MultipleOfFifty();
        $operation->process($transaction);
        $message = ob_get_clean();

        $this->assertEquals("La cantidad debe ser multiple de $50\n", $message);
    }

    /** @test */
    public function it_fails_if_the_account_does_not_have_enough_money()
    {
        $transaction = new Transaction();
        $transaction->amount = 101;
        $transaction->balance = 100;

        ob_start();
        $operation = new BalanceChecker();
        $operation->process($transaction);
        $message = ob_get_clean();

        $this->assertEquals("No tienes dinero suficiente.\n", $message);
    }

    /** @test */
    public function it_knows_how_many_five_hundred_bills_need_to_return()
    {
        $transaction = new Transaction();
        $transaction->amount = 1000;

        ob_start();
        $operation = new FiveHundredBillDispenser();
        $operation->process($transaction);
        $message = ob_get_clean();

       $this->assertEquals("Entrega billetes de $500: 2\n", $message);
    }

    /** @test */
    public function it_knows_how_many_two_hundred_bills_need_to_return()
    {
        $transaction = new Transaction();
        $transaction->amount = 1000;

        ob_start();
        $operation = new TwoHundredBillDispenser();
        $operation->process($transaction);
        $message = ob_get_clean();

        $this->assertEquals("Entrega billetes de $200: 5\n", $message);
    }

    /** @test */
    public function it_knows_how_many_one_hundred_bills_need_to_return()
    {
        $transaction = new Transaction();
        $transaction->amount = 1000;

        ob_start();
        $operation = new OneHundredBillDispenser();
        $operation->process($transaction);
        $message = ob_get_clean();

        $this->assertEquals("Entrega billetes de $100: 10\n", $message);
    }

    /** @test */
    public function it_knows_how_many_fifty_bills_need_to_return()
    {
        $transaction = new Transaction();
        $transaction->amount = 1000;

        ob_start();
        $operation = new FiftyBillDispenser();
        $operation->process($transaction);
        $message = ob_get_clean();

        $this->assertEquals("Entrega billetes de $50: 20\n", $message);
    }
}
