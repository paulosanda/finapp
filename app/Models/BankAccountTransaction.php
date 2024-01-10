<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankAccountTransaction extends Model
{
    use HasFactory;

    protected $fillable =[
        'type',
        'bank_account_id',
        'financial_center_id',
        'effective_date',
        'completed',
        'value',
    ];

    public function bankAccount(): BelongsTo
    {
        return $this->BelongsTo(BankAccount::class);
    }

    public function getTodayTrasanctions($bankAccountId)
    {
        return $this->whereDate('created_at', now()->format('Y-m-d'))
            ->where('bank_account_id', $bankAccountId)->get();

    }
}
