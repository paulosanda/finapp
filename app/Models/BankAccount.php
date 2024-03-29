<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_name',
        'branch_number',
        'account_number',
    ];

    public function balance(): HasOne
    {
        return $this->hasOne(BankAccountBalance::class);
    }

    public function getByUserId($userId)
    {
        return $this->where('user_id', $userId)->get();
    }

    public function setBranchNumberAttribute($value): void
    {
        $this->attributes['branch_number'] = encrypt($value);
    }

    public function getBranchNumberAttribute($value): string
    {
        return decrypt($value);
    }

    public function setAccountNumberAttribute($value): void
    {
        $this->attributes['account_number'] = encrypt($value);
    }

    public function getAccountNumberAttribute($value): string
    {
        return decrypt($value);
    }
}
