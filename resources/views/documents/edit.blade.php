@extends('layouts.dashboard')

@section('title', 'Edit Dokumen')

@section('content')
    <div class="h-full flex flex-col">

        <div class="mb-3">
            <h2 class="font-bold text-blue-900">📄 Edit Dokumen</h2>
        </div>

        <div class="win-border bg-white p-4 overflow-auto">
            <form action="{{ route('documents.update', $document) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label class="block font-bold mb-1">Nomor Dokumen</label>
                        <input type="text" value="{{ $document->document_number }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 bg-gray-100 font-bold" readonly>
                        <small class="text-gray-600">Nomor dokumen tidak dapat diubah</small>
                    </div>

                    <div class="mb-3">
                        <label class="block font-bold mb-1">Arah Dokumen</label>
                        <input type="text" value="{{ $document->getDirectionLabel() }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 bg-gray-100" readonly>
                        <input type="hidden" name="direction" value="{{ $document->direction }}">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label class="block font-bold mb-1">Judul Dokumen <span class="text-red-600">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $document->title) }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('title') border-red-500 @enderror"
                            required>
                        @error('title')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block font-bold mb-1">Klasifikasi <span class="text-red-600">*</span></label>
                        <select name="classification"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('classification') border-red-500 @enderror"
                            required>
                            <option value="legal" {{ old('classification', $document->classification) == 'legal' ? 'selected' : '' }}>Legal</option>
                            <option value="keuangan" {{ old('classification', $document->classification) == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                            <option value="operasional" {{ old('classification', $document->classification) == 'operasional' ? 'selected' : '' }}>Operasional</option>
                            <option value="sdm" {{ old('classification', $document->classification) == 'sdm' ? 'selected' : '' }}>SDM</option>
                            <option value="umum" {{ old('classification', $document->classification) == 'umum' ? 'selected' : '' }}>Umum</option>
                        </select>
                        @error('classification')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    @if($document->direction === 'incoming')
                        <div class="mb-3">
                            <label class="block font-bold mb-1">Pengirim <span class="text-red-600">*</span></label>
                            <input type="text" name="sender" value="{{ old('sender', $document->sender) }}"
                                class="w-full border-2 border-gray-400 px-2 py-1 @error('sender') border-red-500 @enderror"
                                required>
                            @error('sender')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    @else
                        <div class="mb-3">
                            <label class="block font-bold mb-1">Penerima <span class="text-red-600">*</span></label>
                            <input type="text" name="recipient" value="{{ old('recipient', $document->recipient) }}"
                                class="w-full border-2 border-gray-400 px-2 py-1 @error('recipient') border-red-500 @enderror"
                                required>
                            @error('recipient')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="block font-bold mb-1">Status <span class="text-red-600">*</span></label>
                        <select name="status"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('status') border-red-500 @enderror"
                            required>
                            <option value="processed" {{ old('status', $document->status) == 'processed' ? 'selected' : '' }}>Diproses</option>
                            <option value="draft" {{ old('status', $document->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="archived" {{ old('status', $document->status) == 'archived' ? 'selected' : '' }}>Diarsipkan</option>
                        </select>
                        @error('status')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div class="mb-3">
                        <label class="block font-bold mb-1">Tanggal Dokumen <span class="text-red-600">*</span></label>
                        <input type="date" name="document_date" value="{{ old('document_date', $document->document_date->format('Y-m-d')) }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('document_date') border-red-500 @enderror"
                            required>
                        @error('document_date')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    @if($document->direction === 'incoming')
                        <div class="mb-3">
                            <label class="block font-bold mb-1">Tanggal Diterima</label>
                            <input type="date" name="received_date" value="{{ old('received_date', $document->received_date?->format('Y-m-d')) }}"
                                class="w-full border-2 border-gray-400 px-2 py-1">
                        </div>
                    @else
                        <div class="mb-3">
                            <label class="block font-bold mb-1">Tanggal Dikirim</label>
                            <input type="date" name="sent_date" value="{{ old('sent_date', $document->sent_date?->format('Y-m-d')) }}"
                                class="w-full border-2 border-gray-400 px-2 py-1">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="block font-bold mb-1">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="w-full border-2 border-gray-400 px-2 py-1">{{ old('description', $document->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="block font-bold mb-1">Kata Kunci</label>
                    <input type="text" name="keywords" value="{{ old('keywords', $document->keywords) }}"
                        class="w-full border-2 border-gray-400 px-2 py-1"
                        placeholder="Pisahkan dengan koma">
                </div>

                <div class="mb-3 p-3 bg-yellow-50 border-2 border-yellow-300">
                    <h3 class="font-bold mb-2">📄 File Dokumen</h3>
                    
                    @if($document->file_path)
                        <div class="mb-2 p-2 bg-blue-50 border border-blue-200">
                            <span class="text-sm">File saat ini: </span>
                            <a href="{{ asset('storage/' . $document->file_path) }}" 
                               target="_blank" 
                               class="text-blue-700 hover:underline font-bold">
                                📎 {{ basename($document->file_path) }}
                            </a>
                        </div>
                    @endif
                    
                    <label class="block font-bold mb-1">Upload File Baru (Opsional)</label>
                    <input type="file" name="file"
                        class="w-full border-2 border-gray-400 px-2 py-1"
                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    <small class="text-gray-600 block mt-1">Format: PDF, DOC, DOCX, JPG, PNG (Max: 10MB). Kosongkan jika tidak ingin mengganti file.</small>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-700 text-white px-4 py-2 win-border">
                        💾 Update
                    </button>
                    <a href="{{ route('documents.show', $document) }}" class="bg-gray-400 text-white px-4 py-2 win-border">
                        ❌ Batal
                    </a>
                </div>
            </form>
        </div>

    </div>
@endsection
