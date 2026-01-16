@extends('layouts.dashboard')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-blue-900 text-lg">🏷️ Tambah Kategori Baru</h2>
        <a href="{{ route('categories.index') }}" class="text-sm text-blue-700 underline">← Kembali</a>
    </div>

    {{-- Info Box --}}
    <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
        <p class="font-bold mb-1">ℹ️ Buat Kategori</p>
        <p>Tambahkan nama kategori baru yang ringkas dan jelas. Contoh: "Berita", "Tutorial", "Pengumuman".</p>
    </div>

    <div class="bg-white p-6 win-border max-w-2xl">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Nama Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full border px-2 py-1 bg-white focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2 pt-4 border-t">
                <button type="submit" class="bg-blue-700 text-white px-6 py-2 win-border hover:bg-blue-600">
                    💾 Simpan Kategori
                </button>
                <a href="{{ route('categories.index') }}" class="bg-gray-300 text-gray-800 px-6 py-2 win-border hover:bg-gray-400">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
