<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'nama_pelapor',
        'email_pelapor',
        'kategori_id',
        'judul',
        'isi',
        'lokasi',
        'status',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriLaporan::class, 'kategori_id');
    }
}
