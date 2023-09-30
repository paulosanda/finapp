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
}
