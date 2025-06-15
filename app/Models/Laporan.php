<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'tanggal_dikirim_admin'
    ];

    protected $dates =
    [
        'tanggal_dikirim_admin'
    ];

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriLaporan::class);
    }
}
