@extends('Header')

@section('content')
    <title>Detail Laporan</title>
    <style>
        h1 {
            font-size: 2.2rem;
            margin-top: 2rem;
            font-weight: bold;
        }

        .detail-container {
            background-color: #BDDDE4;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            margin: 20px auto;
            width: 100%;
            max-width: 1100px;
            overflow-x: auto;
            position: relative; /* diperlukan untuk tombol pojok */
        }

        .detail-group {
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .detail-group strong {
            display: inline-block;
            width: 120px;
        }

        .status {
            font-weight: bold;
            background-color: #ffffcc;
            color: #8c7c00;
            padding: 4px 10px;
            border-radius: 10px;
        }

        .form-section {
            margin-top: 2rem;
        }

        select, textarea, button {
            font-size: 1rem;
            padding: 0.5rem;
            margin-top: 0.5rem;
            background-color: #fff1d7;

        }

        textarea {
            width: 100%;
            resize: none;
            height: 100px;
            border-radius: 8px;
            border: 1px solid #ccc;
            background-color: #fff1d7;

        }

        button {
            margin-top: 1rem;
            background-color: #0b3b74;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #092c58;
        }

        .btn-kembali {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #d9d9d9;
            color: #000;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-kembali:hover {
            background-color: #bbb;
        }

    </style>

    <div class="detail-container">
        <a href="{{ url('/DashboardAdmin') }}" class="btn-kembali">← Kembali</a>
        <h1>Detail Laporan</h1>
        <div class="detail-group"><strong>Pelapor:</strong> {{ $laporan->nama_pelapor }}</div>
        <div class="detail-group"><strong>Judul:</strong> {{ $laporan->judul }}</div>
        <div class="detail-group"><strong>Isi:</strong> {{ $laporan->isi }}</div>
        <div class="detail-group"><strong>Kategori:</strong> {{ $laporan->nama_kategori }}</div>
        <div class="detail-group"><strong>Lokasi:</strong> {{ $laporan->lokasi }}</div>
        <div class="detail-group">
            <strong>Tanggapan:</strong>
            @if ($laporan->isi_tanggapan)
                {{ $laporan->isi_tanggapan }}
            @else
                -
            @endif
        </div>
        <div class="detail-group"><strong>Status:</strong> 
            @php
                $status = $laporan->status_persetujuan;
            @endphp

            @if ($status === 'disetujui')
                <span class="status" style="background-color: #ccffcc; color: #007f00;">Disetujui</span>
            @elseif ($status === 'ditolak')
                <span class="status" style="background-color: #ffcccc; color: #a10000;">Ditolak</span>
            @else
                <span class="status menunggu">-</span> {{-- Belum diverifikasi --}}
            @endif
        </div>
    </div>

    <div class="detail-container">
        <h1>Form Verifikasi & Tanggapan</h1>
        <p>Silakan berikan tanggapan Anda terhadap laporan ini.</p>
        <form action="{{ url('/DashboardAdmin/tanggapan/' . $laporan->id) }}" method="POST">
            @csrf
            <div class="form-section">
                <h3>Verifikasi Laporan</h3>
                <select name="status" required>
                    <option value="disetujui">Disetujui</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>

            <div class="form-section">
                <h3>Beri Tanggapan</h3>
                <textarea name="isi_tanggapan" required></textarea>
            </div>

            <button type="submit">Kirim</button>
        </form>
    </div>
@endsection
