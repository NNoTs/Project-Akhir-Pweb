<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\KategoriLaporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $kategori = KategoriLaporan::all();
        return view('beranda', compact('kategori'));
    }
    public function lihat()
    {
        $laporan = Laporan::with('kategori')->latest()->get();

        return view('lihatlaporan', compact('laporan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'email_pelapor' => 'required|email',
            'kategori_id' => 'required|exists:kategori_laporan,id',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'lokasi' => 'required|string|max:255',
        ]);

        Laporan::create([
            'nama_pelapor' => $request->nama_pelapor,
            'email_pelapor' => $request->email_pelapor,
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'lokasi' => $request->lokasi,
        ]);

        return redirect('/')->with('success', 'Laporan berhasil dikirim.');
    }
}
