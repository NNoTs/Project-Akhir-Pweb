<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Laporan Pelapor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FFF2DA] text-gray-800 p-6 font-sans">

    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-[#96AAD8] mb-6">Daftar Laporan dari Pelapor</h2>

        <?php if(session('success')): ?>
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                <?= session('success') ?>
            </div>
        <?php endif; ?>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#96AAD8] text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium">#</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Nama Pelapor</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Kategori</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Judul</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Lokasi</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Waktu</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-[#B9DEE7]">
                    <?php foreach ($laporan as $index => $item): ?>
                        <tr>
                            <td class="px-4 py-3"><?= $index + 1 ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($item->nama_pelapor) ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($item->email_pelapor) ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($item->kategori->nama_kategori ?? '-') ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($item->judul) ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($item->lokasi) ?></td>
                            <td class="px-4 py-3">
                                <?php
                                    $statusClass = match($item->status) {
                                        'menunggu' => 'bg-yellow-300 text-yellow-800',
                                        'diproses' => 'bg-blue-300 text-blue-800',
                                        'selesai'  => 'bg-green-300 text-green-800',
                                        'ditolak'  => 'bg-red-300 text-red-800',
                                        default    => 'bg-gray-300 text-gray-800'
                                    };
                                ?>
                                <span class="px-2 py-1 rounded text-xs font-semibold <?= $statusClass ?>">
                                    <?= ucfirst($item->status) ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm"><?= date('d/m/Y H:i', strtotime($item->created_at)) ?></td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="<?= route('petugas.laporan.show', $item->id) ?>"
                                   class="inline-block bg-[#9AC9F5] hover:bg-blue-300 text-white text-sm px-3 py-1 rounded shadow">
                                    Detail
                                </a>

                                <?php if (!$item->dikirim_ke_admin): ?>
                                    <form action="<?= route('petugas.laporan.kirim', $item->id) ?>" method="POST" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit"
                                                class="bg-[#96AAD8] hover:bg-[#7b92c5] text-white text-sm px-3 py-1 rounded shadow">
                                            Kirim ke Admin
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-green-700 font-semibold text-sm">Terkirim</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
