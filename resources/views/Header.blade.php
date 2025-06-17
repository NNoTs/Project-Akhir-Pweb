<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAPA - Admin</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional: FontAwesome or icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #9EC6F3;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .card {
            border-radius: 12px;
        }
        .custom-navbar {
            background-color: #9FB3DF;
        }

        .nav-link {
            color: black;
            text-right;
        }

    </style>

</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar mb-4">
        <div class="container">
            <!-- Logo dan Judul -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('img/sapa-logo.png') }}" alt="logo-sapa" width="32" height="32" class="me-2">
                <span class="text-white fw-bold">SAPA Admin</span>
            </a>

            <!-- Toggle Button untuk Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Link Keluar di kanan -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item3">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-lihat">Beranda</a>
                    </li>
                    <li class="nav-item2">
                        <a class="nav-link" href="{{ route('admin.profile') }}">
                            <img src="{{ asset('img/icons.png') }}" alt="profile" width="32" height="32" class="rounded-circle">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Keluar
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Main Content -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
