@extends('layouts.dashboard')

@section('title', 'Tambah Perjanjian')

@section('content')
    <div class="h-full flex flex-col">

        <div class="mb-3">
            <h2 class="font-bold text-blue-900">📋 Tambah Perjanjian Baru</h2>
        </div>

        <div class="win-border bg-white p-4 overflow-auto">
            <form action="{{ route('agreements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label class="block font-bold mb-1">Judul Perjanjian <span class="text-red-600">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('title') border-red-500 @enderror"
                            required>
                        @error('title')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block font-bold mb-1">Nomor Perjanjian <span class="text-red-600">*</span></label>
                        <input type="text" name="agreement_number" value="{{ old('agreement_number') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('agreement_number') border-red-500 @enderror"
                            required>
                        @error('agreement_number')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label class="block font-bold mb-1">Jenis Perjanjian <span class="text-red-600">*</span></label>
                        <select name="type"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('type') border-red-500 @enderror"
                            required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="non_profit" {{ old('type') == 'non_profit' ? 'selected' : '' }}>
                                Perjanjian Non-Profit / Kemitraan
                            </option>
                            <option value="freelancer" {{ old('type') == 'freelancer' ? 'selected' : '' }}>
                                Perjanjian Freelancer
                            </option>
                            <option value="pkwt" {{ old('type') == 'pkwt' ? 'selected' : '' }}>
                                Perjanjian Kontrak Karyawan (PKWT)
                            </option>
                        </select>
                        @error('type')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block font-bold mb-1">Status <span class="text-red-600">*</span></label>
                        <select name="status"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('status') border-red-500 @enderror"
                            required>
                            <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>
                                Berakhir
                            </option>
                            <option value="extended" {{ old('status') == 'extended' ? 'selected' : '' }}>
                                Diperpanjang
                            </option>
                        </select>
                        @error('status')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label class="block font-bold mb-1">Nama Pihak <span class="text-red-600">*</span></label>
                        <input type="text" name="party_name" value="{{ old('party_name') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('party_name') border-red-500 @enderror"
                            required>
                        @error('party_name')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block font-bold mb-1">Kontak Pihak</label>
                        <input type="text" name="party_contact" value="{{ old('party_contact') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('party_contact') border-red-500 @enderror">
                        @error('party_contact')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label class="block font-bold mb-1">Tanggal Mulai <span class="text-red-600">*</span></label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('start_date') border-red-500 @enderror"
                            required>
                        @error('start_date')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block font-bold mb-1">Tanggal Berakhir</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('end_date') border-red-500 @enderror">
                        @error('end_date')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                        <small class="text-gray-600">Kosongkan jika tidak ada batas waktu</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="block font-bold mb-1">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="block font-bold mb-1">File Perjanjian <span class="text-red-600">*</span></label>
                    <input type="file" name="file"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('file') border-red-500 @enderror"
                        accept=".pdf,.doc,.docx"
                        required>
                    @error('file')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                    <small class="text-gray-600">Format: PDF, DOC, DOCX (Max: 10MB). Ini akan menjadi versi 1.</small>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-700 text-white px-4 py-2 win-border">
                        💾 Simpan
                    </button>
                    <a href="{{ route('agreements.index') }}" class="bg-gray-400 text-white px-4 py-2 win-border">
                        ❌ Batal
                    </a>
                </div>
            </form>
        </div>

    </div>
@endsection
