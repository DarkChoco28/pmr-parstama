<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Add indexes for frequently queried columns
            $table->index('status');
            $table->index('email');
            $table->index('whatsapp');
            $table->index('created_at');
            $table->index(['status', 'created_at']); // Composite index for filtering by status and date
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Drop indexes
            $table->dropIndex(['status']);
            $table->dropIndex(['email']);
            $table->dropIndex(['whatsapp']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status', 'created_at']);
        });
    }
};
