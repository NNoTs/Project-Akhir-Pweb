<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login SAPA</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/loginStyle.css') }}">
</head>
<body>
    <div class="container">
        <div class="top-logo">
            <img src="{{ asset('img/sapa-logo.png') }}" alt="SAPA Logo">
            <h1>Welcome to SAPA</h1>
            <p class="subtitle">Sistem Aspirasi dan Pengaduan Masyarakat</p>
        </div>

        <div class="login-box">
            <div class="login-box-header">
                <h3>Login</h3>
            </div>
            <div class="form-body">
                @if ($errors->any())
                    <div class="error-message">
                        @foreach ($errors->all() as $error)
                            <p style="color: red;">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label>📧 E-mail</label>
                        <input type="text" name="email" required>
                    </div>
                    <div class="input-group">
                        <label>🔑 Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <button type="submit">➡️ Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
