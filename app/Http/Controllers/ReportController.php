<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function finance()
    {
        // 1. Ringkasan Total
        // Total uang yang sudah masuk (dari Payment)
        $totalRevenue = Payment::sum('amount');

        // Total tagihan yang belum dibayar (Status sent atau overdue)
        $totalUnpaid = Invoice::whereIn('status', ['sent', 'overdue'])->sum('total');

        // Total nilai seluruh invoice (Omset kotor)
        $totalInvoiced = Invoice::sum('total');

        // 2. Laporan Pendapatan Bulanan (Menggunakan Collection agar support semua database)
        $monthlyIncome = Payment::get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->payment_date)->format('F Y'); // Kelompokkan per Bulan Tahun
            })
            ->map(function ($row) {
                return $row->sum('amount');
            });

        // 3. 5 Transaksi Pembayaran Terakhir
        $recentPayments = Payment::with('invoice.client')
            ->latest('payment_date')
            ->take(5)
            ->get();

        return view('reports.finance', compact(
            'totalRevenue',
            'totalUnpaid',
            'totalInvoiced',
            'monthlyIncome',
            'recentPayments'
        ));
    }
}
