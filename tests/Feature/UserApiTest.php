<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

it('can create a new user', function () {
    $userData = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password123',
    ];

    $response = $this->post(route('user.register'), $userData);

    $response->assertStatus(200);

    $this->assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
});

it('returns validation errors when invalid data is provided', function () {

    $invalidUserData = [
        'name' => '',
        'email' => 'invalid-email',
        'password' => 'short',
    ];

    $response = $this->post(route('user.register'), $invalidUserData);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors(['name', 'email', 'password']);
});
