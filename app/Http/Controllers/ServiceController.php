<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Mengurutkan berdasarkan 'name' sesuai kolom yang ada
        $services = Service::orderBy('name')->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price_start' => 'nullable|numeric',
            'status'      => 'required|in:active,inactive',
        ]);

        Service::create($request->all());

        return redirect()
            ->route('services.index')
            ->with('success', 'Service berhasil ditambahkan');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price_start' => 'nullable|numeric',
            'status'      => 'required|in:active,inactive',
        ]);

        $service->update($request->all());

        return redirect()
            ->route('services.index')
            ->with('success', 'Service berhasil diperbarui');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()
            ->route('services.index')
            ->with('success', 'Service berhasil dihapus');
    }
}