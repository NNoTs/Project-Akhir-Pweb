<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriLaporan; 

class BerandaController extends Controller
{
    public function index()
    {
        $kategori = KategoriLaporan::all();
        return view('beranda', compact('kategori'));
    }
}
