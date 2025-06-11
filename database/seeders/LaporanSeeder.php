<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laporan;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LaporanSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Laporan::create([
                'nama_pelapor'     => "Pelapor $i",
                'email_pelapor'    => "pelapor$i@email.com",
                'kategori_id'      => rand(1, 3), // pastikan kategori_id 1-3 sudah ada
                'judul'            => "Judul Laporan $i",
                'isi'              => "Ini adalah isi laporan ke-$i yang dikirim oleh pelapor.",
                'lokasi'           => "Lokasi ke-$i",
                'status'           => collect(['menunggu', 'diproses', 'selesai', 'ditolak'])->random(),
                'created_at'       => Carbon::now()->subDays(rand(0, 30)),
                'updated_at'       => Carbon::now(),
            ]);
        }
    }
}
