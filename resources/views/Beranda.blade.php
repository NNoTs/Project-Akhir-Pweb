<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/laporanStyle.css') }}">
</head>

<body>

    <!-- Header -->
    <div class="logo-header">
            <img src="{{ asset('img/sapa-logo.png') }}" alt="SAPA Logo">
        <div>
            <h1>SAPA</h1>
            <span>Sistem Aspirasi dan Pengaduan Masyarakat</span>
        </div>
    </div>

    <div class="container mt-4">
        <!-- <div class="filter-btn">
            <button class="btn btn-outline-secondary">🔍 Filter kategori</button>
        </div> -->

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Notifikasi error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div class="form-container">
            <div class="form-title">+ Buat Laporan</div>

            <form action="{{ route('laporan.store') }}" method="POST">
                @csrf

                <label for="nama_pelapor" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" required>

                <label for="email_pelapor" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email_pelapor" name="email_pelapor" required>

                <label for="kategori_id" class="form-label">Kategori</label>
                <select class="form-select" id="kategori_id" name="kategori_id" required>
                    <option selected disabled>Pilih Kategori</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>

                <label for="judul" class="form-label">Perihal</label>
                <input type="text" class="form-control" id="judul" name="judul" required>

                <label for="isi" class="form-label">Keterangan</label>
                <textarea class="form-control" id="isi" name="isi" rows="4" required></textarea>

                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" required>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-kirim">Kirim Laporan</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
