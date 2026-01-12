<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        // Mengurutkan berdasarkan waktu pembuatan terbaru
        $clients = Client::latest()->get();

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contact_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'nullable|string|max:20',
            'address'      => 'nullable|string',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Client berhasil ditambahkan');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'contact_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'nullable|string|max:20',
            'address'      => 'nullable|string',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Client berhasil diperbarui');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client berhasil dihapus');
    }
}