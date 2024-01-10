<?php

namespace App\Observers;

use App\Models\BankAccountBalance;
use App\Models\BankAccountBalanceHistory;

class BankAccountBalanceObserver
{
    public function created(BankAccountBalance $accountBalance): void
    {
//        dd($accountBalance->bank_account_id);
        BankAccountBalanceHistory::create([
            'bank_account_id' => $accountBalance->bank_account_id,
            'balance' => $accountBalance->balance,
        ]);
    }

    public function updated(BankAccountBalance $accountBalance): void
    {
        BankAccountBalanceHistory::create([
            'bank_account_id' => $accountBalance->bank_account_id,
            'balance' => $accountBalance->balance,
        ]);
    }
}
