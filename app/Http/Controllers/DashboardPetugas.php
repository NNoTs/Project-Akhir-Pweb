<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class DashboardPetugas extends Controller
{
    public function dashboard()
    {
        $laporan = Laporan::all();
        return view('DashboardPetugas', compact('laporan'));
    }
}
