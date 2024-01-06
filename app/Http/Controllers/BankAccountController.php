<?php

namespace App\Http\Controllers;

use App\Actions\CreateBankAccountTransactionAction;
use App\Models\BankAccount;
use App\Models\BankAccountBalance;
use App\Models\BankAccountTransaction;
use App\Models\FinancialCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankAccountController extends Controller
{
    public function __construct(
        protected BankAccount $bankAccount,
        protected BankAccountTransaction $transaction
    ){}
    public function create(Request $request): \Illuminate\Http\RedirectResponse
    {
        $payload = $request->validate([
            'bank_name' => ['required', 'string'],
            'branch_number' => ['required', 'string'],
            'account_number' => ['required', 'string']
        ]);
        $payload['user_id'] = Auth::user()->id;

        $bankAccount = BankAccount::create($payload);

        BankAccountBalance::create([
            'bank_account_id' => $bankAccount->id,
            'balance' => convertToInteger($request->balance),
        ]);

        return redirect()->route('dashboard');
    }

    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $banckAccount = BankAccount::find($id);

        return view('banks.EditAccount')->with(['bankAccount' => $banckAccount, 'id' => $id] );
    }

    public function update(Request $request, $id)
    {
        $payload = $request->validate([
            'bank_name' => ['required', 'string'],
            'branch_number' => ['required', 'string'],
            'account_number' => ['required', 'string']
        ]);

        BankAccount::where('id', $id)->update([
            'bank_name' => $request->bank_name,
            'branch_number' => $request->branch_number,
            'account_number' => $request->account_number
        ]);

        return redirect()->route('dashboard');
    }

    public function transactionRegister(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $bankAccounts = $this->bankAccount->getByUserId(Auth::user()->id);
        $financialCenters = FinancialCenter::where('user_id', Auth::user()->id)->get();

        return view('banks.BankTransactionCreate')->with([
            'bankAccounts' => $bankAccounts,
            'financialCenters' => $financialCenters
        ]);
    }

    public function transactionStore(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
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
