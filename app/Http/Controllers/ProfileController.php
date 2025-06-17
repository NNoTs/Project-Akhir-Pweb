<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // ambil user dari guard yang sedang aktif
        $user  = Auth::user();
        $guard = Auth::getDefaultDriver();  // 'admin' atau 'petugas'

        return view('profile', compact('user','guard'));
    }
}
