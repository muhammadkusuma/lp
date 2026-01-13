@extends('layouts.dashboard')

@section('title', 'Edit Kategori')

@section('content')
    <div class="h-full flex flex-col">

        <h2 class="font-bold text-blue-900 mb-3">✏️ Edit Kategori</h2>

        <form method="POST" action="{{ route('categories.update', $category) }}" class="max-w-lg text-sm">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="font-bold block mb-1">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                    class="w-full border px-2 py-1 win-border" required>
                @error('name')
                    <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <button class="bg-blue-700 text-white px-4 py-1 win-border">
                    💾 Update
                </button>
                <a href="{{ route('categories.index') }}" class="ml-2 px-4 py-1 win-border bg-gray-200">
                    ↩️ Batal
                </a>
            </div>
        </form>

    </div>
@endsection
