<?php
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
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
            'name'        => 'required|string|max:150',
            'slug'        => 'required|string|max:150|unique:services,slug',
            'price'       => 'nullable|numeric',
            'unit'        => 'nullable|string|max:50',
            'is_active'   => 'required|boolean',
            'description' => 'nullable|string',
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
            'name'        => 'required|string|max:150',
            'slug'        => 'required|string|max:150|unique:services,slug,' . $service->id,
            'price'       => 'nullable|numeric',
            'unit'        => 'nullable|string|max:50',
            'is_active'   => 'required|boolean',
            'description' => 'nullable|string',
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
