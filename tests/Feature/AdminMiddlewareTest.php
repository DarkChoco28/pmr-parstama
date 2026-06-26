<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class);

/** @var TestCase $this */
describe('AdminMiddleware', function () {
    beforeEach(function () {
        // Seed admin user before each test
        $this->seed(\Database\Seeders\AdminUserSeeder::class);
    });

    it('allows access to admin routes for authenticated admin users', function () {
        $admin = User::where('email', 'admin@parstama.id')->first();
        
        $response = $this->actingAs($admin)
            ->get('/admin/dashboard');

        $response->assertStatus(200);
    });

    it('redirects unauthenticated users to login page', function () {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    });

    it('redirects non-admin users to home page', function () {
        $regularUser = User::factory()->create([
            'email' => 'user@example.com',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($regularUser)
            ->get('/admin/dashboard');

        $response->assertRedirect('/');
    });

    it('allows access to admin registration management for admin users', function () {
        $admin = User::where('email', 'admin@parstama.id')->first();
        
        $response = $this->actingAs($admin)
            ->get('/admin/registrations');

        $response->assertStatus(200);
    });

    it('prevents access to admin registration management for non-admin users', function () {
        $regularUser = User::factory()->create([
            'email' => 'user@example.com',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($regularUser)
            ->get('/admin/registrations');

        $response->assertRedirect('/');
    });
});
