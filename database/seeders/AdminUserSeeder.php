<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@parstama.id'],
            [
                'name' => 'Admin PMR PARSTAMA',
                'password' => Hash::make('admin123'), // password: admin123
                // Jika menggunakan Laravel Breeze, pastikan email ter‑verifikasi jika middleware memerlukannya
                'email_verified_at' => now(),
            ] 
        );
    }
}
