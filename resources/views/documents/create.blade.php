@extends('layouts.dashboard')

@section('title', 'Tambah Dokumen')

@section('content')
    <div class="h-full flex flex-col">

        <div class="mb-3">
            <h2 class="font-bold text-blue-900">📄 Tambah Dokumen Baru</h2>
        </div>

        <div class="win-border bg-white p-4 overflow-auto">
            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" id="documentForm">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label class="block font-bold mb-1">Arah Dokumen <span class="text-red-600">*</span></label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" name="direction" value="incoming" 
                                    {{ old('direction') == 'incoming' ? 'checked' : '' }}
                                    onchange="updateFormFields()" required>
                                <span class="ml-2">📥 Dokumen Masuk</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="direction" value="outgoing" 
                                    {{ old('direction') == 'outgoing' ? 'checked' : '' }}
                                    onchange="updateFormFields()">
                                <span class="ml-2">📤 Dokumen Keluar</span>
                            </label>
                        </div>
                        @error('direction')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block font-bold mb-1">Nomor Dokumen (Otomatis)</label>
                        <input type="text" id="documentNumberPreview" 
                            class="w-full border-2 border-gray-400 px-2 py-1 bg-gray-100" 
                            value="Pilih arah dokumen terlebih dahulu" readonly>
                        <small class="text-gray-600">Nomor akan digenerate otomatis</small>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label class="block font-bold mb-1">Judul Dokumen <span class="text-red-600">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}"
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
                            <option value="">-- Pilih Klasifikasi --</option>
                            <option value="legal" {{ old('classification') == 'legal' ? 'selected' : '' }}>Legal</option>
                            <option value="keuangan" {{ old('classification') == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                            <option value="operasional" {{ old('classification') == 'operasional' ? 'selected' : '' }}>Operasional</option>
                            <option value="sdm" {{ old('classification') == 'sdm' ? 'selected' : '' }}>SDM</option>
                            <option value="umum" {{ old('classification') == 'umum' ? 'selected' : '' }}>Umum</option>
                        </select>
                        @error('classification')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3" id="senderField" style="display:none;">
                        <label class="block font-bold mb-1">Pengirim <span class="text-red-600" id="senderRequired">*</span></label>
                        <input type="text" name="sender" value="{{ old('sender') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('sender') border-red-500 @enderror">
                        @error('sender')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3" id="recipientField" style="display:none;">
                        <label class="block font-bold mb-1">Penerima <span class="text-red-600" id="recipientRequired">*</span></label>
                        <input type="text" name="recipient" value="{{ old('recipient') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('recipient') border-red-500 @enderror">
                        @error('recipient')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div class="mb-3">
                        <label class="block font-bold mb-1">Tanggal Dokumen <span class="text-red-600">*</span></label>
                        <input type="date" name="document_date" value="{{ old('document_date', date('Y-m-d')) }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('document_date') border-red-500 @enderror"
                            required>
                        @error('document_date')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3" id="receivedDateField" style="display:none;">
                        <label class="block font-bold mb-1">Tanggal Diterima</label>
                        <input type="date" name="received_date" value="{{ old('received_date') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('received_date') border-red-500 @enderror">
                        @error('received_date')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3" id="sentDateField" style="display:none;">
                        <label class="block font-bold mb-1">Tanggal Dikirim</label>
                        <input type="date" name="sent_date" value="{{ old('sent_date') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('sent_date') border-red-500 @enderror">
                        @error('sent_date')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block font-bold mb-1">Status <span class="text-red-600">*</span></label>
                        <select name="status"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('status') border-red-500 @enderror"
                            required>
                            <option value="processed" {{ old('status', 'processed') == 'processed' ? 'selected' : '' }}>Diproses</option>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Diarsipkan</option>
                        </select>
                        @error('status')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
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
                    <label class="block font-bold mb-1">Kata Kunci (untuk pencarian)</label>
                    <input type="text" name="keywords" value="{{ old('keywords') }}"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('keywords') border-red-500 @enderror"
                        placeholder="Pisahkan dengan koma, contoh: kontrak, vendor, pembayaran">
                    @error('keywords')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                    <small class="text-gray-600">Kata kunci membantu pencarian dokumen lebih mudah</small>
                </div>

                <div class="mb-3">
                    <label class="block font-bold mb-1">File Dokumen <span class="text-red-600">*</span></label>
                    <input type="file" name="file"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('file') border-red-500 @enderror"
                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                        required>
                    @error('file')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                    <small class="text-gray-600">Format: PDF, DOC, DOCX, JPG, PNG (Max: 10MB)</small>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-700 text-white px-4 py-2 win-border">
                        💾 Simpan
                    </button>
                    <a href="{{ route('documents.index') }}" class="bg-gray-400 text-white px-4 py-2 win-border">
                        ❌ Batal
                    </a>
                </div>
            </form>
        </div>

    </div>

    <script>
        function updateFormFields() {
            const direction = document.querySelector('input[name="direction"]:checked');
            
            if (!direction) return;
            
            const isIncoming = direction.value === 'incoming';
            
            // Show/hide fields based on direction
            document.getElementById('senderField').style.display = isIncoming ? 'block' : 'none';
            document.getElementById('recipientField').style.display = isIncoming ? 'none' : 'block';
            document.getElementById('receivedDateField').style.display = isIncoming ? 'block' : 'none';
            document.getElementById('sentDateField').style.display = isIncoming ? 'none' : 'block';
            
            // Update document number preview
            const year = new Date().getFullYear();
            const month = String(new Date().getMonth() + 1).padStart(2, '0');
            const prefix = isIncoming ? 'IN' : 'OUT';
            document.getElementById('documentNumberPreview').value = `${prefix}/${year}/${month}/XXXX (akan digenerate)`;
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateFormFields();
        });
    </script>
@endsection
