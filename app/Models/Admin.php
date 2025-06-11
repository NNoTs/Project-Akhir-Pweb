<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin'; // penting, karena default Laravel pakai 'admins'

    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    protected $hidden = ['password'];
}
