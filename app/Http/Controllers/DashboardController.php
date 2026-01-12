<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung KPI
        $totalClients = Client::count();

        // Project aktif bisa diasumsikan yang statusnya 'planning' atau 'running'
        $activeProjects = Project::whereIn('status', ['planning', 'running'])->count();

        // Invoice yang sudah dibayar
        $paidInvoices = Invoice::where('status', 'paid')->count();

        // Invoice yang jatuh tempo (overdue)
        $overdueInvoices = Invoice::where('status', 'overdue')->count();

        // Mengambil 5 invoice terbaru beserta data client-nya
        $latestInvoices = Invoice::with('client')
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalClients',
            'activeProjects',
            'paidInvoices',
            'overdueInvoices',
            'latestInvoices'
        ));
    }
}
