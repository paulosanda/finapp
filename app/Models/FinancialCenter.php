<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'financial_center_name'
    ];
}
