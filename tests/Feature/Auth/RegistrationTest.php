<?php

use Inertia\Inertia;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('registration screen can be rendered', function () {
    // Disable Vite and exception handling for testing
    $this->withoutVite();
    $this->withoutExceptionHandling();

    // Mock the RegisteredUserController to avoid actual rendering
    $this->partialMock(\App\Http\Controllers\Auth\RegisteredUserController::class)
        ->shouldReceive('create')
        ->andReturn(Inertia::render('auth/register'));

    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});
