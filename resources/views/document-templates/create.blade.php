@extends('layouts.dashboard')

@section('title', 'Tambah Template Dokumen')

@section('content')
    <div class="h-full flex flex-col">

        <div class="mb-3">
            <h2 class="font-bold text-blue-900">📄 Tambah Template Dokumen</h2>
        </div>

        {{-- Info Box --}}
        <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
            <p class="font-bold mb-1">ℹ️ Upload Template</p>
            <p>Upload file master (DOCX/PDF) yang dapat didownload dan digunakan kembali oleh karyawan lain.</p>
        </div>

        <div class="win-border bg-white p-4">
            <form action="{{ route('document-templates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="block font-bold mb-1">Nama Template <span class="text-red-600">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('name') border-red-500 @enderror"
                        required>
                    @error('name')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="block font-bold mb-1">Jenis Template <span class="text-red-600">*</span></label>
                    <select name="type"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('type') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="surat_resmi" {{ old('type') == 'surat_resmi' ? 'selected' : '' }}>
                            Surat Resmi
                        </option>
                        <option value="perjanjian_kontrak" {{ old('type') == 'perjanjian_kontrak' ? 'selected' : '' }}>
                            Perjanjian & Kontrak
                        </option>
                        <option value="memo_internal" {{ old('type') == 'memo_internal' ? 'selected' : '' }}>
                            Memo Internal
                        </option>
                        <option value="dokumen_legal" {{ old('type') == 'dokumen_legal' ? 'selected' : '' }}>
                            Dokumen Legal
                        </option>
                    </select>
                    @error('type')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
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
                    <label class="block font-bold mb-1">File Template <span class="text-red-600">*</span></label>
                    <input type="file" name="file"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('file') border-red-500 @enderror"
                        accept=".pdf,.doc,.docx,.txt,.odt"
                        required>
                    @error('file')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                    <small class="text-gray-600">Format: PDF, DOC, DOCX, TXT, ODT (Max: 10MB)</small>
                </div>

                <div class="mb-3">
                    <label class="block font-bold mb-1">Status <span class="text-red-600">*</span></label>
                    <select name="status"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('status') border-red-500 @enderror"
                        required>
                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                    @error('status')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-700 text-white px-4 py-2 win-border">
                        💾 Simpan
                    </button>
                    <a href="{{ route('document-templates.index') }}" class="bg-gray-400 text-white px-4 py-2 win-border">
                        ❌ Batal
                    </a>
                </div>
            </form>
        </div>

    </div>
@endsection
