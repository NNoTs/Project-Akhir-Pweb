<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

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
            'username' => 'required',
            'password' => 'required'
        ]);

        $admin = DB::table('admin')->where('email', $request->username)->first();
        if ($admin && Hash::check($request->password, $admin->password))
        {
            Session::put('user', $admin);
            Session::put('role', 'admin');
            return redirect('/DashboardAdmin');
        }

        $petugas = DB::table('petugas')->where('email', $request->username)->first();
        if ($petugas && Hash::check($request->password, $petugas->password))
        {
            Session::put('user', $petugas);
            Session::put('role', 'petugas');
            return redirect('/DashboardPetugas');
        }

        return back()->withErrors
        ([
            'login_gagal' => 'Username atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/login');
    }

}
