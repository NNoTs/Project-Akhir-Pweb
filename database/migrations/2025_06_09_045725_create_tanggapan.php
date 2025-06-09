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
        Schema::create('tanggapan', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan');
            $table->foreignId('admin_id')->constrained('admin');
            $table->text('isi_tanggapan');
            $table->enum('status_persetujuan', ['disetujui', 'ditolak']);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapan');
    }
};
