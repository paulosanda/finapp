<?php

namespace App\Http\Controllers;

use App\Actions\CreateBankAccountTransactionAction;
use App\Models\BankAccount;
use App\Models\BankAccountTransaction;
use App\Models\FinancialCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankAccountTransactionController extends Controller
{
    public function __construct(
        protected BankAccount $bankAccount,
        protected BankAccountTransaction $transaction
    ){}

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $bankAccounts = $this->bankAccount->getByUserId(Auth::user()->id);
        $financialCenters = FinancialCenter::where('user_id', Auth::user()->id)->get();

        return view('banks.BankTransactionCreate')->with([
            'bankAccounts' => $bankAccounts,
            'financialCenters' => $financialCenters
        ]);
    }

    public function store(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $payload = $request->validate([
            'bank_account_id' => 'required|string',
            'transaction_type' => 'required',
            'efective_date' => 'required',
            'financial_center_id' => 'required',
            'description' => 'required',
            'value' => 'required'
        ]);

        $transaction = app(CreateBankAccountTransactionAction::class)->exec($payload);

        $todayTransactions = $this->transaction->getTodayTrasanctions($transaction->bank_account_id);

        $bankAccounts = $this->bankAccount->getByUserId(Auth::user()->id);

        $financialCenters = FinancialCenter::all();

        return view('banks.BankTransactionCreate')->with([
            'bankAccounts' => $bankAccounts,
            'financialCenters' => $financialCenters,
            'transaction' => $transaction,
            'todayTransactions' => $todayTransactions
        ]);
    }
}
