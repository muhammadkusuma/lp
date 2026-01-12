@extends('layouts.dashboard')

@section('title', 'Edit Service')

@section('content')
    <div class="h-full flex flex-col">

        <h2 class="font-bold text-blue-900 mb-3">✏️ Edit Service</h2>

        <form method="POST" action="{{ route('services.update', $service) }}" class="grid grid-cols-2 gap-4 text-sm">
            @csrf
            @method('PUT')

            <div>
                <label class="font-bold">Nama Service</label>
                <input type="text" name="name" value="{{ $service->name }}" class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Slug</label>
                <input type="text" name="slug" value="{{ $service->slug }}"
                    class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Harga</label>
                <input type="number" name="price" value="{{ $service->price }}"
                    class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Unit</label>
                <input type="text" name="unit" value="{{ $service->unit }}"
                    class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Status</label>
                <select name="is_active" class="w-full border px-2 py-1 win-border">
                    <option value="1" {{ $service->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$service->is_active ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="col-span-2">
                <label class="font-bold">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full border px-2 py-1 win-border">{{ $service->description }}</textarea>
            </div>

            <div class="col-span-2 mt-2">
                <button class="bg-blue-700 text-white px-4 py-1 win-border">
                    💾 Update
                </button>
                <a href="{{ route('services.index') }}" class="ml-2 px-4 py-1 win-border bg-gray-200">
                    ↩️ Batal
                </a>
            </div>
        </form>

    </div>
@endsection
