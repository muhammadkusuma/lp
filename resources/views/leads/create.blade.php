@extends('layouts.dashboard')

@section('title', 'Tambah Lead')

@section('content')
    <div class="max-w-md mx-auto mt-4">
        <div class="win-border bg-white p-4">
            <h2 class="font-bold text-blue-900 mb-4 border-b pb-2">➕ Tambah Lead Baru</h2>

            <form action="{{ route('leads.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="block text-sm font-bold mb-1">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full border p-1 win-border" required
                        value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold mb-1">Email</label>
                    <input type="email" name="email" class="w-full border p-1 win-border" required
                        value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold mb-1">Sumber (Source)</label>
                    <input type="text" name="source" class="w-full border p-1 win-border"
                        placeholder="Contoh: Google, LinkedIn" required value="{{ old('source') }}">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Status</label>
                    <select name="status" class="w-full border p-1 win-border bg-white" required>
                        <option value="New">New</option>
                        <option value="Contacted">Contacted</option>
                        <option value="Qualified">Qualified</option>
                        <option value="Lost">Lost</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('leads.index') }}"
                        class="bg-gray-500 text-white px-3 py-1 win-border text-sm">Kembali</a>
                    <button type="submit" class="bg-blue-700 text-white px-4 py-1 win-border font-bold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
