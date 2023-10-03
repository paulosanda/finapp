<?php

namespace App\Actions;

use App\Models\BankAccountBalance;
use App\Models\BankAccountTransaction;
use Illuminate\Support\Facades\DB;

class CreateBankAccountTransactionAction
{
    public function exec($payload): BankAccountTransaction
    {
        if($payload['efective_date'] <= date("Y-m-d")) {
            $completed = true;
        } else {
            $completed = false;
        }

        $transaction = new BankAccountTransaction;
        $transaction->type = $payload['transaction_type'];
        $transaction->bank_account_id = intval($payload['bank_account_id']);
        $transaction->financial_center_id = $payload['financial_center_id'];
        $transaction->description = $payload['description'];
        $transaction->efective_date = $payload['efective_date'];
        $transaction->completed = $completed;
        $transaction->value = convertToInteger($payload['value']);


        try {
            $transaction->save();

            $balanceAtualization = BankAccountBalance::where('bank_account_id', $transaction->bank_account_id)->first();
//            dd($balanceAtualization);
                if($transaction->type == 'credit' && $completed == true) {
                    $balanceAtualization->balance += $transaction->value;
                }
                if($transaction->type == 'debit' && $completed == true) {
                    $balanceAtualization->balance -= $transaction->value;
                }
            $balanceAtualization->save();

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $transaction;


    }

}
