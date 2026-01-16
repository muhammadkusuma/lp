@extends('layouts.dashboard')

@section('title', 'Tambah Dokumen Legal')

@section('content')
    <div class="h-full flex flex-col">

        <div class="mb-3">
            <h2 class="font-bold text-blue-900">⚖️ Tambah Dokumen Legal</h2>
        </div>

        {{-- Info Box --}}
        <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
            <p class="font-bold mb-1">ℹ️ Input Legalitas</p>
            <p>Masukkan tanggal kadaluarsa dengan benar agar fitur Reminder dapat berfungsi.</p>
        </div>

        <div class="win-border bg-white p-4 overflow-auto">
            <form action="{{ route('legal-documents.store') }}" method="POST" enctype="multipart/form-data" id="legalDocForm">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label class="block font-bold mb-1">Jenis Dokumen <span class="text-red-600">*</span></label>
                        <select name="document_type"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('document_type') border-red-500 @enderror"
                            required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="akta_pendirian" {{ old('document_type') == 'akta_pendirian' ? 'selected' : '' }}>Akta Pendirian</option>
                            <option value="sk_kemenkumham" {{ old('document_type') == 'sk_kemenkumham' ? 'selected' : '' }}>SK Kemenkumham</option>
                            <option value="npwp" {{ old('document_type') == 'npwp' ? 'selected' : '' }}>NPWP</option>
                            <option value="nib" {{ old('document_type') == 'nib' ? 'selected' : '' }}>NIB</option>
                            <option value="siup" {{ old('document_type') == 'siup' ? 'selected' : '' }}>SIUP</option>
                            <option value="tdp" {{ old('document_type') == 'tdp' ? 'selected' : '' }}>TDP</option>
                            <option value="other" {{ old('document_type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('document_type')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block font-bold mb-1">Nomor Dokumen <span class="text-red-600">*</span></label>
                        <input type="text" name="document_number" value="{{ old('document_number') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('document_number') border-red-500 @enderror"
                            required>
                        @error('document_number')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="block font-bold mb-1">Nama Dokumen <span class="text-red-600">*</span></label>
                    <input type="text" name="document_name" value="{{ old('document_name') }}"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('document_name') border-red-500 @enderror"
                        required>
                    @error('document_name')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="block font-bold mb-1">Penerbit <span class="text-red-600">*</span></label>
                    <input type="text" name="issuer" value="{{ old('issuer') }}"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('issuer') border-red-500 @enderror"
                        placeholder="Contoh: Kementerian Hukum dan HAM"
                        required>
                    @error('issuer')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div class="mb-3">
                        <label class="block font-bold mb-1">Tanggal Terbit <span class="text-red-600">*</span></label>
                        <input type="date" name="issue_date" value="{{ old('issue_date') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 @error('issue_date') border-red-500 @enderror"
                            required>
                        @error('issue_date')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="flex items-center mb-2">
                            <input type="checkbox" name="is_permanent" value="1" 
                                {{ old('is_permanent') ? 'checked' : '' }}
                                onchange="toggleExpiryDate()" id="isPermanent">
                            <span class="ml-2 font-bold">Dokumen Permanen (Tanpa Masa Berlaku)</span>
                        </label>
                    </div>

                    <div class="mb-3" id="reminderDaysField">
                        <label class="block font-bold mb-1">Reminder (Hari Sebelum Kadaluarsa)</label>
                        <input type="number" name="reminder_days" value="{{ old('reminder_days', 30) }}"
                            class="w-full border-2 border-gray-400 px-2 py-1"
                            min="1" max="365">
                        <small class="text-gray-600">Default: 30 hari</small>
                    </div>
                </div>

                <div class="mb-3" id="expiryDateField">
                    <label class="block font-bold mb-1">Tanggal Kadaluarsa <span class="text-red-600" id="expiryRequired">*</span></label>
                    <input type="date" name="expiry_date" value="{{ old('expiry_date') }}"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('expiry_date') border-red-500 @enderror"
                        id="expiryDateInput">
                    @error('expiry_date')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                    <small class="text-gray-600">Kosongkan jika dokumen permanen</small>
                </div>

                <div class="mb-3">
                    <label class="block font-bold mb-1">Catatan</label>
                    <textarea name="notes" rows="3"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                    @error('notes')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="block font-bold mb-1">File Dokumen</label>
                    <input type="file" name="file"
                        class="w-full border-2 border-gray-400 px-2 py-1 @error('file') border-red-500 @enderror"
                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    @error('file')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                    <small class="text-gray-600">Format: PDF, DOC, DOCX, JPG, PNG (Max: 10MB)</small>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-700 text-white px-4 py-2 win-border">
                        💾 Simpan
                    </button>
                    <a href="{{ route('legal-documents.index') }}" class="bg-gray-400 text-white px-4 py-2 win-border">
                        ❌ Batal
                    </a>
                </div>
            </form>
        </div>

    </div>

    <script>
        function toggleExpiryDate() {
            const isPermanent = document.getElementById('isPermanent').checked;
            const expiryField = document.getElementById('expiryDateField');
            const expiryInput = document.getElementById('expiryDateInput');
            const expiryRequired = document.getElementById('expiryRequired');
            const reminderField = document.getElementById('reminderDaysField');
            
            if (isPermanent) {
                expiryField.style.display = 'none';
                reminderField.style.display = 'none';
                expiryInput.removeAttribute('required');
                expiryRequired.style.display = 'none';
                expiryInput.value = '';
            } else {
                expiryField.style.display = 'block';
                reminderField.style.display = 'block';
                expiryInput.setAttribute('required', 'required');
                expiryRequired.style.display = 'inline';
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleExpiryDate();
        });
    </script>
@endsection
