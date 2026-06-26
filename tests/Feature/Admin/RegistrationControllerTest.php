<?php

use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class);

/** @var TestCase $this */
describe('Admin Registration Controller', function () {
    beforeEach(function () {
        /** @var \Tests\TestCase $this */
        $this->user = User::factory()->create(['is_admin' => true]);
    });

    describe('Index - List Registrations', function () {
        it('requires authentication', function () {
            /** @var \Tests\TestCase $this */
            $response = $this->get(route('admin.registrations.index'));

            $response->assertRedirect(route('login'));
        });

        it('displays registrations list for authenticated users', function () {
            /** @var \Tests\TestCase $this */
            Registration::factory()->count(5)->create();

            $response = $this->actingAs($this->user)
                ->get(route('admin.registrations.index'));

            $response->assertStatus(200)
                ->assertViewIs('admin.registrations.index')
                ->assertViewHas('registrations')
                ->assertViewHas('filters')
                ->assertViewHas('filterOptions');
        });

        it('paginates registrations with 15 per page', function () {
            /** @var \Tests\TestCase $this */
            Registration::factory()->count(20)->create();

            $response = $this->actingAs($this->user)
                ->get(route('admin.registrations.index'));

            $registrations = $response->viewData('registrations');
            expect($registrations->count())->toBe(15);
        });

        it('orders registrations by created_at descending', function () {
            /** @var \Tests\TestCase $this */
            $old = Registration::factory()->create(['created_at' => now()->subDays(5)]);
            $new = Registration::factory()->create(['created_at' => now()]);

            $response = $this->actingAs($this->user)
                ->get(route('admin.registrations.index'));

            $registrations = $response->viewData('registrations');
            expect($registrations->first()->id)->toBe($new->id);
            expect($registrations->last()->id)->toBe($old->id);
        });

        it('filters registrations by status and search keyword', function () {
            Registration::factory()->create([
                'full_name' => 'Alya Pending',
                'status' => Registration::STATUS_PENDING,
            ]);
            Registration::factory()->create([
                'full_name' => 'Bima Accepted',
                'status' => Registration::STATUS_ACCEPTED,
            ]);

            $response = $this->actingAs($this->user)
                ->get(route('admin.registrations.index', [
                    'status' => Registration::STATUS_PENDING,
                    'search' => 'Alya',
                ]));

            $registrations = $response->viewData('registrations');

            expect($registrations)->toHaveCount(1);
            expect($registrations->first()->full_name)->toBe('Alya Pending');
        });
    });

    describe('Export Excel', function () {
        it('requires authentication', function () {
            /** @var \Tests\TestCase $this */
            $response = $this->get(route('admin.registrations.excel'));

            $response->assertRedirect(route('login'));
        });

        it('exports registrations to excel file', function () {
            /** @var \Tests\TestCase $this */
            Registration::factory()->count(5)->create();

            $response = $this->actingAs($this->user)
                ->get(route('admin.registrations.excel'));

            $response->assertStatus(200);
            $response->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            $response->assertHeader('content-disposition', 'attachment; filename=registrations.xlsx');
        });

        it('exports with empty list', function () {
            /** @var \Tests\TestCase $this */
            $response = $this->actingAs($this->user)
                ->get(route('admin.registrations.excel'));

            $response->assertStatus(200);
            $response->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        });
    });

    describe('Export PDF', function () {
        it('requires authentication', function () {
            /** @var \Tests\TestCase $this */
            $registration = Registration::factory()->create();

            $response = $this->get(route('admin.registrations.pdf', $registration->id));

            $response->assertRedirect(route('login'));
        });

        it('exports single registration to PDF', function () {
            /** @var \Tests\TestCase $this */
            $registration = Registration::factory()->create([
                'full_name' => 'John Doe',
                'email' => 'john@example.com',
            ]);

            $response = $this->actingAs($this->user)
                ->get(route('admin.registrations.pdf', $registration->id));

            $response->assertStatus(200);
            $response->assertHeader('content-type', 'application/pdf');
            expect($response->headers->get('content-disposition'))->toContain('registration_' . $registration->id);
        });

        it('returns 404 for non-existent registration', function () {
            /** @var \Tests\TestCase $this */
            $response = $this->actingAs($this->user)
                ->get(route('admin.registrations.pdf', 9999));

            $response->assertStatus(404);
        });
    });

    describe('Update Status', function () {
        it('requires authentication', function () {
            /** @var \Tests\TestCase $this */
            $registration = Registration::factory()->create();

            $response = $this->post(
                route('admin.registrations.status', $registration->id),
                ['status' => Registration::STATUS_ACCEPTED]
            );

            $response->assertRedirect(route('login'));
        });

        it('updates registration status to accepted', function () {
            /** @var \Tests\TestCase $this */
            $registration = Registration::factory()->create(['status' => Registration::STATUS_PENDING]);

            $response = $this->actingAs($this->user)
                ->post(
                    route('admin.registrations.status', $registration->id),
                    ['status' => Registration::STATUS_ACCEPTED]
                );

            $response->assertRedirect();
            $response->assertSessionHas('success', 'Status pendaftar berhasil diperbarui.');
            $this->assertDatabaseHas('registrations', [
                'id' => $registration->id,
                'status' => Registration::STATUS_ACCEPTED,
            ]);
        });

        it('updates registration status to rejected', function () {
            /** @var \Tests\TestCase $this */
            $registration = Registration::factory()->create(['status' => Registration::STATUS_PENDING]);

            $response = $this->actingAs($this->user)
                ->post(
                    route('admin.registrations.status', $registration->id),
                    ['status' => Registration::STATUS_REJECTED]
                );

            $response->assertRedirect();
            $response->assertSessionHas('success', 'Status pendaftar berhasil diperbarui.');
            $this->assertDatabaseHas('registrations', [
                'id' => $registration->id,
                'status' => Registration::STATUS_REJECTED,
            ]);
        });

        it('validates status must be valid enum', function () {
            /** @var \Tests\TestCase $this */
            $registration = Registration::factory()->create();

            $response = $this->actingAs($this->user)
                ->post(
                    route('admin.registrations.status', $registration->id),
                    ['status' => 'invalid_status']
                );

            $response->assertSessionHasErrors('status');
        });

        it('returns 404 for non-existent registration', function () {
            /** @var \Tests\TestCase $this */
            $response = $this->actingAs($this->user)
                ->post(
                    route('admin.registrations.status', 9999),
                    ['status' => Registration::STATUS_ACCEPTED]
                );

            $response->assertStatus(404);
        });
    });
});
