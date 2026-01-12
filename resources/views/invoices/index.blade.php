@extends('layouts.dashboard')

@section('title', 'Daftar Invoice')

@section('content')
    <div class="h-full flex flex-col">

        {{-- Header Section --}}
        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">🧾 Invoices</h2>
            <a href="{{ route('invoices.create') }}" class="bg-blue-600 text-white px-3 py-1 win-border hover:bg-blue-500">
                ➕ Buat Invoice Baru
            </a>
        </div>

        {{-- Table Container --}}
        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900 sticky top-0 z-10">
                    <tr>
                        <th class="border px-2 py-1 text-left w-32">No. Invoice</th>
                        <th class="border px-2 py-1 text-left">Client</th>
                        <th class="border px-2 py-1 text-left">Project</th>
                        <th class="border px-2 py-1 text-center w-28">Tanggal</th>
                        <th class="border px-2 py-1 text-right w-32">Total</th>
                        <th class="border px-2 py-1 text-center w-24">Status</th>
                        <th class="border px-2 py-1 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $inv)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1 font-mono font-bold text-blue-800">
                                {{ $inv->invoice_number }}
                            </td>
                            <td class="border px-2 py-1">
                                {{ $inv->client->company_name ?? '-' }}
                            </td>
                            <td class="border px-2 py-1">
                                {{ $inv->project->name ?? '-' }}
                            </td>
                            <td class="border px-2 py-1 text-center">
                                {{ $inv->issue_date }}
                            </td>
                            <td class="border px-2 py-1 text-right font-mono">
                                Rp {{ number_format($inv->total, 0, ',', '.') }}
                            </td>
                            <td class="border px-2 py-1 text-center">
                                @php
                                    $colors = [
                                        'draft' => 'bg-gray-200 text-gray-800',
                                        'sent' => 'bg-blue-200 text-blue-800',
                                        'paid' => 'bg-green-200 text-green-800',
                                        'overdue' => 'bg-red-200 text-red-800',
                                    ];
                                    $statusColor = $colors[$inv->status] ?? 'bg-gray-100';
                                @endphp
                                <span class="px-2 py-0.5 rounded text-xs border border-gray-400 {{ $statusColor }}">
                                    {{ ucfirst($inv->status) }}
                                </span>
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('invoices.show', $inv->id) }}"
                                    class="text-green-700 hover:text-green-900 mr-2" title="Lihat Detail">
                                    📄
                                </a>
                                <a href="{{ route('invoices.edit', $inv->id) }}"
                                    class="text-blue-700 hover:text-blue-900 mr-2" title="Edit">
                                    ✏️
                                </a>
                                <form action="{{ route('invoices.destroy', $inv->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus invoice {{ $inv->invoice_number }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-700 hover:text-red-900" title="Hapus">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border px-2 py-8 text-center text-gray-500 italic">
                                Belum ada data invoice. Silakan buat baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
