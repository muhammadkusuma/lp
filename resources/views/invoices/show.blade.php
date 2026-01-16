@extends('layouts.dashboard')

@section('title', 'Detail Invoice')

@section('content')
    <div class="max-w-5xl mx-auto">
        {{-- Header Navigation (Tidak ikut dicetak) --}}
        <div class="flex items-center justify-between mb-4 no-print">
            <h2 class="font-bold text-blue-900 text-lg">📄 Detail Invoice</h2>
            <a href="{{ route('invoices.index') }}" class="text-sm text-blue-700 underline">← Kembali</a>
        </div>

        {{-- Action Toolbar (Tidak ikut dicetak) --}}
        <div class="flex justify-end gap-2 mb-4 no-print">
            <button onclick="window.print()" class="bg-gray-600 text-white px-3 py-1 win-border hover:bg-gray-500 text-sm">
                🖨️ Cetak / PDF
            </button>
            <a href="{{ route('invoices.edit', $invoice->id) }}"
                class="bg-blue-700 text-white px-3 py-1 win-border hover:bg-blue-600 text-sm">
                ✏️ Edit Invoice
            </a>
        </div>

        {{-- Invoice Paper Container --}}
        {{-- ID "invoice-print" sangat penting untuk CSS di bawah --}}
        <div class="bg-white p-8 win-border mb-6 relative" id="invoice-print">
            
            {{-- Watermark Status --}}
            <div class="absolute top-0 right-0 mt-4 mr-4 no-print opacity-50">
                 @php
                    $colors = [
                        'draft' => 'text-gray-400 border-gray-400',
                        'sent' => 'text-blue-400 border-blue-400',
                        'paid' => 'text-green-400 border-green-400',
                        'overdue' => 'text-red-400 border-red-400',
                    ];
                    $statusClass = $colors[$invoice->status] ?? 'text-gray-400 border-gray-400';
                @endphp
                <span class="border-4 {{ $statusClass }} px-4 py-1 text-2xl font-bold uppercase rotate-12 inline-block">
                    {{ $invoice->status }}
                </span>
            </div>

            {{-- Header Invoice --}}
            <div class="flex justify-between items-start mb-8 border-b-2 border-blue-900 pb-4">
                <div>
                    <h1 class="text-3xl font-bold text-blue-900">INVOICE</h1>
                    <p class="text-gray-500 font-mono text-lg">#{{ $invoice->invoice_number }}</p>
                </div>
                <div class="text-right">
                    <h3 class="font-bold text-xl text-gray-800">{{ $appSettings['site_name'] ?? 'PT Maju Bersama Teknologi' }}</h3>
                    <p class="text-sm text-gray-600">{{ $appSettings['address'] ?? 'Alamat tidak tersedia' }}</p>
                    <p class="text-sm text-gray-600">{{ $appSettings['contact_phone'] ?? '' }}</p>
                </div>
            </div>

            {{-- Info Client & Invoice --}}
            <div class="flex flex-col md:flex-row justify-between mb-8 gap-6">
                <div class="flex-1">
                    <span class="text-xs font-bold text-gray-500 uppercase block mb-1">Tagihan Kepada:</span>
                    <h4 class="font-bold text-lg text-blue-900">{{ $invoice->client->company_name }}</h4>
                    <p class="text-sm text-gray-700">{{ $invoice->client->address ?? 'Alamat tidak tersedia' }}</p>
                    <p class="text-sm text-gray-700 mt-1"><span class="font-semibold">Attn:</span> {{ $invoice->client->contact_name }}</p>
                </div>
                
                <div class="flex-1 md:text-right">
                    <table class="w-full md:w-auto ml-auto text-sm">
                        <tr>
                            <td class="text-gray-600 pr-4 py-1">Tanggal Invoice:</td>
                            <td class="font-bold">{{ date('d M Y', strtotime($invoice->issue_date)) }}</td>
                        </tr>
                        <tr>
                            <td class="text-gray-600 pr-4 py-1">Jatuh Tempo:</td>
                            <td class="font-bold text-red-600">{{ date('d M Y', strtotime($invoice->due_date)) }}</td>
                        </tr>
                        <tr>
                            <td class="text-gray-600 pr-4 py-1">Project:</td>
                            <td class="font-bold text-blue-800">{{ $invoice->project->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Table Items --}}
            <div class="mb-8">
                <table class="w-full border-collapse text-sm border border-gray-300">
                    <thead class="bg-blue-200 text-blue-900">
                        <tr>
                            <th class="border border-gray-300 p-2 text-left">Deskripsi</th>
                            <th class="border border-gray-300 p-2 text-center w-20">Qty</th>
                            <th class="border border-gray-300 p-2 text-right w-40">Harga (Rp)</th>
                            <th class="border border-gray-300 p-2 text-right w-40">Total (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->items as $item)
                            <tr class="border-b border-gray-200">
                                <td class="border-r border-gray-300 p-2">{{ $item->description }}</td>
                                <td class="border-r border-gray-300 p-2 text-center">{{ $item->qty }}</td>
                                <td class="border-r border-gray-300 p-2 text-right font-mono">
                                    {{ number_format($item->price, 0, ',', '.') }}
                                </td>
                                <td class="p-2 text-right font-mono font-semibold">
                                    {{ number_format($item->total, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="border border-gray-300 p-2 text-right font-bold text-gray-600">Subtotal</td>
                            <td class="border border-gray-300 p-2 text-right font-mono font-bold">
                                {{ number_format($invoice->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="border border-gray-300 p-2 text-right font-bold text-gray-600">
                                Pajak {{ $invoice->tax_rate > 0 ? '(' . ($invoice->tax_rate == floor($invoice->tax_rate) ? number_format($invoice->tax_rate, 0) : $invoice->tax_rate) . '%)' : '' }}
                            </td>
                            <td class="border border-gray-300 p-2 text-right font-mono text-red-600">
                                {{ number_format($invoice->tax, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr class="bg-yellow-50">
                            <td colspan="3" class="border border-gray-300 p-3 text-right font-bold text-blue-900 text-lg">TOTAL TAGIHAN</td>
                            <td class="border border-gray-300 p-3 text-right font-mono font-bold text-lg text-blue-900">
                                Rp {{ number_format($invoice->total, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-t pt-6">
                <div class="text-sm text-gray-600">
                    <p class="font-bold text-gray-800 mb-1">🏦 Info Pembayaran:</p>
                    <p>Bank BCA: <span class="font-mono font-bold">123-456-7890</span></p>
                    <p>A.n: {{ $appSettings['site_name'] ?? 'PT Maju Bersama Teknologi' }}</p>
                    <p class="mt-2 italic">* Mohon sertakan nomor invoice <strong>{{ $invoice->invoice_number }}</strong> pada berita transfer.</p>
                </div>
                <div class="text-center md:text-right flex flex-col items-end justify-end">
                    <div class="mb-10 text-sm font-bold text-gray-800">Hormat Kami,</div>
                    <div class="border-b border-gray-400 w-40 mb-1"></div>
                    <div class="text-sm text-gray-600 w-40 text-center">Admin Finance</div>
                </div>
            </div>
        </div>
    </div>

    {{-- CSS KHUSUS PRINT - FIX HEADER TERCETAK --}}
    <style>
        @media print {
            /* 1. Sembunyikan SEMUA elemen di halaman */
            body * {
                visibility: hidden;
            }

            /* 2. Tampilkan HANYA elemen #invoice-print dan anak-anaknya */
            #invoice-print, #invoice-print * {
                visibility: visible;
            }

            /* 3. Posisikan elemen invoice ke pojok kiri atas kertas */
            #invoice-print {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                box-shadow: none !important;
            }

            /* 4. Sembunyikan elemen no-print secara eksplisit (tombol, watermark, dll) */
            .no-print {
                display: none !important;
            }

            /* 5. Paksa browser merender warna background (untuk header tabel) */
            body { 
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important; 
            }
        }
    </style>
@endsection