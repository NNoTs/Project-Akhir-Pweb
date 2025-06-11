<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Panggil semua seeder lainnya
        $this->call([
            AdminSeeder::class,
            PetugasSeeder::class,
            KategoriLaporanSeeder::class,
            LaporanSeeder::class,
        ]);
    }
}
