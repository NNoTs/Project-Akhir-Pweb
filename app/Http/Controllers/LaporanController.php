<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\KategoriLaporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman utama berisi kategori laporan (untuk pelapor).
     */
    public function index()
    {
        $kategori = KategoriLaporan::all();
        return view('beranda', compact('kategori'));
    }

    /**
     * Pelapor mengirim laporan.
     */
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

    /**
     * Petugas melihat semua laporan.
     */
    public function lihat(Request $request)
    {
        $query = Laporan::with('kategori')->latest();
        
        // Filter by status
        if ($request->has('status') && $request->status != 'semua') {
            $query->where('status', $request->status);
        }
        
        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%'.$search.'%')
                ->orWhere('isi', 'like', '%'.$search.'%')
                ->orWhere('nama_pelapor', 'like', '%'.$search.'%')
                ->orWhere('lokasi', 'like', '%'.$search.'%');
            });
        }
        
        // Use paginate() instead of get() to get a LengthAwarePaginator instance
        $laporan = $query->get();
        
        return view('DashboardPetugas', compact('laporan'));
    }

    /**
     * Petugas melihat detail laporan.
     */
    public function show($id)
    {
        $laporan = Laporan::with('kategori')->findOrFail($id);
        return view('petugas.laporan.show', compact('laporan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validStatuses = ['menunggu', 'diproses', 'selesai', 'ditolak'];
        
        $request->validate([
            'status' => ['required', 'in:' . implode(',', $validStatuses)]
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->status = $request->status;
        
        // Jika status diubah menjadi 'selesai', tandai sebagai selesai
        if ($request->status == 'selesai') {
            $laporan->updated_at = now();
        }
        
        $laporan->save();

        return back()->with('success', 'Status laporan berhasil diperbarui');
    }

    /**
     * Membatalkan pengiriman laporan ke admin
     */
    public function batalkanKirimKeAdmin($id)
    {
        $laporan = Laporan::findOrFail($id);

        if (!$laporan->dikirim_ke_admin) {
            return redirect()->route('petugas.laporan.index')
                ->with('warning', 'Laporan ini belum dikirim ke admin.');
        }

        $laporan->update([
            'dikirim_ke_admin' => false,
            'tanggal_dikirim_admin' => null,
            'status' => 'menunggu'
        ]);

        return redirect()->route('petugas.laporan.index')
            ->with('success', 'Pengiriman laporan ke admin berhasil dibatalkan.');
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