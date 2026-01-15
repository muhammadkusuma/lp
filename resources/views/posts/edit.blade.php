@extends('layouts.dashboard')

@section('title', 'Edit Artikel')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-blue-900 text-lg">📝 Edit Artikel</h2>
        <a href="{{ route('posts.index') }}" class="text-sm text-blue-700 underline">← Kembali</a>
    </div>

    <div class="bg-white p-6 win-border">
        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold mb-1">Judul Artikel <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                           class="w-full border px-2 py-1 bg-white focus:outline-none focus:border-blue-500 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" required
                            class="w-full border px-2 py-1 bg-white focus:outline-none focus:border-blue-500">
                        <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">Tanggal Publish</label>
                    <input type="datetime-local" name="published_at" 
                           value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                           class="w-full border px-2 py-1 bg-white focus:outline-none focus:border-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan untuk menggunakan waktu sekarang</p>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold mb-1">Kategori</label>
                    <div class="border p-3 bg-gray-50 max-h-40 overflow-y-auto">
                        @forelse($categories as $category)
                            <label class="flex items-center mb-2">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                       {{ in_array($category->id, old('categories', $post->categories->pluck('id')->toArray())) ? 'checked' : '' }}
                                       class="mr-2">
                                <span>{{ $category->name }}</span>
                            </label>
                        @empty
                            <p class="text-gray-500 text-sm">Belum ada kategori. <a href="{{ route('categories.create') }}" class="text-blue-700 underline">Buat kategori baru</a></p>
                        @endforelse
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold mb-1">Konten Artikel <span class="text-red-500">*</span></label>
                    <textarea name="content" rows="15" required
                              class="w-full border px-2 py-1 bg-white focus:outline-none focus:border-blue-500 font-mono text-sm @error('content') border-red-500 @enderror">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex gap-2 pt-4 border-t">
                <button type="submit" class="bg-blue-700 text-white px-6 py-2 win-border hover:bg-blue-600">
                    💾 Update Artikel
                </button>
                <a href="{{ route('posts.index') }}" class="bg-gray-300 text-gray-800 px-6 py-2 win-border hover:bg-gray-400">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
