<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('HalamanLogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email','password');

        // 1️⃣ coba guard admin
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();          // lindungi session fixation
            return redirect()->route('admin.dashboard');
        }

        // 2️⃣ coba guard petugas
        if (Auth::guard('petugas')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('petugas.laporan.index');
        }

        // gagal
        return back()->withErrors([
            'login_gagal' => 'Email atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        // Log‑out dari kedua guard jika ada
        Auth::guard('admin')->logout();
        Auth::guard('petugas')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
