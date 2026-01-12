<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['client', 'project'])->latest()->get();
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $clients  = Client::orderBy('company_name')->get();
        $projects = Project::orderBy('name')->get();

        // Generate nomor invoice otomatis (Simple format: INV-YYYYMMDD-XXXX)
        $today         = date('Ymd');
        $count         = Invoice::whereDate('created_at', today())->count() + 1;
        $invoiceNumber = "INV-{$today}-" . str_pad($count, 4, '0', STR_PAD_LEFT);

        return view('invoices.create', compact('clients', 'projects', 'invoiceNumber'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_number'      => 'required|unique:invoices,invoice_number',
            'client_id'           => 'required|exists:clients,id',
            'project_id'          => 'required|exists:projects,id',
            'issue_date'          => 'required|date',
            'due_date'            => 'required|date|after_or_equal:issue_date',
            'status'              => 'required|in:draft,sent,paid,overdue',
            'items'               => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.qty'         => 'required|integer|min:1',
            'items.*.price'       => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            // Hitung total dari backend untuk keamanan
            $subtotal = 0;
            foreach ($request->items as $item) {
                $subtotal += $item['qty'] * $item['price'];
            }
            // Tax bisa diimplementasikan dinamis, disini kita ambil input atau default 0
            $tax   = $request->input('tax', 0);
            $total = $subtotal + $tax;

            $invoice = Invoice::create([
                'invoice_number' => $request->invoice_number,
                'client_id'      => $request->client_id,
                'project_id'     => $request->project_id,
                'issue_date'     => $request->issue_date,
                'due_date'       => $request->due_date,
                'subtotal'       => $subtotal,
                'tax'            => $tax,
                'total'          => $total,
                'status'         => $request->status,
            ]);

            foreach ($request->items as $item) {
                $invoice->items()->create([
                    'description' => $item['description'],
                    'qty'         => $item['qty'],
                    'price'       => $item['price'],
                    'total'       => $item['qty'] * $item['price'],
                ]);
            }
        });

        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dibuat.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['client', 'project', 'items']);
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $invoice->load('items');
        $clients  = Client::orderBy('company_name')->get();
        $projects = Project::orderBy('name')->get();

        return view('invoices.edit', compact('invoice', 'clients', 'projects'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'invoice_number'      => 'required|unique:invoices,invoice_number,' . $invoice->id,
            'client_id'           => 'required|exists:clients,id',
            'project_id'          => 'required|exists:projects,id',
            'issue_date'          => 'required|date',
            'due_date'            => 'required|date|after_or_equal:issue_date',
            'status'              => 'required|in:draft,sent,paid,overdue',
            'items'               => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.qty'         => 'required|integer|min:1',
            'items.*.price'       => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $invoice) {
            $subtotal = 0;
            foreach ($request->items as $item) {
                $subtotal += $item['qty'] * $item['price'];
            }
            $tax   = $request->input('tax', 0);
            $total = $subtotal + $tax;

            $invoice->update([
                'invoice_number' => $request->invoice_number,
                'client_id'      => $request->client_id,
                'project_id'     => $request->project_id,
                'issue_date'     => $request->issue_date,
                'due_date'       => $request->due_date,
                'subtotal'       => $subtotal,
                'tax'            => $tax,
                'total'          => $total,
                'status'         => $request->status,
            ]);

            // Replace items (hapus lama, buat baru)
            $invoice->items()->delete();

            foreach ($request->items as $item) {
                $invoice->items()->create([
                    'description' => $item['description'],
                    'qty'         => $item['qty'],
                    'price'       => $item['price'],
                    'total'       => $item['qty'] * $item['price'],
                ]);
            }
        });

        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil diperbarui.');
    }

    public function destroy(Invoice $invoice)
    {
        // Items akan terhapus otomatis karena foreign key cascade di migration
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dihapus.');
    }
}
