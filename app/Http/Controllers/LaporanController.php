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
    public function lihat()
    {
        $laporan = Laporan::with('kategori')->latest()->get();
        return view('lihatlaporan', compact('laporan'));
    }

    /**
     * Petugas melihat detail laporan.
     */
    public function show($id)
    {
        $laporan = Laporan::with('kategori')->findOrFail($id);
        return view('PetugasMelihatLaporan', compact('laporan'));
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