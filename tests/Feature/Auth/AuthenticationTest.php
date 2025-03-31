<?php

use App\Models\User;
use Inertia\Inertia;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('login screen can be rendered', function () {
    // Disable Vite and exception handling for testing
    $this->withoutVite();
    $this->withoutExceptionHandling();

    // Mock the AuthenticatedSessionController to avoid database interactions
    $this->partialMock(\App\Http\Controllers\Auth\AuthenticatedSessionController::class)
        ->shouldReceive('create')
        ->andReturn(Inertia::render('auth/login', [
            'canResetPassword' => true,
            'status' => null,
        ]));

    $response = $this->get('/login');
    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});
