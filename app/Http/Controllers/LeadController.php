<?php
namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        // Mengambil data lead urut dari yang terbaru
        $leads = Lead::latest()->get();

        return view('leads.index', compact('leads'));
    }

    public function create()
    {
        return view('leads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'source' => 'required|string|max:255', // Contoh: Google, Referensi, Instagram
            'status' => 'required|string|max:50',  // Contoh: New, Contacted, Qualified
        ]);

        Lead::create($request->all());

        return redirect()->route('leads.index')
            ->with('success', 'Lead berhasil ditambahkan');
    }

    public function edit(Lead $lead)
    {
        return view('leads.edit', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'source' => 'required|string|max:255',
            'status' => 'required|string|max:50',
        ]);

        $lead->update($request->all());

        return redirect()->route('leads.index')
            ->with('success', 'Lead berhasil diperbarui');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('leads.index')
            ->with('success', 'Lead berhasil dihapus');
    }
}
