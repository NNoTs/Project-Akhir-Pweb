<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_laporan')->insert([
            [
                'nama_kategori' => 'Fasilitas Umum',
                'deskripsi' => 'Masalah terkait fasilitas umum seperti jalan, lampu, dll.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kategori' => 'Lingkungan',
                'deskripsi' => 'Pengaduan tentang kebersihan, sampah, dan pencemaran.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kategori' => 'Keamanan',
                'deskripsi' => 'Laporan berkaitan dengan keamanan masyarakat.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
