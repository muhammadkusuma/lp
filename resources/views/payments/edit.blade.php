@extends('layouts.dashboard')

@section('title', 'Edit Pembayaran')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-blue-900">Edit Pembayaran</h2>
            <a href="{{ route('payments.index') }}" class="text-gray-600 hover:underline text-sm">&laquo; Kembali</a>
        </div>

        {{-- Info Box --}}
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-900 px-4 py-3 mb-4 text-sm">
            <p class="font-bold mb-1">⚠️ Koreksi Pembayaran</p>
            <p>Hanya ubah data jika terjadi kesalahan pencatatan. Mengubah jumlah pembayaran akan mempengaruhi kalkulasi sisa tagihan pada Invoice.</p>
        </div>

        <form action="{{ route('payments.update', $payment->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 win-border space-y-4">
            @csrf
            @method('PUT')

            {{-- Pilihan Invoice --}}
            <div>
                <label class="block text-sm font-bold mb-1">Invoice Terkait</label>
                <select name="invoice_id" class="w-full border p-2 bg-gray-100">
                    @foreach ($invoices as $invoice)
                        <option value="{{ $invoice->id }}" {{ $payment->invoice_id == $invoice->id ? 'selected' : '' }}>
                            {{ $invoice->invoice_number }} - {{ $invoice->client->name ?? 'No Client' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold mb-1">Tanggal Pembayaran</label>
                    <input type="date" name="payment_date" value="{{ old('payment_date', $payment->payment_date) }}"
                        class="w-full border p-2">
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">Jumlah (Rp)</label>
                    <input type="number" step="0.01" name="amount" value="{{ old('amount', $payment->amount) }}"
                        class="w-full border p-2">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold mb-1">Metode Pembayaran</label>
                <select name="method" class="w-full border p-2">
                    @foreach (['Bank Transfer', 'Cash', 'Credit Card', 'E-Wallet', 'Cheque'] as $method)
                        <option value="{{ $method }}" {{ $payment->method == $method ? 'selected' : '' }}>
                            {{ $method }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold mb-1">Bukti Transfer (Upload Baru untuk Mengganti)</label>
                @if ($payment->proof_url)
                    <div class="mb-2 text-sm text-green-600">
                        Currently: <a href="{{ asset('storage/' . $payment->proof_url) }}" target="_blank"
                            class="underline">Lihat Bukti Saat Ini</a>
                    </div>
                @endif
                <input type="file" name="proof_file" class="w-full border p-2 text-sm">
            </div>

            <div class="pt-4 border-t mt-4 flex justify-end gap-2">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 win-border hover:bg-blue-700">Update
                    Pembayaran</button>
            </div>
        </form>
    </div>
@endsection
