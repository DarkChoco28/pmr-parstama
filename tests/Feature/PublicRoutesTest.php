<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class);

/** @var TestCase $this */
describe('Public Routes', function () {
    describe('Home Page', function () {
        it('displays home page', function () {
            $response = $this->get('/');

            $response->assertStatus(200)
                ->assertViewIs('home');
        });

        it('displays registration status page', function () {
            $response = $this->get(route('registration.status'));

            $response->assertOk()
                ->assertViewIs('registration.status');
        });
    });

    describe('Dashboard Route', function () {
        it('requires authentication', function () {
            $response = $this->get('/dashboard');

            $response->assertRedirect('/login');
        });

        it('displays dashboard for authenticated user', function () {
            $user = User::factory()->create();

            $response = $this->actingAs($user)
                ->get('/dashboard');

            $response->assertStatus(200)
                ->assertViewIs('dashboard');
        });
    });
});
