<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Aspirasi Masyarakat Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .bg-layer1 {
            background-color: #99ADD6;
        }
        .bg-layer2 {
            background-color: #9BC9F7;
        }
        .bg-layer3 {
            background-color: #BCE0E8;
        }
        .bg-layer4 {
            background-color: #FFF4DF;
        }
        .text-layer1 {
            color: #99ADD6;
        }
        .text-layer2 {
            color: #9BC9F7;
        }
        .text-layer3 {
            color: #BCE0E8;
        }
        .text-layer4 {
            color: #FFF4DF;
        }
        .border-layer1 {
            border-color: #99ADD6;
        }
        .border-layer2 {
            border-color: #9BC9F7;
        }
        .border-layer3 {
            border-color: #BCE0E8;
        }
        .border-layer4 {
            border-color: #FFF4DF;
        }
    </style>
</head>
<body class="bg-layer4">
    <!-- Navbar -->
    <nav class="bg-layer1 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <span class="font-bold text-xl ">Sistem Aspirasi Desa</span>
            </div>
            <div class="hidden md:flex space-x-4">
                <a href="#fitur" class="hover:opacity-80">Fitur</a>
                <a href="#tentang" class="hover:opacity-80">Tentang</a>
                <a href="#kontak" class="hover:opacity-80">Kontak</a>
            </div>
            <div class="flex space-x-2">
                <a href="/login" class="px-4 py-2 bg-white text-layer1 rounded-md font-medium hover:bg-gray-100">Masuk</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-16 bg-gradient-to-r from-layer1 to-layer2 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-gray-800">Sistem Aspirasi Masyarakat Desa</h1>
            <p class="text-xl max-w-2xl mx-auto mb-8 text-gray-700">
                Media penyaluran aspirasi dan laporan masyarakat kepada pemerintah desa secara cepat dan transparan.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/aspirasi" class="px-6 py-3 bg-layer4 text-layer1 font-bold rounded-md hover:bg-opacity-90 transition duration-300">
                    Ajukan Aspirasi Sekarang
                </a>
                <a href="#fitur" class="px-6 py-3 bg-transparent border-2 border-gray-800 text-gray-600 font-bold rounded-md hover:bg-white hover:text-layer1 transition duration-300">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-16 bg-layer4">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Alur Kerja Sistem</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Pelapor Card -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-layer3 transform hover:scale-105 transition duration-300">
                    <div class="bg-layer1 p-4 text-white">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <h3 class="text-xl font-bold">Pelapor</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Membuat laporan aspirasi</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Melihat status laporan</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Menerima tanggapan dari Admin</span>
                            </li>
                        </ul>
                        <div class="mt-6">
                            <a href="/login/pelapor" class="block text-center px-4 py-2 bg-layer1 text-white rounded-md hover:bg-opacity-90 transition duration-300">
                                Masuk sebagai Pelapor
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Petugas Card -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-layer3 transform hover:scale-105 transition duration-300">
                    <div class="bg-layer2 p-4 text-white">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <h3 class="text-xl font-bold">Petugas</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Melihat laporan yang masuk</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Mengubah status laporan</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Mengirim laporan ke Admin</span>
                            </li>
                        </ul>
                        <div class="mt-6">
                            <a href="/login/petugas" class="block text-center px-4 py-2 bg-layer2 text-white rounded-md hover:bg-opacity-90 transition duration-300">
                                Masuk sebagai Petugas
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Admin Card -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-layer3 transform hover:scale-105 transition duration-300">
                    <div class="bg-layer3 p-4 text-gray-800">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-xl font-bold">Admin</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Menerima laporan dari Petugas</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Memberikan tanggapan</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Memverifikasi laporan (ACC/ditolak)</span>
                            </li>
                        </ul>
                        <div class="mt-6">
                            <a href="/login/admin" class="block text-center px-4 py-2 bg-layer3 text-gray-800 rounded-md hover:bg-opacity-90 transition duration-300">
                                Masuk sebagai Admin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-layer1 text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold mb-2">1,245</div>
                    <div class="text-xl">Aspirasi Terkirim</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">932</div>
                    <div class="text-xl">Aspirasi Diverifikasi</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">98%</div>
                    <div class="text-xl">Kepuasan Masyarakat</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-layer4">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Sampaikan Aspirasi Anda Sekarang</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto text-gray-600">
                Suara Anda penting untuk kemajuan desa kami. Mari bersama-sama membangun desa yang lebih baik.
            </p>
            <a href="/aspirasi" class="inline-block px-8 py-3 bg-layer1 text-white font-bold rounded-md hover:bg-opacity-90 transition duration-300">
                Ajukan Aspirasi
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-layer1 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Sistem Aspirasi Desa</h3>
                    <p>Media penyaluran aspirasi masyarakat kepada pemerintah desa secara cepat dan transparan.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:opacity-80">Beranda</a></li>
                        <li><a href="#fitur" class="hover:opacity-80">Fitur</a></li>
                        <li><a href="#tentang" class="hover:opacity-80">Tentang</a></li>
                        <li><a href="#kontak" class="hover:opacity-80">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Login</h4>
                    <ul class="space-y-2">
                        <li><a href="/login/pelapor" class="hover:opacity-80">Pelapor</a></li>
                        <li><a href="/login/petugas" class="hover:opacity-80">Petugas</a></li>
                        <li><a href="/login/admin" class="hover:opacity-80">Admin</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Kontak Kami</h4>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            (021) 123-4567
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            info@aspirasidesa.id
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Kantor Desa, Jl. Raya Desa No.1
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-opacity-20 border-white mt-8 pt-6 text-center text-opacity-80">
                <p>&copy; 2023 Sistem Aspirasi Masyarakat Desa. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>