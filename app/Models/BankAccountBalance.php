<?php

namespace App\Models;

use App\Events\BankAccountBallanceCreate;
use App\Events\BankAccountBallanceUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccountBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_account_id',
        'balance'
    ];

    protected $dispatchesEvents = [
        'created' => BankAccountBallanceCreate::class,
        'updated' => BankAccountBallanceUpdate::class
    ];
}
