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
            ->leftJoin('tanggapan', 'laporan.id', '=', 'tanggapan.laporan_id')
            ->select('laporan.*', 'kategori_laporan.nama_kategori', 'tanggapan.isi_tanggapan', 'tanggapan.status_persetujuan')
            ->get();

        return view('dashboardAdmin', compact('laporans'));
    }
    public function show($id)
    {
        $laporan = DB::table('laporan')
            ->leftJoin('kategori_laporan', 'laporan.kategori_id', '=', 'kategori_laporan.id')
            ->leftJoin('tanggapan', 'laporan.id', '=', 'tanggapan.laporan_id')
            ->select('laporan.*', 'kategori_laporan.nama_kategori', 'tanggapan.isi_tanggapan', 'tanggapan.status_persetujuan')
            ->where('laporan.id', $id)
            ->first();

        return view('DetailLaporanAdmin', compact('laporan'));
    }

    public function kirimTanggapan(Request $request, $id)
    {
        $cek = DB::table('tanggapan')->where('laporan_id', $id)->first();

        if ($cek) {
            // update kalau sudah ada
            DB::table('tanggapan')->where('laporan_id', $id)->update([
                'isi_tanggapan' => $request->input('isi_tanggapan'),
                'status_persetujuan' => $request->input('status'),
                'admin_id' => 1,
            ]);
        } else {
            // insert kalau belum ada
            DB::table('tanggapan')->insert([
                'laporan_id' => $id,
                'isi_tanggapan' => $request->input('isi_tanggapan'),
                'status_persetujuan' => $request->input('status'),
                'admin_id' => 1,
                'created_at' => now(),
            ]);
        }

        return redirect()->route('admin.dashboard')->with('status', 'Tanggapan berhasil disimpan.');
    }
}
