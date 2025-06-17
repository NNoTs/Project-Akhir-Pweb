@extends('HeaderPetugas')

@section('content')
<div class="min-h-screen bg-[#9EB3E0] flex flex-col items-center">
    <div class="w-full bg-[#7099F0] p-4 text-white">
        <h1 class="text-xl font-bold text-center">SAPA</h1>
        <p class="text-sm text-center">Profile {{ $guard }}</p>
    </div>

    <div class="min-h-screen bg-white items-center justify-center">
        <div class="bg-white rounded-[200px] w-[300px] py-10 px-6 text-center shadow-lg ">
            <!-- Icon Profil -->
            <div class="mx-auto items-center justify-center mb-6">
                <img src="{{ asset('img/icons.png') }}" alt="Icons" class="rounded-circle">
            </div>

            <!-- Nama dan Email -->
            <p class="text-sm font-semibold mb-1">Nama: {{ $user->name }}</p>
            <p class="text-sm font-semibold mb-8">Email: {{ auth()->user()->email }}</p>

            <!-- Link Ganti Password -->
            @php
                $changePasswordRoute = $guard === 'petugas' ? route('petugas.change-password') : route('admin.change-password');
            @endphp
            <a href="{{ $changePasswordRoute }}" class="text-blue-600 hover:underline">Ubah Password</a>
        </div>
    </div>
</div>
@endsection
