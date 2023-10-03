<?php

use Tests\TestCase;
use App\Models\User;

it('can create a bank account when authenticated', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $data = [
        'bank_name' => 'My Bank',
        'branch_number' => '1234',
        'account_number' => '567890',
    ];

    $response = $this->post(route('bank_account_register_exec'), $data);

    $response->assertStatus(302);

    $this->assertDatabaseHas('bank_accounts', $data);
});

it('can not create a bank account when not authenticated', function() {
    $data = [
        'bank_name' => 'My Bank',
        'branch_number' => '1234',
        'account_number' => '567890',
    ];

    $response = $this->post(route('bank_account_register_exec'), $data);

    $response->assertStatus(302);

    $this->assertDatabaseMissing('bank_accounts', $data);

});


