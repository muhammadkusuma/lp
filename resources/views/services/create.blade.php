@extends('layouts.dashboard')

@section('title', 'Tambah Service')

@section('content')
    <div class="h-full flex flex-col">

        <h2 class="font-bold text-blue-900 mb-3">➕ Tambah Service</h2>

        <form method="POST" action="{{ route('services.store') }}" class="grid grid-cols-2 gap-4 text-sm">
            @csrf

            <div>
                <label class="font-bold">Nama Service</label>
                <input type="text" name="name" class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Slug</label>
                <input type="text" name="slug" class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Harga</label>
                <input type="number" name="price" class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Unit</label>
                <input type="text" name="unit" placeholder="project / jam / bulan"
                    class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Status</label>
                <select name="is_active" class="w-full border px-2 py-1 win-border">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <div class="col-span-2">
                <label class="font-bold">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full border px-2 py-1 win-border"></textarea>
            </div>

            <div class="col-span-2 mt-2">
                <button class="bg-blue-700 text-white px-4 py-1 win-border">
                    💾 Simpan
                </button>
                <a href="{{ route('services.index') }}" class="ml-2 px-4 py-1 win-border bg-gray-200">
                    ↩️ Batal
                </a>
            </div>
        </form>

    </div>
@endsection
