<?php

use App\Models\BankAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

it('pode criar uma instância de BankAccount', function () {
    // Crie uma instância de BankAccount
    $bankAccount = new BankAccount([
        'user_id' => 1,
        'bank_name' => 'Nome do Banco',
        'branch_number' => '1234',
        'account_number' => '567890',
    ]);

    // Verifique se a instância é uma instância de BankAccount
    expect($bankAccount)->toBeInstanceOf(BankAccount::class);

    // Verifique se os atributos estão corretos
    expect($bankAccount->user_id)->toBe(1);
    expect($bankAccount->bank_name)->toBe('Nome do Banco');
    expect($bankAccount->branch_number)->toBe('1234');
    expect($bankAccount->account_number)->toBe('567890');
});
