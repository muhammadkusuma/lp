@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <h2 class="font-bold text-blue-900 mb-3">📊 Dashboard Overview</h2>

    {{-- KPI CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4 text-sm">
        <div class="bg-blue-100 win-border p-2">
            <strong>Total Clients</strong><br>
            <span class="text-lg">{{ $totalClients ?? 0 }}</span>
        </div>

        <div class="bg-blue-100 win-border p-2">
            <strong>Active Projects</strong><br>
            <span class="text-lg">{{ $activeProjects ?? 0 }}</span>
        </div>

        <div class="bg-green-100 win-border p-2">
            <strong>Paid Invoices</strong><br>
            <span class="text-lg">{{ $paidInvoices ?? 0 }}</span>
        </div>

        <div class="bg-red-100 win-border p-2">
            <strong>Overdue</strong><br>
            <span class="text-lg">{{ $overdueInvoices ?? 0 }}</span>
        </div>
    </div>

    {{-- INVOICE TABLE --}}
    <h3 class="font-bold text-blue-800 mb-2">🧾 Invoice Terbaru</h3>

    <div class="overflow-x-auto">
        <table class="w-full win-border bg-white">
            <thead>
                <tr class="text-left">
                    <th class="px-2 py-1">Invoice</th>
                    <th class="px-2 py-1">Client</th>
                    <th class="px-2 py-1">Total</th>
                    <th class="px-2 py-1">Status</th>
                    <th class="px-2 py-1">Due Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestInvoices as $inv)
                    <tr class="border-b border-gray-100">
                        <td class="px-2 py-1 font-mono text-xs">{{ $inv->invoice_number }}</td>
                        <td class="px-2 py-1">{{ $inv->client->company_name ?? '-' }}</td>
                        <td class="px-2 py-1">Rp {{ number_format($inv->total, 0, ',', '.') }}</td>
                        <td class="px-2 py-1 font-bold text-xs">
                            @if($inv->status == 'paid')
                                <span class="text-green-700">PAID</span>
                            @elseif($inv->status == 'overdue')
                                <span class="text-red-700">OVERDUE</span>
                            @elseif($inv->status == 'sent')
                                <span class="text-blue-700">SENT</span>
                            @else
                                <span class="text-gray-500">DRAFT</span>
                            @endif
                        </td>
                        <td class="px-2 py-1">{{ $inv->due_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500 italic">Belum ada data invoice terbaru.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection