<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Menampilkan daftar pembayaran.
     */
    public function index()
    {
        // Mengambil data payment beserta relasi invoice dan client
        $payments = Payment::with(['invoice.client'])->latest()->paginate(10);

        return view('payments.index', compact('payments'));
    }

    /**
     * Menampilkan form tambah pembayaran.
     */
    public function create()
    {
        // Hanya invoice yang belum LUNAS sepenuhnya yang mungkin perlu ditampilkan
        // Namun untuk sederhana, kita tampilkan semua invoice
        $invoices = Invoice::with('client')->latest()->get();

        return view('payments.create', compact('invoices'));
    }

    /**
     * Menyimpan pembayaran baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'invoice_id'   => 'required|exists:invoices,id',
            'payment_date' => 'required|date',
            'amount'       => 'required|numeric|min:0',
            'method'       => 'required|string',
            'proof_file'   => 'nullable|image|mimes:jpeg,png,jpg,pdf|max:2048', // Validasi file
        ]);

        $data = $request->except('proof_file');

        // Handle File Upload jika ada
        if ($request->hasFile('proof_file')) {
            $path              = $request->file('proof_file')->store('payments', 'public');
            $data['proof_url'] = $path;
        }

        Payment::create($data);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dicatat.');
    }

    /**
     * Menampilkan form edit pembayaran.
     */
    public function edit(Payment $payment)
    {
        $invoices = Invoice::with('client')->get();
        return view('payments.edit', compact('payment', 'invoices'));
    }

    /**
     * Memperbarui data pembayaran.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'invoice_id'   => 'required|exists:invoices,id',
            'payment_date' => 'required|date',
            'amount'       => 'required|numeric|min:0',
            'method'       => 'required|string',
            'proof_file'   => 'nullable|image|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $data = $request->except('proof_file');

        // Handle File Upload jika ada file baru
        if ($request->hasFile('proof_file')) {
            // Hapus file lama jika ada
            if ($payment->proof_url && Storage::disk('public')->exists($payment->proof_url)) {
                Storage::disk('public')->delete($payment->proof_url);
            }

            $path              = $request->file('proof_file')->store('payments', 'public');
            $data['proof_url'] = $path;
        }

        $payment->update($data);

        return redirect()->route('payments.index')->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    /**
     * Menghapus pembayaran.
     */
    public function destroy(Payment $payment)
    {
        // Hapus bukti bayar dari storage jika ada
        if ($payment->proof_url && Storage::disk('public')->exists($payment->proof_url)) {
            Storage::disk('public')->delete($payment->proof_url);
        }

        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
