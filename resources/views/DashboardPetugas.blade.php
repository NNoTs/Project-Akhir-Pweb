<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan Pelapor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .status-badge {
            transition: all 0.2s ease;
        }
        .status-badge:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .report-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .action-btn {
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#FFF2DA] to-[#FFF9F0] min-h-screen p-4 md:p-6 text-gray-800">

    <!-- Header/Navbar -->
    <header class="bg-white shadow-lg rounded-xl mb-6 p-4 sticky top-4 z-10">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-[#96AAD8] p-2 rounded-lg shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-[#96AAD8]">SAPA</h1>
                    <p class="text-xs text-gray-500">Sistem Aspirasi dan Pengaduan Masyarakat</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative cursor-pointer">
                    <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="h-8 w-8 rounded-full bg-[#96AAD8] flex items-center justify-center text-white font-medium shadow-md">P</div>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 hover:text-[#96AAD8] transition flex items-center">
                            <p class="ml-1 mr-2">Logout</p>
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto">
        <!-- Page Header with Stats -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-2xl md:text-3xl font-bold text-[#96AAD8] flex items-center">
                        <i class="fas fa-clipboard-list mr-3"></i> Daftar Laporan Masyarakat
                    </h2>
                    <p class="text-gray-500 mt-1">Kelola laporan dan aspirasi dari masyarakat</p>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        <?php if(session('success')): ?>
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm flex items-center animate-fade-in">
                <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                <p><?= session('success') ?></p>
            </div>
        <?php endif; ?>

        <!-- Reports Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Table Filters -->
            <div class="p-4 border-b flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0">
                <form method="GET" action="{{ route('laporan.lihat') }}" class="relative w-full md:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#96AAD8] focus:border-transparent" 
                        placeholder="Cari laporan...">
                </form>
                
                <div class="flex space-x-2">
                    <form method="GET" action="{{ route('laporan.lihat') }}" class="flex space-x-2">
                        <div class="relative">
                            <select 
                                name="status" 
                                onchange="this.form.submit()"
                                class="appearance-none px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition pr-8">
                                <option value="semua" {{ request('status') == 'semua' || !request('status') ? 'selected' : '' }}>Semua Status</option>
                                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        
                        @if(request('search') || request('status') != 'semua')
                            <a href="{{ route('laporan.lihat') }}" class="px-3 py-2 text-sm text-gray-600 hover:text-[#96AAD8] transition flex items-center">
                                <i class="fas fa-times mr-1"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[#96AAD8]">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Pelapor</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Kategori</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Detail Laporan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <?php foreach ($laporan as $index => $item): ?>
                        <tr class="hover:bg-gray-50 transition report-card">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700"><?= $index + 1 ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-[#96AAD8] flex items-center justify-center text-white font-medium shadow-md">
                                        <?= substr($item->nama_pelapor, 0, 1) ?>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($item->nama_pelapor) ?></div>
                                        <div class="text-sm text-gray-500"><?= htmlspecialchars($item->email_pelapor) ?></div>
                                        <div class="text-xs text-gray-400 mt-1">
                                            <i class="far fa-clock mr-1"></i> <?= date('d/m/Y H:i', strtotime($item->created_at)) ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full bg-[#B9DEE7] text-[#2C5282] font-medium shadow-sm">
                                    <i class="fas fa-tag mr-1"></i> <?= htmlspecialchars($item->kategori->nama_kategori ?? '-') ?>
                                </span>
                                <div class="mt-2 text-xs text-gray-500">
                                    <i class="fas fa-map-marker-alt mr-1"></i> <?= htmlspecialchars($item->lokasi) ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($item->judul) ?></div>
                                <div class="text-sm text-gray-500 mt-1"><?= htmlspecialchars(substr($item->deskripsi, 0, 100)) ?>...</div>
                                <a href="<?= route('petugas.laporan.show', $item->id) ?>" class="text-xs text-[#96AAD8] hover:underline mt-1 inline-block">
                                    Lihat detail <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div x-data="{ open: false }" class="relative">
                                    <?php
                                        $statusClass = match($item->status) {
                                            'menunggu' => 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200',
                                            'diproses' => 'bg-blue-100 text-blue-800 hover:bg-blue-200',
                                            'selesai'  => 'bg-green-100 text-green-800 hover:bg-green-200',
                                            'ditolak'  => 'bg-red-100 text-red-800 hover:bg-red-200',
                                            default    => 'bg-gray-100 text-gray-800 hover:bg-gray-200'
                                        };
                                    ?>
                                    <button @click="open = !open" class="px-3 py-1 text-xs font-medium rounded-full <?= $statusClass ?> flex items-center status-badge">
                                        <?php
                                            $statusIcon = match($item->status) {
                                                'menunggu' => 'fas fa-clock',
                                                'diproses' => 'fas fa-spinner',
                                                'selesai'  => 'fas fa-check-circle',
                                                'ditolak'  => 'fas fa-times-circle',
                                                default    => 'fas fa-question-circle'
                                            };
                                        ?>
                                        <i class="<?= $statusIcon ?> mr-2"></i>
                                        <?= ucfirst($item->status) ?>
                                        <i class="fas fa-chevron-down ml-2 text-xs"></i>
                                    </button>
                                    
                                    <div x-show="open" @click.away="open = false" 
                                         class="absolute z-10 mt-1 w-40 bg-white shadow-lg rounded-md py-1 border border-gray-200">
                                        <form action="<?= route('petugas.laporan.status', $item->id) ?>" method="POST" class="space-y-1">
                                            <?= csrf_field() ?>
                                            <?= method_field('PATCH') ?>
                                            <button type="submit" name="status" value="menunggu" 
                                                    class="block w-full text-left px-4 py-2 text-sm hover:bg-yellow-50 text-yellow-800 flex items-center">
                                                <i class="fas fa-clock mr-2"></i> Menunggu
                                            </button>
                                            <button type="submit" name="status" value="diproses" 
                                                    class="block w-full text-left px-4 py-2 text-sm hover:bg-blue-50 text-blue-800 flex items-center">
                                                <i class="fas fa-spinner mr-2"></i> Diproses
                                            </button>
                                            <button type="submit" name="status" value="selesai" 
                                                    class="block w-full text-left px-4 py-2 text-sm hover:bg-green-50 text-green-800 flex items-center">
                                                <i class="fas fa-check-circle mr-2"></i> Selesai
                                            </button>
                                            <button type="submit" name="status" value="ditolak" 
                                                    class="block w-full text-left px-4 py-2 text-sm hover:bg-red-50 text-red-800 flex items-center">
                                                <i class="fas fa-times-circle mr-2"></i> Ditolak
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <?php if ($item->dikirim_ke_admin): ?>
                                <div class="mt-2 text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded-full inline-flex items-center">
                                    <i class="fas fa-paper-plane mr-1"></i> Terkirim ke Admin
                                </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="<?= route('petugas.laporan.show', $item->id) ?>"
                                       class="text-[#96AAD8] hover:text-[#7b92c5] transition action-btn"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye text-lg"></i>
                                    </a>
                                    
                                    <?php if (!$item->dikirim_ke_admin): ?>
                                    <form action="<?= route('petugas.laporan.kirim', $item->id) ?>" method="POST" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit"
                                                class="text-green-600 hover:text-green-800 transition action-btn"
                                                title="Kirim ke Admin">
                                            <i class="fas fa-paper-plane text-lg"></i>
                                        </button>
                                    </form>
                                    <?php else: ?>
                                    <form action="<?= route('petugas.laporan.batal', $item->id) ?>" method="POST" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 transition action-btn"
                                                title="Batal Kirim ke Admin">
                                            <i class="fas fa-times-circle text-lg"></i>
                                        </button>
                                    </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <?php if($laporan->isEmpty()): ?>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center">
                                    <div class="inline-flex items-center px-4 py-3 bg-gray-50 rounded-lg border border-gray-200">
                                        <i class="fas fa-info-circle text-[#96AAD8] mr-3 text-xl"></i>
                                        <div class="text-left">
                                            <p class="font-medium">Tidak ada data ditemukan</p>
                                            <p class="text-sm text-gray-500">Silakan coba dengan kata kunci berbeda</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                    </table>
                </table>
            </div>
        </div>
    </div>

    <!-- Floating Action Button for Mobile -->
    <div class="md:hidden fixed bottom-6 right-6">
        <button class="h-14 w-14 bg-[#96AAD8] rounded-full shadow-lg text-white flex items-center justify-center hover:bg-[#7b92c5] transition">
            <i class="fas fa-plus text-xl"></i>
        </button>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</html>