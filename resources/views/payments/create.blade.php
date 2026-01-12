@extends('layouts.dashboard')

@section('title', 'Catat Pembayaran Baru')

@section('content')
    <div class="h-full flex flex-col max-w-3xl mx-auto w-full">

        {{-- Header Section --}}
        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">💰 Catat Pembayaran Baru</h2>
            <a href="{{ route('payments.index') }}"
                class="bg-gray-200 text-gray-800 px-3 py-1 win-border hover:bg-gray-300 text-sm">
                🔙 Kembali
            </a>
        </div>

        {{-- Form Container --}}
        <div class="bg-white p-5 win-border">
            <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                {{-- Pilihan Invoice --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Pilih Invoice / Tagihan</label>
                    <select name="invoice_id"
                        class="w-full border border-gray-400 p-2 focus:outline-none focus:border-blue-600 bg-white">
                        <option value="">-- Pilih Invoice --</option>
                        @foreach ($invoices as $invoice)
                            <option value="{{ $invoice->id }}">
                                #{{ $invoice->invoice_number }} - {{ $invoice->client->name ?? 'No Client' }}
                                (Sisa: Rp {{ number_format($invoice->total, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                    @error('invoice_id')
                        <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Tanggal Bayar --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Tanggal Pembayaran</label>
                        <input type="date" name="payment_date" value="{{ date('Y-m-d') }}"
                            class="w-full border border-gray-400 p-2 focus:outline-none focus:border-blue-600">
                        @error('payment_date')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Jumlah Bayar --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Jumlah (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500 font-mono">Rp</span>
                            <input type="number" step="0.01" name="amount"
                                class="w-full border border-gray-400 p-2 pl-10 focus:outline-none focus:border-blue-600 font-mono"
                                placeholder="0">
                        </div>
                        @error('amount')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Metode Pembayaran --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Metode Pembayaran</label>
                    <select name="method"
                        class="w-full border border-gray-400 p-2 bg-white focus:outline-none focus:border-blue-600">
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Cash">Cash / Tunai</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="E-Wallet">E-Wallet (OVO/Gopay/Dana)</option>
                        <option value="Cheque">Cek / Giro</option>
                    </select>
                    @error('method')
                        <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Bukti Bayar --}}
                <div class="border border-dashed border-gray-400 p-4 bg-gray-50">
                    <label class="block text-sm font-bold text-gray-700 mb-1">Bukti Transfer (Opsional)</label>
                    <input type="file" name="proof_file"
                        class="w-full text-sm text-gray-600
                               file:mr-4 file:py-1 file:px-3
                               file:border file:border-gray-400
                               file:text-xs file:font-semibold
                               file:bg-gray-200 file:text-gray-700
                               hover:file:bg-gray-300">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF. Maks: 2MB.</p>
                    @error('proof_file')
                        <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-200">
                    <a href="{{ route('payments.index') }}"
                        class="bg-red-100 text-red-700 px-4 py-2 text-sm border border-red-300 hover:bg-red-200">
                        Batal
                    </a>
                    <button type="submit" class="bg-green-700 text-white px-6 py-2 win-border hover:bg-green-600 text-sm">
                        💾 Simpan Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
