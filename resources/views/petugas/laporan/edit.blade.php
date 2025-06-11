<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Status Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#FFF2DA] text-gray-800 p-6 font-sans min-h-screen">

    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-[#96AAD8]">Edit Status Laporan</h1>
            <a href="<?= route('petugas.laporan.index') ?>" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <!-- Success/Error Messages -->
        <?php if(session('success')): ?>
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded border border-green-200">
                <i class="fas fa-check-circle mr-2"></i><?= session('success') ?>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded border border-red-200">
                <i class="fas fa-exclamation-circle mr-2"></i><?= session('error') ?>
            </div>
        <?php endif; ?>

        <!-- Main Form -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header Card -->
            <div class="bg-[#96AAD8] text-white p-4">
                <h2 class="text-xl font-semibold flex items-center">
                    <i class="fas fa-edit mr-2"></i>Ubah Status Laporan
                </h2>
            </div>

            <div class="p-6">
                <!-- Laporan Summary -->
                <div class="bg-[#B9DEE7] p-4 rounded-lg mb-6">
                    <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Laporan
                    </h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <span class="text-sm text-gray-600">Judul:</span>
                            <p class="font-medium"><?= htmlspecialchars($laporan->judul) ?></p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Pelapor:</span>
                            <p class="font-medium"><?= htmlspecialchars($laporan->nama_pelapor) ?></p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Kategori:</span>
                            <p class="font-medium"><?= htmlspecialchars($laporan->kategori->nama_kategori ?? '-') ?></p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Status Saat Ini:</span>
                            <?php
                                $statusClass = match($laporan->status) {
                                    'menunggu' => 'bg-yellow-300 text-yellow-800',
                                    'diproses' => 'bg-blue-300 text-blue-800',
                                    'selesai'  => 'bg-green-300 text-green-800',
                                    'ditolak'  => 'bg-red-300 text-red-800',
                                    default    => 'bg-gray-300 text-gray-800'
                                };
                            ?>
                            <span class="inline-block px-2 py-1 rounded text-xs font-semibold <?= $statusClass ?>">
                                <?= ucfirst($laporan->status) ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Status Form -->
                <form action="<?= route('petugas.laporan.status', $laporan->id) ?>" method="POST" class="space-y-6">
                    <?= csrf_field() ?>
                    <?= method_field('PATCH') ?>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-flag mr-1"></i>Pilih Status Baru:
                        </label>
                        <select id="status" name="status" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#96AAD8] focus:border-transparent">
                            <option value="">-- Pilih Status --</option>
                            <option value="menunggu" <?= $laporan->status === 'menunggu' ? 'selected' : '' ?>>
                                Menunggu - Laporan belum ditindaklanjuti
                            </option>
                            <option value="diproses" <?= $laporan->status === 'diproses' ? 'selected' : '' ?>>
                                Diproses - Laporan sedang dalam penanganan
                            </option>
                            <option value="selesai" <?= $laporan->status === 'selesai' ? 'selected' : '' ?>>
                                Selesai - Laporan telah ditangani dengan tuntas
                            </option>
                            <option value="ditolak" <?= $laporan->status === 'ditolak' ? 'selected' : '' ?>>
                                Ditolak - Laporan tidak dapat diproses
                            </option>
                        </select>
                        
                        <!-- Validation Error -->
                        <?php if($errors->has('status')): ?>
                            <p class="text-red-500 text-sm mt-1">
                                <i class="fas fa-exclamation-triangle mr-1"></i><?= $errors->first('status') ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Optional: Catatan/Komentar -->
                    <div>
                        <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-comment mr-1"></i>Catatan (Opsional):
                        </label>
                        <textarea id="catatan" name="catatan" rows="4" 
                                  placeholder="Tambahkan catatan mengenai perubahan status ini..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#96AAD8] focus:border-transparent resize-none"></textarea>
                        <p class="text-gray-500 text-sm mt-1">
                            <i class="fas fa-info-circle mr-1"></i>Catatan ini akan membantu dalam tracking perubahan status laporan.
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-4 border-t">
                        <a href="<?= route('petugas.laporan.index') ?>" 
                           class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-[#96AAD8] text-white rounded-lg hover:bg-[#7b92c5] transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Status Information Card -->
        <div class="mt-6 bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-question-circle mr-2"></i>Penjelasan Status
            </h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex items-center mb-2">
                        <span class="w-3 h-3 bg-yellow-400 rounded-full mr-2"></span>
                        <span class="font-medium text-yellow-800">Menunggu</span>
                    </div>
                    <p class="text-sm text-yellow-700">Laporan baru masuk dan belum ditindaklanjuti.</p>
                </div>
                
                <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-center mb-2">
                        <span class="w-3 h-3 bg-blue-400 rounded-full mr-2"></span>
                        <span class="font-medium text-blue-800">Diproses</span>
                    </div>
                    <p class="text-sm text-blue-700">Laporan sedang dalam tahap penanganan/investigasi.</p>
                </div>
                
                <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center mb-2">
                        <span class="w-3 h-3 bg-green-400 rounded-full mr-2"></span>
                        <span class="font-medium text-green-800">Selesai</span>
                    </div>
                    <p class="text-sm text-green-700">Laporan telah selesai ditangani dan diselesaikan.</p>
                </div>
                
                <div class="p-3 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-center mb-2">
                        <span class="w-3 h-3 bg-red-400 rounded-full mr-2"></span>
                        <span class="font-medium text-red-800">Ditolak</span>
                    </div>
                    <p class="text-sm text-red-700">Laporan tidak dapat diproses atau tidak valid.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Konfirmasi sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const currentStatus = '<?= $laporan->status ?>';
            const newStatus = document.getElementById('status').value;
            
            if (currentStatus !== newStatus) {
                const confirmMessage = `Apakah Anda yakin ingin mengubah status dari "${currentStatus}" ke "${newStatus}"?`;
                if (!confirm(confirmMessage)) {
                    e.preventDefault();
                }
            }
        });

        // Auto-save draft ke localStorage (opsional)
        const statusSelect = document.getElementById('status');
        const catatanTextarea = document.getElementById('catatan');
        
        // Load saved data
        const savedStatus = localStorage.getItem('draft_status_<?= $laporan->id ?>');
        const savedCatatan = localStorage.getItem('draft_catatan_<?= $laporan->id ?>');
        
        if (savedStatus && savedStatus !== statusSelect.value) {
            statusSelect.value = savedStatus;
        }
        
        if (savedCatatan) {
            catatanTextarea.value = savedCatatan;
        }
        
        // Save on change
        statusSelect.addEventListener('change', function() {
            localStorage.setItem('draft_status_<?= $laporan->id ?>', this.value);
        });
        
        catatanTextarea.addEventListener('input', function() {
            localStorage.setItem('draft_catatan_<?= $laporan->id ?>', this.value);
        });
        
        // Clear draft on successful submit
        document.querySelector('form').addEventListener('submit', function() {
            localStorage.removeItem('draft_status_<?= $laporan->id ?>');
            localStorage.removeItem('draft_catatan_<?= $laporan->id ?>');
        });
    </script>

</body>
</html>