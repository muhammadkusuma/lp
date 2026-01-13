@extends('layouts.dashboard')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="h-full flex flex-col">

        <h2 class="font-bold text-blue-900 mb-3">➕ Tambah Kategori</h2>

        <form method="POST" action="{{ route('categories.store') }}" class="max-w-lg text-sm">
            @csrf

            <div class="mb-4">
                <label class="font-bold block mb-1">Nama Kategori</label>
                <input type="text" name="name" class="w-full border px-2 py-1 win-border" required autofocus>
                @error('name')
                    <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <button class="bg-blue-700 text-white px-4 py-1 win-border">
                    💾 Simpan
                </button>
                <a href="{{ route('categories.index') }}" class="ml-2 px-4 py-1 win-border bg-gray-200">
                    ↩️ Batal
                </a>
            </div>
        </form>

    </div>
@endsection
