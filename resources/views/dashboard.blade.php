@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <h2 class="font-bold text-blue-900 mb-3">📊 Dashboard Overview</h2>

    {{-- KPI CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4 text-sm">
        <div class="bg-blue-100 win-border p-2">
            <strong>Total Clients</strong><br>
            {{ $totalClients ?? 0 }}
        </div>

        <div class="bg-blue-100 win-border p-2">
            <strong>Active Projects</strong><br>
            {{ $activeProjects ?? 0 }}
        </div>

        <div class="bg-green-100 win-border p-2">
            <strong>Paid Invoices</strong><br>
            {{ $paidInvoices ?? 0 }}
        </div>

        <div class="bg-red-100 win-border p-2">
            <strong>Overdue</strong><br>
            {{ $overdueInvoices ?? 0 }}
        </div>
    </div>

    {{-- INVOICE TABLE --}}
    <h3 class="font-bold text-blue-800 mb-2">🧾 Invoice Terbaru</h3>

    <table class="w-full win-border">
        <thead>
            <tr>
                <th class="px-2 py-1">Invoice</th>
                <th class="px-2 py-1">Client</th>
                <th class="px-2 py-1">Total</th>
                <th class="px-2 py-1">Status</th>
                <th class="px-2 py-1">Due Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($latestInvoices ?? [] as $inv)
                <tr>
                    <td class="px-2 py-1">{{ $inv->invoice_number }}</td>
                    <td class="px-2 py-1">{{ $inv->client->company_name }}</td>
                    <td class="px-2 py-1">Rp {{ number_format($inv->total) }}</td>
                    <td class="px-2 py-1 font-bold {{ $inv->status == 'paid' ? 'text-green-700' : 'text-red-700' }}">
                        {{ strtoupper($inv->status) }}
                    </td>
                    <td class="px-2 py-1">{{ $inv->due_date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-2">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
