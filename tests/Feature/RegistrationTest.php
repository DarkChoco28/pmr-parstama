<?php

use App\Models\Registration;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class);

/** @var TestCase $this */
describe('Registration Feature', function () {
    describe('Create Form', function () {
        it('shows registration form when registration is open', function () {
            Setting::set('registration_open', '1');

            $response = $this->get('/daftar');

            $response->assertStatus(200)
                ->assertViewIs('registration.create')
                ->assertViewHas('registrationOpen', true);
        });

        it('shows registration form even when closed (user still sees form)', function () {
            Setting::set('registration_open', '0');

            $response = $this->get('/daftar');

            $response->assertStatus(200)
                ->assertViewIs('registration.create')
                ->assertViewHas('registrationOpen', false);
        });

        it('displays a form with required fields', function () {
            $response = $this->get('/daftar');

            $response->assertStatus(200);
            // This would verify form fields if view assertions were more specific
        });
    });

    describe('Store Registration', function () {
        it('stores a valid registration successfully', function () {
            Setting::set('registration_open', '1');

            $data = [
                'full_name' => 'John Doe',
                'nickname' => 'Johnny',
                'gender' => 'L',
                'birth_place' => 'Jakarta',
                'birth_date' => '2000-01-01',
                'address' => 'Jalan Merdeka No. 1',
                'city' => 'Jakarta',
                'whatsapp' => '081234567890',
                'class' => '12',
                'major' => 'IPA',
                'organization_experience' => 'OSIS',
                'motivation' => 'Saya ingin bergabung dengan organisasi ini karena sangat tertarik.',
                'parent_consent' => '1',
            ];

            $response = $this->post('/daftar', $data);

            $response->assertRedirect(route('registration.thankyou'));
            $this->assertDatabaseHas('registrations', [
                'full_name' => 'John Doe',
                'status' => Registration::STATUS_PENDING,
            ]);
        });

        it('rejects submission when registration is closed', function () {
            Setting::set('registration_open', '0');

            $data = [
                'full_name' => 'John Doe',
                'nickname' => 'Johnny',
                'gender' => 'L',
                'birth_place' => 'Jakarta',
                'birth_date' => '2000-01-01',
                'address' => 'Jalan Merdeka No. 1',
                'city' => 'Jakarta',
                'whatsapp' => '081234567890',
                'class' => '12',
                'major' => 'IPA',
                'organization_experience' => 'OSIS',
                'motivation' => 'Saya ingin bergabung dengan organisasi ini karena sangat tertarik.',
                'parent_consent' => '1',
            ];

            $response = $this->post('/daftar', $data);

            $response->assertRedirect(route('registration.create'))
                ->assertSessionHas('error', 'Pendaftaran saat ini telah ditutup. Silakan coba lagi nanti.');
            $this->assertDatabaseCount('registrations', 0);
        });

        it('validates required fields', function () {
            Setting::set('registration_open', '1');

            $response = $this->post('/daftar', []);

            $response->assertSessionHasErrors([
                'full_name',
                'gender',
                'birth_place',
                'birth_date',
                'address',
                'whatsapp',
                'class',
                'major',
                'motivation',
                'parent_consent',
            ]);
        });

        it('validates full_name max length', function () {
            Setting::set('registration_open', '1');

            $data = [
                'full_name' => str_repeat('a', 256),
                'nickname' => 'test',
                'gender' => 'L',
                'birth_place' => 'Jakarta',
                'birth_date' => '2000-01-01',
                'address' => 'Test Address',
                'city' => 'Jakarta',
                'whatsapp' => '081234567890',
                'class' => '12',
                'major' => 'IPA',
                'organization_experience' => 'OSIS',
                'motivation' => 'Saya ingin bergabung dengan organisasi ini karena sangat tertarik.',
                'parent_consent' => '1',
            ];

            $response = $this->post('/daftar', $data);

            $response->assertSessionHasErrors('full_name');
        });

        it('validates gender must be L or P', function () {
            Setting::set('registration_open', '1');

            $data = [
                'full_name' => 'John Doe',
                'nickname' => 'Johnny',
                'gender' => 'X', // Invalid
                'birth_place' => 'Jakarta',
                'birth_date' => '2000-01-01',
                'address' => 'Test Address',
                'city' => 'Jakarta',
                'whatsapp' => '081234567890',
                'class' => '12',
                'major' => 'IPA',
                'organization_experience' => 'OSIS',
                'motivation' => 'Saya ingin bergabung dengan organisasi ini karena sangat tertarik.',
                'parent_consent' => '1',
            ];

            $response = $this->post('/daftar', $data);

            $response->assertSessionHasErrors('gender');
        });

        it('validates birth_date is a valid date', function () {
            Setting::set('registration_open', '1');

            $data = [
                'full_name' => 'John Doe',
                'nickname' => 'Johnny',
                'gender' => 'L',
                'birth_place' => 'Jakarta',
                'birth_date' => 'invalid-date',
                'address' => 'Test Address',
                'city' => 'Jakarta',
                'whatsapp' => '081234567890',
                'class' => '12',
                'major' => 'IPA',
                'organization_experience' => 'OSIS',
                'motivation' => 'Saya ingin bergabung dengan organisasi ini karena sangat tertarik.',
            ];

            $response = $this->post('/daftar', $data);

            $response->assertSessionHasErrors('birth_date');
        });

        it('validates motivation minimum 20 characters', function () {
            Setting::set('registration_open', '1');

            $data = [
                'full_name' => 'John Doe',
                'nickname' => 'Johnny',
                'gender' => 'L',
                'birth_place' => 'Jakarta',
                'birth_date' => '2000-01-01',
                'address' => 'Test Address',
                'city' => 'Jakarta',
                'whatsapp' => '081234567890',
                'class' => '12',
                'major' => 'IPA',
                'organization_experience' => 'OSIS',
                'motivation' => 'Short',
                'parent_consent' => '1',
            ];

            $response = $this->post('/daftar', $data);

            $response->assertSessionHasErrors('motivation');
        });

        it('stores registration with pending status', function () {
            Setting::set('registration_open', '1');

            $data = [
                'full_name' => 'Jane Doe',
                'nickname' => 'Jane',
                'gender' => 'P',
                'birth_place' => 'Bandung',
                'birth_date' => '2001-05-15',
                'address' => 'Jalan Sudirman',
                'city' => 'Bandung',
                'whatsapp' => '082234567890',
                'class' => '11',
                'major' => 'IPS',
                'organization_experience' => 'MPK',
                'motivation' => 'Saya ingin berkontribusi dalam organisasi yang berdampak.',
                'parent_consent' => '1',
            ];

            $this->post('/daftar', $data);

            $registration = Registration::where('full_name', 'Jane Doe')->first();
            expect($registration->status)->toBe(Registration::STATUS_PENDING);
        });
    });

    describe('Thank You Page', function () {
        it('displays thank you page', function () {
            $response = $this->get('/daftar/terima-kasih');

            $response->assertStatus(200)
                ->assertViewIs('registration.thankyou');
        });
    });

    describe('Status Check', function () {
        it('displays status check page', function () {
            $response = $this->get(route('registration.status'));

            $response->assertOk()
                ->assertViewIs('registration.status');
        });

        it('finds registration status by whatsapp and birth date', function () {
            $registration = Registration::factory()->create([
                'full_name' => 'Nadia Putri',
                'whatsapp' => '081234567890',
                'birth_date' => '2008-02-10',
                'status' => Registration::STATUS_ACCEPTED,
            ]);

            $response = $this->post(route('registration.status.find'), [
                'whatsapp' => '081234567890',
                'birth_date' => '2008-02-10',
            ]);

            $response->assertOk()
                ->assertViewHas('registration', function ($found) use ($registration) {
                    return $found !== null && $found->is($registration);
                });
        });

        it('requires parent consent before storing registration', function () {
            Setting::set('registration_open', '1');

            $response = $this->post('/daftar', [
                'full_name' => 'Rizky',
                'gender' => 'L',
                'birth_place' => 'Malang',
                'birth_date' => '2008-02-10',
                'address' => 'Jl. Mawar No. 1',
                'whatsapp' => '081299998888',
                'class' => '10',
                'major' => 'TKJ',
                'motivation' => 'Saya ingin belajar disiplin, kepedulian, dan keterampilan pertolongan pertama.',
            ]);

            $response->assertSessionHasErrors('parent_consent');
        });

        it('prevents duplicate whatsapp registration', function () {
            Setting::set('registration_open', '1');

            Registration::factory()->create([
                'whatsapp' => '081234567890',
                'email' => 'awal@example.com',
            ]);

            $response = $this->post('/daftar', [
                'full_name' => 'Raka',
                'gender' => 'L',
                'birth_place' => 'Malang',
                'birth_date' => '2008-02-10',
                'address' => 'Jl. Kenanga No. 2',
                'whatsapp' => '081234567890',
                'email' => 'baru@example.com',
                'class' => '10',
                'major' => 'TKJ',
                'motivation' => 'Saya ingin bergabung karena ingin belajar kepemimpinan dan kepedulian sosial bersama PMR.',
                'parent_consent' => '1',
            ]);

            $response->assertSessionHasErrors('whatsapp');
        });
    });
});
