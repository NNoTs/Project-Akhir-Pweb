@extends('Header')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .welcome-box {
            background-color: #9EC6F3;
            padding: 2rem;
            border-radius: 16px;
            text-align: center;
            color: #0b3b74;
        }

        .welcome-box h1 {
            font-size: 2rem;
        }

        .welcome-box p {
            font-size: 1.1rem;
        }

        .tabel-container {
            background-color: #fff1d7;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            margin: 20px auto;
            width: 95%;
            max-width: 1100px;
            overflow-x: auto;
        }

        .tabel-laporan {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        .tabel-laporan thead {
            background-color: #a7b8e5;
            color: #333;
        }

        .tabel-laporan th,
        .tabel-laporan td {
            padding: 12px 16px;
            text-align: left;
            border: 1px solid #ccc;
        }

        .status {
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            display: inline-block;
        }

        .status.menunggu {
            background-color: #fff8cc;
            color: #a18f00;
        }

        .status.diproses {
            background-color: #e3fbe2;
            color: #256029;
        }

        .status.ditolak {
            background-color: #ffdada;
            color: #a30000;
        }

        .status.selesai {
            background-color: #c6f7d3;
            color: #146c43;
        }

        .btn-detail {
            color: #1a73e8;
            text-decoration: none;
        }

        .btn-detail:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <section class="welcome-box mb-5">
        <h1 class="fw-bold mb-2">Selamat datang, Admin!</h1>
        <p>Platform digital untuk mengelola dan memantau aspirasi serta pengaduan masyarakat dengan mudah, cepat, dan transparan.</p>
    </section>

    <div class="tabel-container">
        <h2 class="texttable">Daftar Laporan</h2>
        <table class="tabel-laporan">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Pelapor</th>
                    <th>Isi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporans as $laporan)
                    <tr>
                        <td>{{ $laporan->judul }}</td>
                        <td>{{ $laporan->kategori_id }}</td>
                        <td>{{ $laporan->nama_pelapor }}</td>
                        <td>{{ $laporan->isi }}</td>
                        <td>
                            <span class="status {{ strtolower($laporan->status) }}">
                                {{ ucfirst($laporan->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ url('/DashboardAdmin/' . $laporan->id) }}" class="btn-detail">Lihat Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
@endsection

