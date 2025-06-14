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
        Schema::create('riwayat_status', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan');
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak']);
            $table->foreignId('petugas_id')->constrained('petugas');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_status');
    }
};
