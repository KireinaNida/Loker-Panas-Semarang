<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriList = [
            'IT & Teknologi',
            'Administrasi',
            'Pemasaran',
            'Teknik & Otomotif',
            'Retail & Sales',
            'Lainnya',
        ];

        foreach ($kategoriList as $nama) {
            Kategori::firstOrCreate(
                ['slug' => Str::slug($nama)],
                ['nama_kategori' => $nama]
            );
        }
    }
}
