<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilePetugasController extends Controller
{
    public function index()
    {
        $user = Auth::guard('petugas')->user();
        $guard = 'petugas';

        return view('profilePetugas', compact('user', 'guard'));
    }

    public function changePasswordPetugas()
    {
        return view('change-password-petugas');
    }

    public function changePasswordNow(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::guard('petugas')->user(); // GUNAKAN guard
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('petugas.profile')->with('success', 'Password berhasil diubah.');
    }
}
