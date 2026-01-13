@extends('layouts.dashboard')

@section('title', 'Tambah Testimonial')

@section('content')
    <div class="h-full flex flex-col">

        <h2 class="font-bold text-blue-900 mb-3">➕ Tambah Testimonial</h2>

        <form method="POST" action="{{ route('testimonials.store') }}" class="max-w-lg text-sm">
            @csrf

            <div class="mb-4">
                <label class="font-bold block mb-1">Nama Klien</label>
                <input type="text" name="client_name" class="w-full border px-2 py-1 win-border" required autofocus>
                @error('client_name')
                    <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="font-bold block mb-1">Rating (1-5)</label>
                <input type="number" name="rating" min="1" max="5" value="5"
                    class="w-20 border px-2 py-1 win-border" required>
                @error('rating')
                    <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="font-bold block mb-1">Isi Testimonial</label>
                <textarea name="content" rows="4" class="w-full border px-2 py-1 win-border" required></textarea>
                @error('content')
                    <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <button class="bg-blue-700 text-white px-4 py-1 win-border">
                    💾 Simpan
                </button>
                <a href="{{ route('testimonials.index') }}" class="ml-2 px-4 py-1 win-border bg-gray-200">
                    ↩️ Batal
                </a>
            </div>
        </form>

    </div>
@endsection
