<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\BankAccountBalance;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $payload = $request->validate([
                'bank_name' => ['required', 'string'],
                'branch_number' => ['required', 'string'],
                'account_number' => ['required', 'string'],
                'balance' => ['required']
            ]);
            $payload['user_id'] = Auth::user()->id;

            $bankAccount = BankAccount::create($payload);

            BankAccountBalance::create([
                'bank_account_id' => $bankAccount->id,
                'balance' => convertToInteger($request->balance),
            ]);

            return response()->json(["message" => "success"], 200);
        } catch (\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()], 422);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
