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
                'nama_panggilan' => 'Admin',
                'tgl_lahir' => '1998-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'no_telepon' => '081234567890',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Akun User Biasa (Pencari Kerja)
        User::firstOrCreate(
            ['email' => 'user@lokerkita.com'],
            [
                'name' => 'Budi Santoso',
                'nama_panggilan' => 'Budi',
                'tgl_lahir' => '2000-05-15',
                'jenis_kelamin' => 'Laki-laki',
                'no_telepon' => '081298765432',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );
    }
}
