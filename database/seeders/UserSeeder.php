<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin Default
        User::firstOrCreate(
            ['email' => 'admin@lokerkita.com'],
            [
                'name' => 'Administrator LokerKita',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Akun User Biasa (Pencari Kerja)
        User::firstOrCreate(
            ['email' => 'user@lokerkita.com'],
            [
                'name' => 'User Pencari Kerja',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );
    }
}
