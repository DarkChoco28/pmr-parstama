<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->enum('gender', ['L', 'P']); // L = Laki‑laki, P = Perempuan
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
