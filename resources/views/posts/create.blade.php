@extends('layouts.dashboard')

@section('title', 'Tambah Artikel')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-gray-100 p-2 border-b border-gray-300 mb-4 flex justify-between items-center win-border">
            <h2 class="font-bold text-lg">📝 Tulis Artikel Baru</h2>
            <a href="{{ route('posts.index') }}" class="text-sm text-blue-700 hover:underline">&laquo; Kembali</a>
        </div>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Kolom Kiri (Konten Utama) --}}
                <div class="md:col-span-2 space-y-4">
                    <div>
                        <label class="block font-bold text-sm mb-1">Judul Artikel</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full border-2 border-gray-400 p-2 text-sm focus:border-blue-600 outline-none shadow-inner"
                            placeholder="Masukkan judul menarik...">
                        @error('title')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-bold text-sm mb-1">Konten</label>
                        <textarea name="content" rows="15"
                            class="w-full border-2 border-gray-400 p-2 text-sm focus:border-blue-600 outline-none shadow-inner font-mono"
                            placeholder="Tulis isi artikel di sini...">{{ old('content') }}</textarea>
                        @error('content')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Kolom Kanan (Pengaturan) --}}
                <div class="space-y-4">
                    <div class="bg-blue-50 p-3 win-border">
                        <label class="block font-bold text-sm mb-2 text-blue-900">Status</label>
                        <select name="status" class="w-full border border-gray-400 p-1 text-sm bg-white">
                            <option value="draft">Draft (Simpan Konsep)</option>
                            <option value="published">Published (Terbitkan)</option>
                        </select>
                    </div>

                    <div class="bg-gray-50 p-3 win-border">
                        <label class="block font-bold text-sm mb-2">Kategori</label>
                        <div class="h-40 overflow-y-auto border border-gray-300 bg-white p-2 text-sm">
                            @forelse($categories as $category)
                                <div class="flex items-center gap-2 mb-1">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        id="cat_{{ $category->id }}">
                                    <label for="cat_{{ $category->id }}">{{ $category->name }}</label>
                                </div>
                            @empty
                                <p class="text-xs text-gray-500">Belum ada kategori.</p>
                            @endforelse
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 win-border shadow-lg">
                        💾 SIMPAN ARTIKEL
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
