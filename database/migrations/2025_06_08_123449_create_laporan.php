<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table)
        {
            $table->id();

            $table->string('nama_pelapor');
            $table->string('email_pelapor');
            $table->foreignId('kategori_id')
                  ->nullable()
                  ->constrained('kategori_laporan')
                  ->onDelete('set null');
            $table->string('judul');
            $table->text('isi');
            $table->string('lokasi');
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
