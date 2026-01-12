<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // Eager load client dan service untuk performa query
        $projects = Project::with(['client', 'service'])->latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $clients  = Client::orderBy('company_name')->get();
        $services = Service::orderBy('name')->get(); // Asumsi tabel services punya kolom 'name'
        return view('projects.create', compact('clients', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'client_id'  => 'required|exists:clients,id',
            'service_id' => 'required|exists:services,id',
            'status'     => 'required|in:planning,running,done,cancel',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'value'      => 'nullable|numeric|min:0',
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project berhasil dibuat');
    }

    public function edit(Project $project)
    {
        $clients  = Client::orderBy('company_name')->get();
        $services = Service::orderBy('name')->get();
        return view('projects.edit', compact('project', 'clients', 'services'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'client_id'  => 'required|exists:clients,id',
            'service_id' => 'required|exists:services,id',
            'status'     => 'required|in:planning,running,done,cancel',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'value'      => 'nullable|numeric|min:0',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project berhasil diperbarui');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project berhasil dihapus');
    }
}
