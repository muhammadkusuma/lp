<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\AgreementVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgreementController extends Controller
{
    public function index(Request $request)
    {
        $query = Agreement::query()->orderBy('created_at', 'desc');
        
        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $agreements = $query->get();
        
        return view('agreements.index', compact('agreements'));
    }

    public function create()
    {
        return view('agreements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'agreement_number' => 'required|string|max:100|unique:agreements,agreement_number',
            'type' => 'required|in:non_profit,freelancer,pkwt',
            'party_name' => 'required|string|max:255',
            'party_contact' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:active,expired,extended',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $data = $request->except('file');
        $data['current_version'] = 1;

        // Create agreement
        $agreement = Agreement::create($data);

        // Handle file upload for version 1
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_v1_' . $file->getClientOriginalName();
            $path = $file->storeAs("agreements/{$agreement->id}", $filename, 'public');
            
            // Update agreement with file path
            $agreement->update(['current_file_path' => $path]);
            
            // Create version 1
            AgreementVersion::create([
                'agreement_id' => $agreement->id,
                'version_number' => 1,
                'file_path' => $path,
                'notes' => 'Initial version',
                'uploaded_by' => auth()->id(),
            ]);
        }

        return redirect()
            ->route('agreements.index')
            ->with('success', 'Perjanjian berhasil ditambahkan');
    }

    public function show(Agreement $agreement)
    {
        $agreement->load(['versions.uploader']);
        return view('agreements.show', compact('agreement'));
    }

    public function edit(Agreement $agreement)
    {
        return view('agreements.edit', compact('agreement'));
    }

    public function update(Request $request, Agreement $agreement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'agreement_number' => 'required|string|max:100|unique:agreements,agreement_number,' . $agreement->id,
            'type' => 'required|in:non_profit,freelancer,pkwt',
            'party_name' => 'required|string|max:255',
            'party_contact' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:active,expired,extended',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'version_notes' => 'nullable|string',
        ]);

        $data = $request->except(['file', 'version_notes']);
        
        // Handle new file upload (creates new version)
        if ($request->hasFile('file')) {
            $newVersion = $agreement->current_version + 1;
            
            $file = $request->file('file');
            $filename = time() . '_v' . $newVersion . '_' . $file->getClientOriginalName();
            $path = $file->storeAs("agreements/{$agreement->id}", $filename, 'public');
            
            // Update agreement with new file path and version
            $data['current_file_path'] = $path;
            $data['current_version'] = $newVersion;
            
            // Create new version record
            AgreementVersion::create([
                'agreement_id' => $agreement->id,
                'version_number' => $newVersion,
                'file_path' => $path,
                'notes' => $request->version_notes ?? 'Updated version',
                'uploaded_by' => auth()->id(),
            ]);
        }

        $agreement->update($data);

        return redirect()
            ->route('agreements.show', $agreement)
            ->with('success', 'Perjanjian berhasil diperbarui');
    }

    public function destroy(Agreement $agreement)
    {
        // Delete all files from storage
        $directory = "agreements/{$agreement->id}";
        if (Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->deleteDirectory($directory);
        }
        
        // Delete agreement (versions will be cascade deleted)
        $agreement->delete();

        return redirect()
            ->route('agreements.index')
            ->with('success', 'Perjanjian berhasil dihapus');
    }
}
