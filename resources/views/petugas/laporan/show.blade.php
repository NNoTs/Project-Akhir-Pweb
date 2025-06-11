<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#FFF2DA] text-gray-800 p-6 font-sans min-h-screen">

    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-[#96AAD8]">Detail Laporan</h1>
            <a href="<?= route('petugas.laporan.index') ?>" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <!-- Success Message -->
        <?php if(session('success')): ?>
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded border border-green-200">
                <i class="fas fa-check-circle mr-2"></i><?= session('success') ?>
            </div>
        <?php endif; ?>

        <!-- Main Content -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Status Badge -->
            <div class="bg-[#96AAD8] text-white p-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold">Informasi Laporan</h2>
                    <div class="flex items-center space-x-3">
                        <?php
                            $statusClass = match($laporan->status) {
                                'menunggu' => 'bg-yellow-400 text-yellow-900',
                                'diproses' => 'bg-blue-400 text-blue-900',
                                'selesai'  => 'bg-green-400 text-green-900',
                                'ditolak'  => 'bg-red-400 text-red-900',
                                default    => 'bg-gray-400 text-gray-900'
                            };
                        ?>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold <?= $statusClass ?>">
                            <i class="fas fa-circle mr-1"></i><?= ucfirst($laporan->status) ?>
                        </span>
                        
                        <?php if($laporan->dikirim_ke_admin): ?>
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-paper-plane mr-1"></i>Terkirim ke Admin
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Laporan Details -->
                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div class="bg-[#B9DEE7] p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-user mr-2"></i>Data Pelapor
                            </h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-600">Nama:</span>
                                    <p class="font-medium"><?= htmlspecialchars($laporan->nama_pelapor) ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">Email:</span>
                                    <p class="font-medium"><?= htmlspecialchars($laporan->email_pelapor) ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">No. Telepon:</span>
                                    <p class="font-medium"><?= htmlspecialchars($laporan->no_telepon ?? '-') ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-[#B9DEE7] p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>Informasi Laporan
                            </h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-600">Kategori:</span>
                                    <p class="font-medium"><?= htmlspecialchars($laporan->kategori->nama_kategori ?? '-') ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">Lokasi:</span>
                                    <p class="font-medium"><?= htmlspecialchars($laporan->lokasi) ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">Tanggal Laporan:</span>
                                    <p class="font-medium"><?= date('d F Y, H:i', strtotime($laporan->created_at)) ?> WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div class="bg-[#B9DEE7] p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-heading mr-2"></i>Judul Laporan
                            </h3>
                            <p class="text-lg font-medium text-gray-800"><?= htmlspecialchars($laporan->judul) ?></p>
                        </div>

                        <div class="bg-[#B9DEE7] p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-align-left mr-2"></i>Deskripsi
                            </h3>
                            <div class="prose prose-sm max-w-none">
                                <p class="text-gray-700 leading-relaxed"><?= nl2br(htmlspecialchars($laporan->deskripsi)) ?></p>
                            </div>
                        </div>

                        <!-- Foto/Gambar jika ada -->
                        <?php if(!empty($laporan->foto)): ?>
                        <div class="bg-[#B9DEE7] p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-image mr-2"></i>Foto Pendukung
                            </h3>
                            <div class="grid grid-cols-2 gap-2">
                                <?php 
                                $photos = is_array($laporan->foto) ? $laporan->foto : json_decode($laporan->foto, true);
                                if($photos): 
                                    foreach($photos as $photo): 
                                ?>
                                <img src="<?= asset('storage/' . $photo) ?>" 
                                     alt="Foto Laporan" 
                                     class="w-full h-32 object-cover rounded cursor-pointer hover:opacity-80 transition-opacity"
                                     onclick="openImageModal('<?= asset('storage/' . $photo) ?>')">
                                <?php 
                                    endforeach;
                                endif; 
                                ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="border-t pt-6">
                    <div class="flex flex-wrap gap-3 justify-center">
                        <!-- Edit Status Button -->
                        <button onclick="openStatusModal(<?= $laporan->id ?>, '<?= $laporan->status ?>')"
                                class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                            <i class="fas fa-edit mr-2"></i>Edit Status
                        </button>

                        <!-- Send to Admin Button -->
                        <?php if(!$laporan->dikirim_ke_admin): ?>
                            <form action="<?= route('petugas.laporan.kirim', $laporan->id) ?>" method="POST" class="inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin mengirim laporan ini ke admin?')">
                                <?= csrf_field() ?>
                                <button type="submit"
                                        class="bg-[#96AAD8] hover:bg-[#7b92c5] text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-paper-plane mr-2"></i>Kirim ke Admin
                                </button>
                            </form>
                        <?php else: ?>
                            <div class="bg-green-500 text-white px-6 py-2 rounded-lg font-medium">
                                <i class="fas fa-check mr-2"></i>Sudah Dikirim ke Admin
                                <?php if($laporan->tanggal_dikirim_admin): ?>
                                    <small class="block text-green-100 mt-1">
                                        <?= date('d/m/Y H:i', strtotime($laporan->tanggal_dikirim_admin)) ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
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

    <!-- Modal Image Viewer -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-5 w-11/12 max-w-4xl">
            <div class="flex justify-end mb-4">
                <button onclick="closeImageModal()" 
                        class="text-white hover:text-gray-300 text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <img id="modalImage" src="" alt="Full Size Image" class="w-full h-auto rounded-lg">
        </div>
    </div>

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

        function openImageModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            
            modalImage.src = imageSrc;
            modal.classList.remove('hidden');
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
        }

        // Close modals when clicking outside
        document.getElementById('statusModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeStatusModal();
            }
        });

        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeStatusModal();
                closeImageModal();
            }
        });
    </script>

</body>
</html>