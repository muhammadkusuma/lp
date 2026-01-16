@extends('layouts.dashboard')

@section('title', 'Daftar Pembayaran')

@section('content')
    <div class="h-full flex flex-col">

        {{-- Info Box --}}
        <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
            <h4 class="font-bold mb-1">ℹ️ Riwayat Transaksi</h4>
            <p>Pantau semua pembayaran yang diterima dari klien. Pastikan semua transaksi tercatat dengan bukti pembayaran yang valid.</p>
        </div>

        <div class="flex items-center justify-between mb-4">
            <div class="flex gap-2">
                {{-- Search / Filter Placeholder --}}
            </div>

            <a href="{{ route('payments.create') }}"
                class="bg-green-700 text-white px-3 py-1 win-border hover:bg-green-600 text-sm">
                ➕ Catat Pembayaran
            </a>
        </div>

        {{-- Table Container --}}
        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900 sticky top-0 z-10">
                    <tr>
                        <th class="border px-2 py-1 text-center w-10">#</th>
                        <th class="border px-2 py-1 text-left">Tanggal</th>
                        <th class="border px-2 py-1 text-left">Invoice</th>
                        <th class="border px-2 py-1 text-left">Klien</th>
                        <th class="border px-2 py-1 text-center">Metode</th>
                        <th class="border px-2 py-1 text-right">Jumlah (IDR)</th>
                        <th class="border px-2 py-1 text-center">Bukti</th>
                        <th class="border px-2 py-1 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $i => $payment)
                        <tr class="hover:bg-blue-100">
                            {{-- Numbering (sesuaikan logic jika ada pagination) --}}
                            <td class="border px-2 py-1 text-center">
                                {{ ($payments->currentPage() - 1) * $payments->perPage() + $i + 1 }}
                            </td>

                            {{-- Tanggal --}}
                            <td class="border px-2 py-1 text-gray-700">
                                {{ date('d M Y', strtotime($payment->payment_date)) }}
                            </td>

                            {{-- Invoice Link --}}
                            <td class="border px-2 py-1 font-bold text-blue-800">
                                <a href="{{ route('invoices.show', $payment->invoice_id) }}" class="hover:underline">
                                    {{ $payment->invoice->invoice_number }}
                                </a>
                            </td>

                            {{-- Klien --}}
                            <td class="border px-2 py-1">
                                {{ $payment->invoice->client->name ?? '-' }}
                            </td>

                            {{-- Metode --}}
                            <td class="border px-2 py-1 text-center">
                                <span class="px-2 py-0.5 rounded text-xs border border-gray-400 bg-gray-100 text-gray-800">
                                    {{ $payment->method }}
                                </span>
                            </td>

                            {{-- Jumlah --}}
                            <td class="border px-2 py-1 text-right font-mono">
                                {{ number_format($payment->amount, 0, ',', '.') }}
                            </td>

                            {{-- Bukti --}}
                            <td class="border px-2 py-1 text-center">
                                @if ($payment->proof_url)
                                    <a href="{{ asset('storage/' . $payment->proof_url) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800" title="Lihat Bukti">
                                        📄
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('payments.edit', $payment->id) }}"
                                    class="text-blue-700 hover:text-blue-900 mr-2" title="Edit">
                                    ✏️
                                </a>

                                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus pembayaran ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-700 hover:text-red-900" title="Hapus">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    {{-- Empty State --}}
                    @if ($payments->count() === 0)
                        <tr>
                            <td colspan="8" class="border px-2 py-8 text-center text-gray-500 italic">
                                Belum ada data pembayaran.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- Pagination (Optional: diletakkan di bawah container tabel) --}}
        @if ($payments->hasPages())
            <div class="mt-2 text-xs">
                {{ $payments->links() }}
            </div>
        @endif

    </div>
@endsection
