<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori_laporan', function (Blueprint $table) {
            $table->id(); // ganti dari integer ke id()
            $table->string('nama_kategori');
            $table->text('deskripsi');
            $table->timestamps(); // tambahkan timestamps untuk konsistensi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_laporan');
    }
};
