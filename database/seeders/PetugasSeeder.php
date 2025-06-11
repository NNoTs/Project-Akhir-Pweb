<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        Petugas::create([
            'nama' => 'Petugas Satu',
            'email' => 'petugas1@example.com',
            'password' => Hash::make('petugas123')
        ]);

        Petugas::create([
            'nama' => 'Petugas Dua',
            'email' => 'petugas2@example.com',
            'password' => Hash::make('petugas456')
        ]);
    }
}
