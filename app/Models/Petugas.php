<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas'; // override nama tabel default

    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    protected $hidden = ['password'];
}
