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
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    <!-- Tombol Detail -->
                                    <a href="<?= route('petugas.laporan.show', $item->id) ?>" 
                                       class="inline-block bg-[#9AC9F5] hover:bg-blue-400 text-white text-xs px-2 py-1 rounded shadow transition-colors duration-200">
                                        <i class="fas fa-eye mr-1"></i>Detail
                                    </a>

                                    <!-- Tombol Edit Status -->
                                    <button onclick="openStatusModal(<?= $item->id ?>, '<?= $item->status ?>')"
                                            class="inline-block bg-orange-400 hover:bg-orange-500 text-white text-xs px-2 py-1 rounded shadow transition-colors duration-200">
                                        <i class="fas fa-edit mr-1"></i>Edit Status
                                    </button>

                                    <!-- Tombol Kirim ke Admin -->
                                    <?php if (!$item->dikirim_ke_admin): ?>
                                        <form action="<?= route('petugas.laporan.kirim', $item->id) ?>" method="POST" class="inline" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin mengirim laporan ini ke admin?')">
                                            <?= csrf_field() ?>
                                            <button type="submit"
                                                    class="bg-[#96AAD8] hover:bg-[#7b92c5] text-white text-xs px-2 py-1 rounded shadow transition-colors duration-200">
                                                <i class="fas fa-paper-plane mr-1"></i>Kirim
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-green-700 font-semibold text-xs bg-green-100 px-2 py-1 rounded">
                                            <i class="fas fa-check mr-1"></i>Terkirim
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit Status -->
    <div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Status Laporan</h3>
                <form id="statusForm" method="POST">
                    <?= csrf_field() ?>
                    <?= method_field('PATCH') ?>
                    
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status:</label>
                        <select id="status" name="status" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#96AAD8]">
                            <option value="menunggu">Menunggu</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeStatusModal()" 
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-[#96AAD8] text-white rounded-md hover:bg-[#7b92c5] transition-colors duration-200">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script>
        function openStatusModal(id, currentStatus) {
            const modal = document.getElementById('statusModal');
            const form = document.getElementById('statusForm');
            const statusSelect = document.getElementById('status');
            
            // Set form action URL
            form.action = `/laporan/status/${id}`;
            
            // Set current status as selected
            statusSelect.value = currentStatus;
            
            // Show modal
            modal.classList.remove('hidden');
        }

        function closeStatusModal() {
            const modal = document.getElementById('statusModal');
            modal.classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('statusModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeStatusModal();
            }
        });
    </script>

</body>
</html>