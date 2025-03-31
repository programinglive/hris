<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guests are redirected to the login page', function () {
    $this->get('/dashboard')->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function () {
    $this->actingAs($user = User::factory()->create());

    $this->get('/dashboard')->assertOk();
});

test('dashboard contains highlight cards', function () {
    $this->actingAs($user = User::factory()->create());

    $response = $this->get('/dashboard');

    $response->assertInertia(function ($page) {
        $page->component('dashboard');
    });
});

test('dashboard contains charts', function () {
    $this->actingAs($user = User::factory()->create());

    $response = $this->get('/dashboard');

    $response->assertInertia(function ($page) {
        $page->component('dashboard');
    });
});
