<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_name',
        'branch_number',
        'account_number',
    ];

    public function balance()
    {
        return $this->hasOne(BankAccountBalance::class);
    }
}
