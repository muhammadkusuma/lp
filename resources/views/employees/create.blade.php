@extends('layouts.dashboard')

@section('title', 'Tambah Karyawan Baru')

@section('content')
<div class="mb-4">
    <h2 class="text-2xl font-bold text-blue-900">➕ Tambah Karyawan Baru</h2>
</div>

{{-- Info Box --}}
<div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
    <p class="font-bold mb-1">ℹ️ Input Data Karyawan</p>
    <p>Isi formulir di bawah ini untuk menambahkan data karyawan baru. Pastikan semua data yang bertanda (*) wajib diisi dengan benar.</p>
</div>

<form action="{{ route('employees.store') }}" method="POST" class="space-y-4">
    @csrf
    
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1">Tipe Karyawan <span class="text-red-600">*</span></label>
            <select name="employee_type" class="w-full border px-3 py-2" required>
                <option value="">-- Pilih Tipe --</option>
                <option value="owner" {{ old('employee_type') == 'owner' ? 'selected' : '' }}>Pemilik / Direktur</option>
                <option value="freelancer" {{ old('employee_type') == 'freelancer' ? 'selected' : '' }}>Freelancer</option>
                <option value="contract" {{ old('employee_type') == 'contract' ? 'selected' : '' }}>Karyawan Kontrak (PKWT)</option>
            </select>
            @error('employee_type')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Nama Lengkap <span class="text-red-600">*</span></label>
            <input type="text" name="full_name" value="{{ old('full_name') }}" 
                   class="w-full border px-3 py-2" required>
            @error('full_name')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1">NIK / No. Identitas</label>
            <input type="text" name="id_number" value="{{ old('id_number') }}" 
                   class="w-full border px-3 py-2">
            @error('id_number')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Posisi / Jabatan <span class="text-red-600">*</span></label>
            <input type="text" name="position" value="{{ old('position') }}" 
                   class="w-full border px-3 py-2" required>
            @error('position')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" 
                   class="w-full border px-3 py-2">
            @error('email')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Telepon</label>
            <input type="text" name="phone" value="{{ old('phone') }}" 
                   class="w-full border px-3 py-2">
            @error('phone')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div>
        <label class="block font-semibold mb-1">Alamat</label>
        <textarea name="address" rows="3" class="w-full border px-3 py-2">{{ old('address') }}</textarea>
        @error('address')
            <small class="text-red-600">{{ $message }}</small>
        @enderror
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block font-semibold mb-1">Tanggal Bergabung <span class="text-red-600">*</span></label>
            <input type="date" name="join_date" value="{{ old('join_date') }}" 
                   class="w-full border px-3 py-2" required>
            @error('join_date')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Tanggal Mulai Kontrak</label>
            <input type="date" name="contract_start" value="{{ old('contract_start') }}" 
                   class="w-full border px-3 py-2">
            <small class="text-gray-500">Kosongkan jika permanen</small>
            @error('contract_start')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Tanggal Akhir Kontrak</label>
            <input type="date" name="contract_end" value="{{ old('contract_end') }}" 
                   class="w-full border px-3 py-2">
            <small class="text-gray-500">Kosongkan jika permanen</small>
            @error('contract_end')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_permanent" value="1" {{ old('is_permanent') ? 'checked' : '' }}>
                <span class="font-semibold">Karyawan Permanen?</span>
            </label>
            <small class="text-gray-500">Centang jika karyawan permanen (tidak ada kontrak berakhir)</small>
        </div>

        <div>
            <label class="block font-semibold mb-1">Gaji (Rp)</label>
            <input type="number" name="salary" value="{{ old('salary') }}" 
                   class="w-full border px-3 py-2" step="0.01" min="0">
            @error('salary')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Reminder (hari sebelum kontrak berakhir)</label>
            <input type="number" name="reminder_days" value="{{ old('reminder_days', 30) }}" 
                   class="w-full border px-3 py-2" min="1" max="365">
            <small class="text-gray-500">Default: 30 hari</small>
            @error('reminder_days')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div>
        <label class="block font-semibold mb-1">Catatan</label>
        <textarea name="notes" rows="3" class="w-full border px-3 py-2">{{ old('notes') }}</textarea>
        @error('notes')
            <small class="text-red-600">{{ $message }}</small>
        @enderror
    </div>

    <div class="flex gap-2">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 hover:bg-green-700 font-semibold">
            💾 Simpan Data
        </button>
        <a href="{{ route('employees.index') }}" class="bg-gray-500 text-white px-6 py-2 hover:bg-gray-600">
            ← Kembali
        </a>
    </div>
</form>
@endsection
