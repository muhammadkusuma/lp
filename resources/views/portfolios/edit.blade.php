@extends('layouts.dashboard')

@section('title', 'Edit Portfolio')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-bold text-blue-900">✏️ Edit Portfolio</h2>
            <a href="{{ route('portfolios.index') }}" class="text-sm text-blue-700 hover:underline">
                &larr; Kembali
            </a>
        </div>

        <form action="{{ route('portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-4 win-border">
            @csrf
            @method('PUT')

            {{-- Project Selection --}}
            <div class="mb-3">
                <label class="block font-bold text-xs mb-1">Project Terkait <span class="text-red-500">*</span></label>
                <select name="project_id"
                    class="w-full border p-1 text-sm bg-gray-50 focus:outline-none focus:border-blue-500 win-border">
                    <option value="">-- Pilih Project --</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}"
                            {{ old('project_id', $portfolio->project_id) == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Title --}}
            <div class="mb-3">
                <label class="block font-bold text-xs mb-1">Judul Portfolio <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $portfolio->title) }}"
                    class="w-full border p-1 text-sm focus:outline-none focus:border-blue-500 win-border">
                @error('title')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Image Upload --}}
            <div class="mb-3">
                <label class="block font-bold text-xs mb-1">Ganti Gambar (Opsional)</label>
                @if ($portfolio->image_url)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $portfolio->image_url) }}" alt="Current Image"
                            class="h-20 w-auto border p-1">
                        <span class="text-xs text-gray-500">Gambar saat ini</span>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                    class="w-full border p-1 text-sm bg-gray-50 win-border">
                <span class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar.</span>
                @error('image')
                    <br><span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block font-bold text-xs mb-1">Deskripsi</label>
                <textarea name="description" rows="5"
                    class="w-full border p-1 text-sm focus:outline-none focus:border-blue-500 win-border">{{ old('description', $portfolio->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('portfolios.index') }}"
                    class="bg-gray-200 text-gray-800 px-3 py-1 win-border hover:bg-gray-300 text-sm">Batal</a>
                <button type="submit" class="bg-blue-700 text-white px-4 py-1 win-border hover:bg-blue-600 text-sm">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>
@endsection
