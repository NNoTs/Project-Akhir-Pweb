<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/lihatlaporanStyle.css') }}">
</head>
<body>

    <!-- Header -->
    <div class="logo-header d-flex justify-content-between align-items-center px-4 py-2">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('img/sapa-logo.png') }}" alt="SAPA Logo">
            <div>
                <h1 class="h4 mb-0">SAPA</h1>
                <span>Sistem Aspirasi dan Pengaduan Masyarakat</span>
            </div>
        </div>
        <a href="{{ route('beranda') }}" class="btn btn-lihat">Beranda</a>
    </div>

    <!-- Tabel -->
    <div class="container laporan-box mt-5 form-container">
        <table class="table table-bordered laporan-table">
            <thead class="table-light">
                <tr>
                    <th>Perihal</th>
                    <th>Kategori</th>
                    <th>Pelapor</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporan as $item)
                    <tr>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td>{{ $item->nama_pelapor }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->isi ?: '-' }}</td>
                        <td>
                            <span class="status w-100 text-center status-{{ strtolower($item->status ?? 'menunggu') }}">
                                {{ ucfirst($item->status ?? 'Menunggu') }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
