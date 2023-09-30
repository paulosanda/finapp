<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankAccountController extends Controller
{
    public function create(Request $request): \Illuminate\Http\RedirectResponse
    {

        $payload = $request->validate([
            'bank_name' => ['required', 'string'],
            'branch_number' => ['required', 'string'],
            'account_number' => ['required', 'string']
        ]);
        $payload['user_id'] = Auth::user()->id;

        BankAccount::create($payload);
        return redirect()->route('dashboard');

    }

    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $bankAccount = BankAccount::find($id);

        return view('banks.EditAccount')->with('bankAccount',$bankAccount);
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
}
