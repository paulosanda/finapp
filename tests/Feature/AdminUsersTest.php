<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use App\Models\User;

it('admin user get admin ability token', function () {

    $userData = [
        'name' => fake()->name,
        'email' => fake()->email,
        'password' => "123",
        'is_admin' => true,
        'enable' => true
    ];
    $admin = User::factory()->create($userData);
    User::factory()->count(10)->create();
    $response = $this->postJson(route('api.login'),[
        'email' => $userData['email'],
        'password' => $userData['password']
    ]);
    expect($response)->getStatusCode()->toBe(200);

    $blockedUserRoute = $this->withHeaders([
        'Authorization' => 'Bearer '.$response->content(),])->get(route('users.blocked'));
});


