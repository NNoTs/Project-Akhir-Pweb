@extends('header')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 mt-10 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Ganti Password</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul class="text-sm">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $updatePasswordRoute = Auth::guard('admin')->check()
            ? route('admin.update-password')
            : route('petugas.update-password');
        $cancelRoute = Auth::guard('admin')->check()
            ? route('admin.change-password')
            : route('petugas.change-password');
    @endphp

    <form id="passwordForm" method="POST" action="{{ $updatePasswordRoute }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Password Saat Ini</label>
            <input type="password" name="current_password" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Password Baru</label>
            <input type="password" name="new_password" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button type="button" onclick="confirmChange()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Ganti Password
        </button>
    </form>
</div>

<!-- Konfirmasi Popup -->
<script>
function confirmChange() {
    if (confirm('Apakah Anda yakin ingin mengubah password?')) {
        document.getElementById('passwordForm').submit();
    } else {
        window.location.href = "{{ $cancelRoute }}";
    }
}
</script>
@endsection
