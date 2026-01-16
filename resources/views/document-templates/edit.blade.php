@extends('layouts.dashboard')

@section('title', 'Edit Template Dokumen')

@section('content')
    <div class="h-full flex flex-col">

        <div class="mb-3">
            <h2 class="font-bold text-blue-900">📄 Edit Template Dokumen</h2>
        </div>

        {{-- Info Box --}}
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-900 px-4 py-3 mb-4 text-sm">
            <p class="font-bold mb-1">⚠️ Update Template</p>
            <p>Mengganti file template akan mempengaruhi file yang didownload oleh user di masa depan.</p>
        </div>

        <div class="win-border bg-white p-4">
            <form action="{{ route('document-templates.update', $documentTemplate) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="block font-bold mb-1">Nama Template <span class="text-red-600">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $documentTemplate->name) }}"
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
                        <option value="surat_resmi" {{ old('type', $documentTemplate->type) == 'surat_resmi' ? 'selected' : '' }}>
                            Surat Resmi
                        </option>
                        <option value="perjanjian_kontrak" {{ old('type', $documentTemplate->type) == 'perjanjian_kontrak' ? 'selected' : '' }}>
                            Perjanjian & Kontrak
                        </option>
                        <option value="memo_internal" {{ old('type', $documentTemplate->type) == 'memo_internal' ? 'selected' : '' }}>
                            Memo Internal
                        </option>
                        <option value="dokumen_legal" {{ old('type', $documentTemplate->type) == 'dokumen_legal' ? 'selected' : '' }}>
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
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('description') border-red-500 @enderror">{{ old('description', $documentTemplate->description) }}</textarea>
                    @error('description')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="block font-bold mb-1">File Template</label>
                    
                    @if($documentTemplate->file_path)
                        <div class="mb-2 p-2 bg-blue-50 border border-blue-200">
                            <span class="text-sm">File saat ini: </span>
                            <a href="{{ asset('storage/' . $documentTemplate->file_path) }}" 
                               target="_blank" 
                               class="text-blue-700 hover:underline font-bold">
                                📎 {{ basename($documentTemplate->file_path) }}
                            </a>
                        </div>
                    @endif
                    
                    <input type="file" name="file"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('file') border-red-500 @enderror"
                        accept=".pdf,.doc,.docx,.txt,.odt">
                    @error('file')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                    <small class="text-gray-600">Format: PDF, DOC, DOCX, TXT, ODT (Max: 10MB). Kosongkan jika tidak ingin mengganti file.</small>
                </div>

                <div class="mb-3">
                    <label class="block font-bold mb-1">Status <span class="text-red-600">*</span></label>
                    <select name="status"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('status') border-red-500 @enderror"
                        required>
                        <option value="active" {{ old('status', $documentTemplate->status) == 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="inactive" {{ old('status', $documentTemplate->status) == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                    @error('status')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-700 text-white px-4 py-2 win-border">
                        💾 Update
                    </button>
                    <a href="{{ route('document-templates.index') }}" class="bg-gray-400 text-white px-4 py-2 win-border">
                        ❌ Batal
                    </a>
                </div>
            </form>
        </div>

    </div>
@endsection
