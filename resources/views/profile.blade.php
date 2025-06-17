@extends('Header')

@section('content')
<div class="min-h-screen bg-[#9EB3E0] flex flex-col items-center">
    <div class="w-full bg-[#7099F0] p-4 text-white">
        <h1 class="text-xl font-bold">SAPA</h1>
        <p class="text-sm">Profile {{ $guard }}</p>
    </div>

    <div class="min-h-screen bg-[#ffffff] flex items-center justify-center">
        <div class="bg-[#ffffff] rounded-[40px] w-[300px] py-10 px-6 text-center shadow-lg">
            <!-- Icon Profil -->
            <div class="mx-auto bg-withe rounded-full h-24 w-24 flex items-center justify-center mb-6">
                <img src="{{ asset('img/icons.png') }}" alt="Icons">
            </div>

            <!-- Nama dan Email -->
            <p class="text-sm font-semibold mb-1">Nama: Admin</p>
            <p class="text-sm font-semibold mb-8">Email: Email@example.com</p>

            <!-- Link Ganti Password -->
            <a href="#" class="text-xs font-semibold hover:underline">change password</a>
        </div>
    </div>
</div>
@endsection

