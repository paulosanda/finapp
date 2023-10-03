<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
   return view('index');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::group(['bank'], function() {
        Route::get('/create', function (){
           return view('banks.RegisterAccount');
        })->name('bank_account_register');
        Route::post('/create',[\App\Http\Controllers\BankAccountController::class,'create'])->name('bank_account_register_exec');
        Route::get('/edit/{id}', [\App\Http\Controllers\BankAccountController::class,'edit'])->name('bank_account_edit');
        Route::put('/edit/{id}', [\App\Http\Controllers\BankAccountController::class, 'update'])->name('bank_account_update');
        Route::get('/transactions',[\App\Http\Controllers\BankAccountController::class, 'transactionRegister'])->name('bank_account_transaction_create');
        Route::post('/transactions', [\App\Http\Controllers\BankAccountController::class, 'transactionStore'])->name('bank_account_transaction_store');
    });
});

require __DIR__.'/auth.php';
