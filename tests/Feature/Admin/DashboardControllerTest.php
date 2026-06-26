<?php

use App\Models\Registration;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class);

/** @var TestCase $this */
describe('Admin Dashboard Controller', function () {
    beforeEach(function () {
        /** @var \Tests\TestCase $this */
        $this->user = User::factory()->create(['is_admin' => true]);
    });

    describe('Dashboard Index', function () {
        it('requires authentication', function () {
            /** @var \Tests\TestCase $this */
            $response = $this->get(route('admin.dashboard'));

            $response->assertRedirect(route('login'));
        });

        it('displays admin dashboard for authenticated users', function () {
            /** @var \Tests\TestCase $this */
            $response = $this->actingAs($this->user)
                ->get(route('admin.dashboard'));

            $response->assertStatus(200)
                ->assertViewIs('admin.dashboard');
        });
    });

    describe('Dashboard Stats API', function () {
        it('requires authentication', function () {
            /** @var \Tests\TestCase $this */
            $response = $this->get(route('admin.dashboard.stats'));

            $response->assertRedirect(route('login'));
        });

        it('returns dashboard statistics as JSON', function () {
            /** @var \Tests\TestCase $this */
            Registration::factory()->count(5)->create(['status' => Registration::STATUS_PENDING]);

            $response = $this->actingAs($this->user)
                ->get(route('admin.dashboard.stats'));

            $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'data' => [
                        'total' => 5,
                        'pending' => 5,
                        'accepted' => 0,
                    ],
                ])
                ->assertJsonStructure([
                    'success',
                    'message',
                    'data' => [
                        'total',
                        'today',
                        'pending',
                        'accepted',
                        'registration_open',
                        'recent',
                    ],
                    'meta',
                ]);
        });

        it('counts total registrations correctly', function () {
            /** @var \Tests\TestCase $this */
            Registration::factory()->count(10)->create();

            $response = $this->actingAs($this->user)
                ->get(route('admin.dashboard.stats'));

            expect($response->json('data.total'))->toBe(10);
        });

        it('counts today registrations', function () {
            /** @var \Tests\TestCase $this */
            Registration::factory()->create(['created_at' => now()]);
            Registration::factory()->create(['created_at' => now()->subDay()]);

            $response = $this->actingAs($this->user)
                ->get(route('admin.dashboard.stats'));

            expect($response->json('data.today'))->toBe(1);
        });

        it('counts pending registrations correctly', function () {
            /** @var \Tests\TestCase $this */
            Registration::factory()->count(3)->create(['status' => Registration::STATUS_PENDING]);
            Registration::factory()->count(2)->create(['status' => Registration::STATUS_ACCEPTED]);

            $response = $this->actingAs($this->user)
                ->get(route('admin.dashboard.stats'));

            expect($response->json('data.pending'))->toBe(3);
        });

        it('counts accepted registrations correctly', function () {
            /** @var \Tests\TestCase $this */
            Registration::factory()->count(2)->create(['status' => Registration::STATUS_PENDING]);
            Registration::factory()->count(4)->create(['status' => Registration::STATUS_ACCEPTED]);

            $response = $this->actingAs($this->user)
                ->get(route('admin.dashboard.stats'));

            expect($response->json('data.accepted'))->toBe(4);
        });

        it('returns registration_open status', function () {
            /** @var \Tests\TestCase $this */
            Setting::set('registration_open', '1');

            $response = $this->actingAs($this->user)
                ->get(route('admin.dashboard.stats'));

            expect($response->json('data.registration_open'))->toBe(true);
        });

        it('returns false when registration is closed', function () {
            /** @var \Tests\TestCase $this */
            Setting::set('registration_open', '0');

            $response = $this->actingAs($this->user)
                ->get(route('admin.dashboard.stats'));

            expect($response->json('data.registration_open'))->toBe(false);
        });

        it('returns recent registrations with correct fields', function () {
            /** @var \Tests\TestCase $this */
            $regs = Registration::factory()->count(7)->create();

            $response = $this->actingAs($this->user)
                ->get(route('admin.dashboard.stats'));

            $recent = $response->json('data.recent');
            expect(count($recent))->toBe(5);
            expect($recent[0])->toHaveKeys(['id', 'full_name', 'email', 'class', 'status', 'created_at']);
        });

        it('returns recent in correct order (newest first)', function () {
            /** @var \Tests\TestCase $this */
            $old = Registration::factory()->create(['created_at' => now()->subDays(5)]);
            $new = Registration::factory()->create(['created_at' => now()]);

            $response = $this->actingAs($this->user)
                ->get(route('admin.dashboard.stats'));

            $recent = $response->json('data.recent');
            expect($recent[0]['id'])->toBe($new->id);
            expect($recent[1]['id'])->toBe($old->id);
        });

        it('returns empty stats when no registrations', function () {
            /** @var \Tests\TestCase $this */
            $response = $this->actingAs($this->user)
                ->get(route('admin.dashboard.stats'));

            $response->assertJson([
                'success' => true,
                'data' => [
                    'total' => 0,
                    'today' => 0,
                    'pending' => 0,
                    'accepted' => 0,
                ],
            ]);
            expect($response->json('data.recent'))->toBeEmpty();
        });
    });

    describe('Toggle Registration', function () {
        it('requires authentication', function () {
            /** @var \Tests\TestCase $this */
            $response = $this->post(route('admin.dashboard.toggle'));

            $response->assertRedirect(route('login'));
        });

        it('toggles registration from open to closed', function () {
            /** @var \Tests\TestCase $this */
            Setting::set('registration_open', '1');

            $response = $this->actingAs($this->user)
                ->post(route('admin.dashboard.toggle'));

            $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'data' => [
                        'registration_open' => false,
                    ],
                ]);
        });

        it('toggles registration from closed to open', function () {
            /** @var \Tests\TestCase $this */
            Setting::set('registration_open', '0');

            $response = $this->actingAs($this->user)
                ->post(route('admin.dashboard.toggle'));

            $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'data' => [
                        'registration_open' => true,
                    ],
                ]);
        });

        it('returns appropriate message when opening', function () {
            /** @var \Tests\TestCase $this */
            Setting::set('registration_open', '0');

            $response = $this->actingAs($this->user)
                ->post(route('admin.dashboard.toggle'));

            expect($response->json('message'))->toBe('Pendaftaran telah DIBUKA.');
        });

        it('returns appropriate message when closing', function () {
            /** @var \Tests\TestCase $this */
            Setting::set('registration_open', '1');

            $response = $this->actingAs($this->user)
                ->post(route('admin.dashboard.toggle'));

            expect($response->json('message'))->toBe('Pendaftaran telah DITUTUP.');
        });

        it('persists toggled state in database', function () {
            /** @var \Tests\TestCase $this */
            Setting::set('registration_open', '1');

            $this->actingAs($this->user)
                ->post(route('admin.dashboard.toggle'));

            expect(Setting::isRegistrationOpen())->toBe(false);

            $this->actingAs($this->user)
                ->post(route('admin.dashboard.toggle'));

            expect(Setting::isRegistrationOpen())->toBe(true);
        });
    });
});
