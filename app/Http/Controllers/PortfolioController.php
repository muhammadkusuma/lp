<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        // Mengambil portfolio beserta relasi project
        $portfolios = Portfolio::with('project')->latest()->get();
        return view('portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        // Mengambil daftar project untuk dropdown
        $projects = Project::orderBy('name', 'asc')->get();
        return view('portfolios.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id'  => 'required|exists:projects,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);

        $data = $request->only(['project_id', 'title', 'description']);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('portfolios', 'public');
            $data['image_url'] = $path;
        }

        Portfolio::create($data);

        return redirect()->route('portfolios.index')->with('success', 'Portfolio berhasil ditambahkan.');
    }

    public function edit(Portfolio $portfolio)
    {
        $projects = Project::orderBy('name', 'asc')->get();
        return view('portfolios.edit', compact('portfolio', 'projects'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'project_id'  => 'required|exists:projects,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['project_id', 'title', 'description']);

        // Handle Image Replacement
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($portfolio->image_url && Storage::disk('public')->exists($portfolio->image_url)) {
                Storage::disk('public')->delete($portfolio->image_url);
            }
            
            $path = $request->file('image')->store('portfolios', 'public');
            $data['image_url'] = $path;
        }

        $portfolio->update($data);

        return redirect()->route('portfolios.index')->with('success', 'Portfolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio)
    {
        // Hapus file gambar terkait
        if ($portfolio->image_url && Storage::disk('public')->exists($portfolio->image_url)) {
            Storage::disk('public')->delete($portfolio->image_url);
        }

        $portfolio->delete();

        return redirect()->route('portfolios.index')->with('success', 'Portfolio berhasil dihapus.');
    }
}