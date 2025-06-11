<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Menampilkan semua laporan dari pelapor.
     */
    public function index()
    {
        $laporan = Laporan::with('kategori')->latest()->get();

        return view('PetugasMelihatLaporan', compact('laporan'));
    }

    /**
     * Menampilkan detail satu laporan.
     */
    public function show($id)
    {
        $laporan = Laporan::with('kategori')->findOrFail($id);

        return view('PetugasMelihatLaporan', compact('laporan'));
    }

    /**
     * Petugas mengirim laporan ke admin.
     */
    public function kirimKeAdmin($id)
    {
        $laporan = Laporan::findOrFail($id);

        if ($laporan->dikirim_ke_admin) {
            return back()->with('warning', 'Laporan sudah dikirim ke admin.');
        }

        $laporan->dikirim_ke_admin = true;
        $laporan->save();

        return back()->with('success', 'Laporan berhasil dikirim ke admin.');
    }

    /**
     * Petugas mengubah status laporan.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->status = $request->status;
        $laporan->save();

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }
}
