<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccountBalanceHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_account_id',
        'balance',
        'effective_date'
    ];
}
