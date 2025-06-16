<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Petugas;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('HalamanLogin');
    }

    public function login(Request $request)
    {
        $request->validate
        ([
            'email' => 'required',
            'password' => 'required'
        ]);

        $admin = DB::table('admin')->where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password))
        {
            Session::put('user', $admin);
            Session::put('role', 'admin');
            return redirect()->route('admin.dashboard'); // Use named routes
        }

        $petugas = DB::table('petugas')->where('email', $request->email)->first();
        if ($petugas && Hash::check($request->password, $petugas->password))
        {
            Session::put('user', $petugas);
            Session::put('role', 'petugas');
            return redirect()->route('petugas.laporan.index');
        }

        return back()->withErrors([
            'login_gagal' => 'Email atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/login');
    }

}
