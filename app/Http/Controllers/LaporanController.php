<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::with('kategori')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('petugas.laporan.index', compact('laporan'));
    }

    public function show($id)
    {
        $laporan = Laporan::with('kategori')->findOrFail($id);
        
        return view('petugas.laporan.show', compact('laporan'));
    }


    public function editStatus($id)
    {
        $laporan = Laporan::with('kategori')->findOrFail($id);
        return view('petugas.laporan.edit_status', compact('laporan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $laporan = Laporan::findOrFail($id);
        
        // Log status change if needed
        $oldStatus = $laporan->status;
        
        $updateData = [
            'status' => $request->status,
            'updated_at' => now()
        ];

        // Add catatan if provided
        if ($request->filled('catatan')) {
            $updateData['catatan_status'] = $request->catatan;
        }

        $laporan->update($updateData);

        return redirect()->route('petugas.laporan.index')
            ->with('success', 'Status laporan berhasil diperbarui dari "' . ucfirst($oldStatus) . '" ke "' . ucfirst($request->status) . '".');
    }

    public function kirimKeAdmin($id)
    {
        $laporan = Laporan::findOrFail($id);

        if ($laporan->dikirim_ke_admin) {
            return redirect()->route('petugas.laporan.index')
                ->with('warning', 'Laporan ini sudah dikirim ke admin sebelumnya.');
        }

        // Update status to sent to admin
        $laporan->update([
            'dikirim_ke_admin' => true,
            'tanggal_dikirim_admin' => now(),
            'status' => 'diproses'
        ]);

        // Optional: Send notification to admin
        // $this->notifyAdmin($laporan);

        return redirect()->route('petugas.laporan.index')
            ->with('success', 'Laporan berhasil dikirim ke admin untuk ditindaklanjuti.');
    }

    public function getStatistics()
    {
        $stats = [
            'total' => Laporan::count(),
            'menunggu' => Laporan::where('status', 'menunggu')->count(),
            'diproses' => Laporan::where('status', 'diproses')->count(),
            'selesai' => Laporan::where('status', 'selesai')->count(),
            'ditolak' => Laporan::where('status', 'ditolak')->count(),
            'belum_dikirim_admin' => Laporan::where('dikirim_ke_admin', false)->count(),
            'sudah_dikirim_admin' => Laporan::where('dikirim_ke_admin', true)->count(),
        ];

        return $stats;
    }
}