<?php

/** @noinspection PhpUndefinedMethodInspection */

use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Registration Model', function () {
    describe('Creation and Attributes', function () {
        it('can create a registration', function () {
            $registration = Registration::factory()->create([
                'full_name' => 'John Doe',
                'email' => 'john@example.com',
            ]);

            expect($registration->full_name)->toBe('John Doe');
            expect($registration->email)->toBe('john@example.com');
            expect($registration->exists)->toBeTrue();
        });

        it('has correct fillable attributes', function () {
            $fillable = (new Registration())->getFillable();

            expect($fillable)->toContain('full_name', 'email', 'status', 'gender', 'birth_date');
        });

        it('table name is registrations', function () {
            $registration = new Registration();

            expect($registration->getTable())->toBe('registrations');
        });
    });

    describe('Status Constants', function () {
        it('has pending status constant', function () {
            expect(Registration::STATUS_PENDING)->toBe('pending');
        });

        it('has accepted status constant', function () {
            expect(Registration::STATUS_ACCEPTED)->toBe('accepted');
        });

        it('has rejected status constant', function () {
            expect(Registration::STATUS_REJECTED)->toBe('rejected');
        });
    });

    describe('Default Status', function () {
        it('creates registration without default status', function () {
            $registration = Registration::create([
                'full_name' => 'Jane Doe',
                'nickname' => 'Jane',
                'gender' => 'P',
                'birth_place' => 'Jakarta',
                'birth_date' => '2000-01-01',
                'address' => 'Jl. Test',
                'city' => 'Jakarta',
                'whatsapp' => '081234567890',
                'class' => '12',
                'major' => 'IPA',
                'motivation' => 'Test motivation with minimum 20 characters',
            ]);

            expect($registration->status)->toBeNull();
        });

        it('can set custom status on creation', function () {
            $registration = Registration::create([
                'full_name' => 'Jane Doe',
                'nickname' => 'Jane',
                'gender' => 'P',
                'birth_place' => 'Jakarta',
                'birth_date' => '2000-01-01',
                'address' => 'Jl. Test',
                'city' => 'Jakarta',
                'whatsapp' => '081234567890',
                'email' => 'jane2@example.com',
                'class' => '12',
                'major' => 'IPA',
                'motivation' => 'Test motivation with minimum 20 characters',
                'status' => Registration::STATUS_ACCEPTED,
            ]);

            expect($registration->status)->toBe(Registration::STATUS_ACCEPTED);
        });
    });

    describe('Registration Data', function () {
        it('stores all registration fields correctly', function () {
            $data = [
                'full_name' => 'Alice Smith',
                'nickname' => 'Al',
                'gender' => 'P',
                'birth_place' => 'Surabaya',
                'birth_date' => '1999-05-15',
                'religion' => 'Islam',
                'address' => 'Jl. Ahmad Yani No. 10',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'postal_code' => '60123',
                'whatsapp' => '082567890123',
                'email' => 'alice@example.com',
                'class' => '11',
                'major' => 'IPS',
                'blood_type' => 'O+',
                'medical_history' => 'None',
                'organization_experience' => 'OSIS, Debate Club',
                'motivation' => 'Ingin berkontribusi dalam organisasi yang berdampak positif.',
            ];

            $registration = Registration::create($data);

            foreach ($data as $key => $value) {
                expect($registration->{$key})->toBe($value);
            }
        });

        it('handles nullable fields correctly', function () {
            $registration = Registration::factory()->create([
                'nickname' => null,
                'city' => null,
                'religion' => null,
                'province' => null,
                'postal_code' => null,
                'blood_type' => null,
                'medical_history' => null,
                'organization_experience' => null,
            ]);

            expect($registration->nickname)->toBeNull();
            expect($registration->city)->toBeNull();
            expect($registration->religion)->toBeNull();
        });
    });

    describe('Timestamps', function () {
        it('has created_at timestamp', function () {
            $registration = Registration::factory()->create();

            expect($registration->created_at)->not->toBeNull();
            expect($registration->created_at)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
        });

        it('has updated_at timestamp', function () {
            $registration = Registration::factory()->create();

            expect($registration->updated_at)->not->toBeNull();
            expect($registration->updated_at)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
        });
    });

    describe('Query Methods', function () {
        it('can find registration by id', function () {
            $registration = Registration::factory()->create();

            $found = Registration::find($registration->id);

            expect($found->id)->toBe($registration->id);
        });

        it('can query registrations by status', function () {
            Registration::factory()->count(3)->create(['status' => Registration::STATUS_PENDING]);
            Registration::factory()->count(2)->create(['status' => Registration::STATUS_ACCEPTED]);

            $pending = Registration::where('status', Registration::STATUS_PENDING)->get();

            expect($pending->count())->toBe(3);
        });

        it('can query registrations by email', function () {
            $registration = Registration::factory()->create(['email' => 'test@example.com']);

            $found = Registration::where('email', 'test@example.com')->first();

            expect($found->id)->toBe($registration->id);
        });
    });
});
