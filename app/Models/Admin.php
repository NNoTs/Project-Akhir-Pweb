<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // ⬅️ penting
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';           // nama tabel
    protected $fillable = ['nama','email','password'];
    protected $hidden   = ['password','remember_token'];
}
