@extends('layouts.dashboard')

@section('title', 'Tambah Pengeluaran')

@section('content')
    <div class="h-full flex flex-col">

        {{-- Info Box --}}
        <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
            <h4 class="font-bold mb-1">ℹ️ Tambah Pengeluaran Baru</h4>
            <p>Masukkan detail pengeluaran seperti Gaji, Pembayaran Server, Iklan, dll. Pastikan tanggal dan nominal sesuai.</p>
        </div>

        <form action="{{ route('expenses.store') }}" method="POST" class="bg-white p-6 win-border max-w-2xl">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Judul Pengeluaran <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" 
                    class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border" 
                    placeholder="Contoh: Pembayaran VPS DigitalOcean Bulan Ini" required>
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border bg-white" required>
                        <option value="operational">Operasional Kantor</option>
                        <option value="salary">Gaji & Tunjangan</option>
                        <option value="infrastructure">Infrastruktur Server / Domain</option>
                        <option value="marketing">Marketing & Iklan</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Transaksi <span class="text-red-500">*</span></label>
                    <input type="date" name="expense_date" value="{{ old('expense_date', date('Y-m-d')) }}" 
                        class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="amount" value="{{ old('amount') }}" 
                    class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border font-mono" 
                    placeholder="0" min="0" required>
                @error('amount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Keterangan Tambahan</label>
                <textarea name="description" rows="3" 
                    class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border"
                    placeholder="Catatan detail mengenai pengeluaran ini (opsional)"></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('expenses.index') }}" class="bg-gray-500 text-white px-4 py-2 win-border text-sm hover:bg-gray-600">
                    Batal
                </a>
                <button type="submit" class="bg-blue-700 text-white px-4 py-2 win-border text-sm hover:bg-blue-800">
                    💾 Simpan Pengeluaran
                </button>
            </div>
        </form>

    </div>
@endsection
