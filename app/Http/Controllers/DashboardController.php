<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $bankAccounts = BankAccount::with('balance')->where('user_id', Auth::user()->id)->get();

        return view('dashboard')->with('bankAccounts',$bankAccounts);
    }
}
