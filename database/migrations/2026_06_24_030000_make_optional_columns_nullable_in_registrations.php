<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * SQLite tidak mendukung ALTER COLUMN secara langsung,
     * jadi kita buat ulang tabel dengan skema baru.
     */
    public function up(): void
    {
        // Ambil semua data yang ada
        $existing = DB::table('registrations')->get();

        // Drop tabel lama
        Schema::drop('registrations');

        // Buat tabel baru dengan kolom yang diperbarui
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->enum('gender', ['L', 'P']);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('religion')->nullable();       // nullable sekarang
            $table->text('address');
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('whatsapp');
            $table->string('email')->nullable();          // nullable sekarang
            $table->string('class');
            $table->string('major');
            $table->string('blood_type')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('organization_experience')->nullable();
            $table->text('motivation');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });

        // Restore data yang ada (jika ada)
        foreach ($existing as $row) {
            DB::table('registrations')->insert((array) $row);
        }
    }

    public function down(): void
    {
        // Kembalikan ke skema asli (dengan NOT NULL)
        $existing = DB::table('registrations')->get();

        Schema::drop('registrations');

        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->enum('gender', ['L', 'P']);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('religion');
            $table->text('address');
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('whatsapp');
            $table->string('email')->unique();
            $table->string('class');
            $table->string('major');
            $table->string('blood_type')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('organization_experience')->nullable();
            $table->text('motivation');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });

        foreach ($existing as $row) {
            DB::table('registrations')->insert((array) $row);
        }
    }
};
