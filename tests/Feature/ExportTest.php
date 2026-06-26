<?php

use App\Models\Registration;
use App\Models\User;
use App\Exports\RegistrationsExport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

uses(RefreshDatabase::class);

/** @var TestCase $this */
describe('Export Feature', function () {
    beforeEach(function () {
        $this->admin = User::factory()->create([
            'email' => 'admin@parstama.id',
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);
        
        // Create some test registrations
        Registration::factory()->count(5)->create();
    });

    describe('Excel Export', function () {
        it('allows admin users to export registrations to Excel', function () {
            Excel::fake();
            
            $response = $this->actingAs($this->admin)
                ->get(route('admin.registrations.excel'));

            $response->assertStatus(200);
            Excel::assertDownloaded('registrations.xlsx');
        });

        it('prevents non-admin users from exporting to Excel', function () {
            $regularUser = User::factory()->create([
                'email' => 'user@example.com',
                'email_verified_at' => now(),
            ]);

            $response = $this->actingAs($regularUser)
                ->get(route('admin.registrations.excel'));

            $response->assertStatus(403);
        });

        it('exports all registrations with correct headings', function () {
            $export = new RegistrationsExport();
            $headings = $export->headings();
            
            expect($headings)->toBe([
                'Nama Lengkap',
                'Nama Panggilan',
                'Jenis Kelamin',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Alamat Lengkap',
                'Kota',
                'WhatsApp',
                'Kelas',
                'Jurusan',
                'Pengalaman Organisasi',
                'Alasan Bergabung',
                'Status',
                'Tanggal Daftar',
            ]);
        });

        it('exports registration data correctly', function () {
            $export = new RegistrationsExport();
            $collection = $export->collection();
            
            expect($collection->count())->toBe(5);
        });

        it('exports registrations based on active filters', function () {
            Registration::factory()->create([
                'full_name' => 'Alya Pending',
                'status' => Registration::STATUS_PENDING,
                'class' => '10',
                'major' => 'TKJ',
            ]);
            Registration::factory()->create([
                'full_name' => 'Bima Accepted',
                'status' => Registration::STATUS_ACCEPTED,
                'class' => '11',
                'major' => 'RPL',
            ]);

            $export = new RegistrationsExport([
                'status' => Registration::STATUS_PENDING,
                'search' => 'Alya',
                'class' => '10',
                'major' => 'TKJ',
            ]);

            $collection = $export->collection();

            expect($collection)->toHaveCount(1);
            expect($collection->first()->full_name)->toBe('Alya Pending');
        });
    });

    describe('PDF Export', function () {
        it('allows admin users to export single registration to PDF', function () {
            $registration = Registration::first();
            
            $response = $this->actingAs($this->admin)
                ->get(route('admin.registrations.pdf', $registration->id));

            $response->assertStatus(200);
            $response->assertHeader('content-type', 'application/pdf');
        });

        it('prevents non-admin users from exporting to PDF', function () {
            $regularUser = User::factory()->create([
                'email' => 'user@example.com',
                'email_verified_at' => now(),
            ]);
            $registration = Registration::first();

            $response = $this->actingAs($regularUser)
                ->get(route('admin.registrations.pdf', $registration->id));

            $response->assertStatus(403);
        });

        it('returns 404 for non-existent registration when exporting PDF', function () {
            $response = $this->actingAs($this->admin)
                ->get(route('admin.registrations.pdf', 99999));

            $response->assertStatus(404);
        });
    });
});
