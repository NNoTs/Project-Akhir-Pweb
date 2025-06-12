<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriLaporanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori_laporan')->insert([
            [
                'nama_kategori' => 'Fasilitas Umum',
                'deskripsi' => 'Laporan terkait jalan rusak, lampu mati, dan sejenisnya.',
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
            [
                'nama_kategori' => 'Kebersihan',
                'deskripsi' => 'Laporan tentang sampah, pencemaran, dll.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kategori' => 'Infrastruktur',
                'deskripsi' => 'Laporan terkait infrastruktur seperti jembatan, trotoar, dan gedung publik.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kategori' => 'Bencana Alam',
                'deskripsi' => 'Laporan terkait banjir, longsor, gempa bumi, dan sejenisnya.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
