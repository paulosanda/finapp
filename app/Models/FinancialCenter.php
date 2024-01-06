<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'financial_center_name'
    ];

    public function inicialCenter(): array
    {
        return [
            'credit' => [
                'SALÁRIO',
                'PRO-LABORE',
                'DIVIDENDOS',
                'ALUGUEIS',
                'OUTROS',
            ],
            'debit' => [
                'ALIMENTAÇÃO',
                'CONSUMO',
                'HABITAÇÃO',
                'IMPOSTOS',
                'TRANSPORTE',
                'LAZER'
            ]
        ];
    }
}
