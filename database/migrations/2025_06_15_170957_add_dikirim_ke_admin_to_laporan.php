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
        Schema::table('laporan', function (Blueprint $table) {
            $table->boolean('dikirim_ke_admin')->nullable()->after('status');
            $table->datetime('tanggal_dikirim_admin')->nullable()->after('dikirim_ke_admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropColumn('dikirim_ke_admin');
            $table->dropColumn('tanggal_dikirim_admin');
        });
    }
};
