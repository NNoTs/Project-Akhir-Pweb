<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the laporan.
     */
    public function index()
    {
        $laporan = Laporan::with('kategori')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('petugas.laporan.index', compact('laporan'));
    }

    /**
     * Display the specified laporan detail.
     */
    public function show($id)
    {
        $laporan = Laporan::with('kategori')->findOrFail($id);
        
        return view('PetugasMelihatDetailLaporan', compact('laporan'));
    }

    /**
     * Update the status of the specified laporan.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
        ]);

        $laporan = Laporan::findOrFail($id);
        
        // Log status change if needed
        $oldStatus = $laporan->status;
        
        $laporan->update([
            'status' => $request->status,
            'updated_at' => now()
        ]);

        // Optional: Log the status change
        // Log::info("Status laporan ID {$id} diubah dari {$oldStatus} ke {$request->status}");

        return redirect()->route('petugas.laporan.index')
            ->with('success', 'Status laporan berhasil diperbarui dari "' . ucfirst($oldStatus) . '" ke "' . ucfirst($request->status) . '".');
    }

    /**
     * Send laporan to admin.
     */
    public function kirimKeAdmin($id)
    {
        $laporan = Laporan::findOrFail($id);

        // Check if already sent
        if ($laporan->dikirim_ke_admin) {
            return redirect()->route('petugas.laporan.index')
                ->with('warning', 'Laporan ini sudah dikirim ke admin sebelumnya.');
        }

        // Update status to sent to admin
        $laporan->update([
            'dikirim_ke_admin' => true,
            'tanggal_dikirim_admin' => now(),
            'status' => 'diproses' // Optional: automatically change status when sent to admin
        ]);

        // Optional: Send notification to admin
        // $this->notifyAdmin($laporan);

        return redirect()->route('petugas.laporan.index')
            ->with('success', 'Laporan berhasil dikirim ke admin untuk ditindaklanjuti.');
    }

    /**
     * Get laporan statistics for dashboard.
     */
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

    /**
     * Get recent laporan for dashboard.
     */
    public function getRecentLaporan($limit = 5)
    {
        return Laporan::with('kategori')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Filter laporan by status.
     */
    public function filterByStatus(Request $request)
    {
        $status = $request->get('status');
        
        $query = Laporan::with('kategori');
        
        if ($status && $status !== 'semua') {
            $query->where('status', $status);
        }
        
        $laporan = $query->orderBy('created_at', 'desc')->get();
        
        return view('petugas.laporan.index', compact('laporan'));
    }

    /**
     * Search laporan.
     */
    public function search(Request $request)
    {
        $keyword = $request->get('search');
        
        $laporan = Laporan::with('kategori')
            ->where(function($query) use ($keyword) {
                $query->where('judul', 'like', "%{$keyword}%")
                      ->orWhere('nama_pelapor', 'like', "%{$keyword}%")
                      ->orWhere('email_pelapor', 'like', "%{$keyword}%")
                      ->orWhere('lokasi', 'like', "%{$keyword}%")
                      ->orWhere('deskripsi', 'like', "%{$keyword}%");
            })
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('petugas.laporan.index', compact('laporan'));
    }

    /**
     * Bulk update status for multiple laporan.
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'laporan_ids' => 'required|array',
            'laporan_ids.*' => 'exists:laporan,id',
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
        ]);

        $updated = Laporan::whereIn('id', $request->laporan_ids)
            ->update([
                'status' => $request->status,
                'updated_at' => now()
            ]);

        return redirect()->route('petugas.laporan.index')
            ->with('success', "{$updated} laporan berhasil diperbarui statusnya ke \"" . ucfirst($request->status) . "\".");
    }

    /**
     * Export laporan to CSV or Excel.
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'csv');
        
        // This would need additional packages like maatwebsite/excel
        // For now, just return basic CSV
        
        $laporan = Laporan::with('kategori')->get();
        
        $filename = 'laporan_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($laporan) {
            $file = fopen('php://output', 'w');
            
            // Header CSV
            fputcsv($file, [
                'ID', 'Nama Pelapor', 'Email', 'Kategori', 'Judul', 
                'Lokasi', 'Status', 'Dikirim ke Admin', 'Tanggal Dibuat'
            ]);

            // Data
            foreach ($laporan as $item) {
                fputcsv($file, [
                    $item->id,
                    $item->nama_pelapor,
                    $item->email_pelapor,
                    $item->kategori->nama_kategori ?? '-',
                    $item->judul,
                    $item->lokasi,
                    $item->status,
                    $item->dikirim_ke_admin ? 'Ya' : 'Tidak',
                    $item->created_at->format('d/m/Y H:i:s')
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Optional: Private method to notify admin when laporan is sent.
     */
    private function notifyAdmin($laporan)
    {
        // Implementation depends on your notification system
        // Could be email, database notification, etc.
        
        // Example:
        // Mail::to('admin@example.com')->send(new LaporanSentToAdmin($laporan));
        // Or create database notification
        // Notification::create([...]);
    }
}