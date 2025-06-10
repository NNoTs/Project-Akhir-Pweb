<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPetugas extends Controller
{
    public function dashboard()
    {
        return view('DashboardPetugas');
    }
}
