<?php

use Illuminate\Support\Facades\DB;
use App\Models\Account;

// Move money between two accounts atomically.
function transfer(int $fromId, int $toId, int $cents): void
{
    // Retries up to 3 times on deadlock.
    DB::transaction(function () use ($fromId, $toId, $cents) {
        $from = Account::lockForUpdate()->findOrFail($fromId);  // row lock
        $to   = Account::lockForUpdate()->findOrFail($toId);

        if ($from->balance < $cents) {
            throw new \RuntimeException('Insufficient funds');  // → rollback
        }

        $from->decrement('balance', $cents);
        $to->increment('balance', $cents);
    }, attempts: 3);
}

// Fire side effects only AFTER the transaction commits:
DB::transaction(function () {
    $order = \App\Models\Order::create([/* ... */]);
    DB::afterCommit(fn () => \App\Jobs\SendReceipt::dispatch($order));
});
