@extends('layouts.dashboard')

@section('title', 'Laporan Keuangan')

@section('content')

    {{-- Info Box --}}
    <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-6 text-sm">
        <div class="flex justify-between items-start">
            <div>
                <h4 class="font-bold mb-1">ℹ️ Laporan Keuangan</h4>
                <p>Ringkasan kinerja keuangan perusahaan Anda. Pantau total pendapatan, tagihan yang belum dibayar, dan nilai total invoice di sini.</p>
            </div>
            <div class="text-xs text-gray-500 text-right">
                Dicetak pada:<br>{{ now()->format('d M Y H:i') }}
            </div>
        </div>
    </div>

    {{-- SUMMARY CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-green-50 win-border p-3">
            <h3 class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Total Pendapatan (Cash In)</h3>
            <div class="text-2xl font-bold text-green-700">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </div>
            <p class="text-xs text-green-600 mt-1">Total pembayaran diterima</p>
        </div>

        <div class="bg-red-50 win-border p-3">
            <h3 class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Piutang (Belum Dibayar)</h3>
            <div class="text-2xl font-bold text-red-700">
                Rp {{ number_format($totalUnpaid, 0, ',', '.') }}
            </div>
            <p class="text-xs text-red-600 mt-1">Invoice status Sent & Overdue</p>
        </div>

        <div class="bg-blue-50 win-border p-3">
            <h3 class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Total Nilai Invoice</h3>
            <div class="text-2xl font-bold text-blue-700">
                Rp {{ number_format($totalInvoiced, 0, ',', '.') }}
            </div>
            <p class="text-xs text-blue-600 mt-1">Akumulasi seluruh invoice</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        {{-- TABEL PENDAPATAN BULANAN --}}
        <div>
            <h3 class="font-bold text-blue-800 mb-2">📅 Pendapatan Per Bulan</h3>
            <div class="bg-white win-border overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 border-b-2 border-gray-300">
                        <tr>
                            <th class="px-4 py-2 text-left">Bulan</th>
                            <th class="px-4 py-2 text-right">Jumlah (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($monthlyIncome as $month => $amount)
                            <tr class="border-b border-gray-100 hover:bg-blue-50">
                                <td class="px-4 py-2 font-medium">{{ $month }}</td>
                                <td class="px-4 py-2 text-right font-mono">
                                    {{ number_format($amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-4 py-3 text-center text-gray-500 italic">
                                    Belum ada data pembayaran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- TABEL PEMBAYARAN TERAKHIR --}}
        <div>
            <h3 class="font-bold text-blue-800 mb-2">💵 Pembayaran Terakhir Masuk</h3>
            <div class="bg-white win-border overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 border-b-2 border-gray-300">
                        <tr>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Client</th>
                            <th class="px-4 py-2 text-right">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPayments as $payment)
                            <tr class="border-b border-gray-100 hover:bg-green-50">
                                <td class="px-4 py-2 text-xs">
                                    {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-2 text-xs">
                                    {{ $payment->invoice->client->company_name ?? '-' }}
                                    <div class="text-[10px] text-gray-400">Inv:
                                        {{ $payment->invoice->invoice_number ?? 'N/A' }}</div>
                                </td>
                                <td class="px-4 py-2 text-right font-mono font-bold text-green-700">
                                    +{{ number_format($payment->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-center text-gray-500 italic">
                                    Belum ada history pembayaran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-2 text-right">
                <a href="{{ route('payments.index') }}" class="text-xs text-blue-600 hover:underline">
                    Lihat semua pembayaran &rarr;
                </a>
            </div>
        </div>

    </div>

@endsection
