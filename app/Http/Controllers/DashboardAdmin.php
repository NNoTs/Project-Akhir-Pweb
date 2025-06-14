<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardAdmin extends Controller
{
    // Menampilkan semua laporan
    public function dashboard()
    {
        $laporans = DB::table('laporan')
            ->leftJoin('kategori_laporan', 'laporan.kategori_id', '=', 'kategori_laporan.id')
            ->select('laporan.*', 'kategori_laporan.nama_kategori')
            ->orderBy('laporan.created_at', 'desc')
            ->get();

        return view('DashboardAdmin', compact('laporans'));
    }

    // Menampilkan detail laporan berdasarkan ID
    public function show($id)
    {
        $laporan = DB::table('laporan')->where('id', $id)->first();
        $tanggapans = DB::table('tanggapan')->where('laporan_id', $id)->get();

        return view('DetailLaporanAdmin', compact('laporan', 'tanggapans'));
    }

    // Menyimpan tanggapan admin terhadap laporan
    public function tanggapan(Request $request, $id)
    {
        DB::table('tanggapan')->insert([
            'laporan_id' => $id,
            'admin_id' => 1, // sementara hardcode admin_id
            'isi_tanggapan' => $request->isi_tanggapan,
            'status_persetujuan' => 'menunggu',
            'created_at' => now()
        ]);

        return redirect('/DashboardAdmin/' . $id)->with('success', 'Tanggapan berhasil dikirim.');
    }

    // Menyimpan status verifikasi laporan
    public function verifikasi(Request $request, $id)
    {
        DB::table('verifikasi')->insert([
            'laporan_id' => $id,
            'admin_id' => 1, // sementara hardcode admin_id
            'status_verifikasi' => $request->status,
            'created_at' => now()
        ]);

        DB::table('laporan')->where('id', $id)->update([
            'status' => $request->status
        ]);

        return redirect('/DashboardAdmin/' . $id)->with('success', 'Laporan berhasil diverifikasi.');
    }
}
