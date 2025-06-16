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
        // Jika ingin testing dengan factory:
        // User::factory(10)->create();

        // Jalankan semua seeder yang dibutuhkan:
        $this->call([
            AdminSeeder::class,
            PetugasSeeder::class,
            KategoriLaporanSeeder::class,
            LaporanSeeder::class,
        ]);

        // Contoh user jika dibutuhkan:
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

