<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriLaporan extends Model
{
    protected $table = 'kategori_laporan';
    protected $fillable = ['nama_kategori'];

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'kategori_id');
    }
}