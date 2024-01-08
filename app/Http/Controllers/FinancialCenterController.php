<?php

namespace App\Http\Controllers;

use App\Models\FinancialCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FinancialCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $financialCenters = FinancialCenter::where('user_id', Auth::user()->id)
            ->orderBy('type')->orderBy('financial_center_name')->get();

        return view('profile.financial-center')->with(['financialCenters' => $financialCenters]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
           'type' => 'required|string',
           'financial_center_name' => 'required|string'
        ]);
//        $payload['financial_center_name'] = strtoupper($request->financial_center_name);
        $payload['financial_center_name'] = mb_strtoupper($request->financial_center_name, 'UTF-8');
        $payload['user_id'] = Auth::user()->id;

        $exist = FinancialCenter::where('financial_center_name', $payload['financial_center_name'])
            ->where('type', $payload['type'])
            ->first();

        if($exist) {
            return back()->withErrors(['erro' => 'Este tipo já existe']);
        }

        FinancialCenter::create($payload);

        return redirect()->action([FinancialCenterController::class, 'index']);
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
