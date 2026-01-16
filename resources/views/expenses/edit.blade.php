@extends('layouts.dashboard')

@section('title', 'Edit Pengeluaran')

@section('content')
    <div class="h-full flex flex-col">

        {{-- Info Box --}}
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-900 px-4 py-3 mb-4 text-sm">
            <h4 class="font-bold mb-1">⚠️ Mode Edit</h4>
            <p>Anda sedang mengedit data pengeluaran. Pastikan perubahan yang dilakukan sudah benar.</p>
        </div>

        <form action="{{ route('expenses.update', $expense->id) }}" method="POST" class="bg-white p-6 win-border max-w-2xl">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Judul Pengeluaran <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $expense->title) }}" 
                    class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border" required>
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border bg-white" required>
                        @foreach(['operational' => 'Operasional Kantor', 'salary' => 'Gaji & Tunjangan', 'infrastructure' => 'Infrastruktur Server / Domain', 'marketing' => 'Marketing & Iklan', 'other' => 'Lainnya'] as $key => $label)
                            <option value="{{ $key }}" {{ $expense->category == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Transaksi <span class="text-red-500">*</span></label>
                    <input type="date" name="expense_date" value="{{ old('expense_date', $expense->expense_date->format('Y-m-d')) }}" 
                        class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="amount" value="{{ old('amount', $expense->amount) }}" 
                    class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border font-mono" required>
                @error('amount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Keterangan Tambahan</label>
                <textarea name="description" rows="3" 
                    class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border">{{ old('description', $expense->description) }}</textarea>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('expenses.index') }}" class="bg-gray-500 text-white px-4 py-2 win-border text-sm hover:bg-gray-600">
                    Batal
                </a>
                <button type="submit" class="bg-blue-700 text-white px-4 py-2 win-border text-sm hover:bg-blue-800">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
@endsection
