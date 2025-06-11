<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriLaporanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori_laporan')->insert([
            [
                'nama_kategori' => 'Fasilitas Umum',
                'deskripsi' => 'Laporan terkait jalan rusak, lampu mati, dan sejenisnya',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Kebersihan',
                'deskripsi' => 'Laporan tentang sampah, pencemaran, dll',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Infrastruktur',
                'deskripsi' => 'Laporan kejadian kriminal atau mencurigakan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Bencana Alam',
                'deskripsi' => 'Laporan kejadian kriminal atau mencurigakan',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
