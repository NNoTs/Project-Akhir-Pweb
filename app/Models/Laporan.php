<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan'; // default Laravel = laporans, jadi kita override

    protected $fillable = [
        'nama_pelapor',
        'email_pelapor',
        'kategori_id',
        'judul',
        'isi',
        'lokasi',
        'status',
        'dikirim_ke_admin',
    ];

    // Relasi ke kategori
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriLaporan::class, 'kategori_id');
    }
}
