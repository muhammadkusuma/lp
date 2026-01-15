<?php

namespace App\Http\Controllers;

use App\Models\DocumentTemplate;
use Illuminate\Http\Request;

class DocumentTemplateController extends Controller
{
    public function index()
    {
        $templates = DocumentTemplate::orderBy('type')->orderBy('name')->get();
        return view('document-templates.index', compact('templates'));
    }

    public function create()
    {
        return view('document-templates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:surat_resmi,perjanjian_kontrak,memo_internal,dokumen_legal',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,txt,odt|max:10240',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->except('file');
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('document-templates', $filename, 'public');
            $data['file_path'] = $path;
        }

        DocumentTemplate::create($data);

        return redirect()
            ->route('document-templates.index')
            ->with('success', 'Template dokumen berhasil ditambahkan');
    }

    public function edit(DocumentTemplate $documentTemplate)
    {
        return view('document-templates.edit', compact('documentTemplate'));
    }

    public function update(Request $request, DocumentTemplate $documentTemplate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:surat_resmi,perjanjian_kontrak,memo_internal,dokumen_legal',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt,odt|max:10240',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->except('file');
        
        if ($request->hasFile('file')) {
            // Delete old file
            if ($documentTemplate->file_path && \Storage::disk('public')->exists($documentTemplate->file_path)) {
                \Storage::disk('public')->delete($documentTemplate->file_path);
            }
            
            // Store new file
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('document-templates', $filename, 'public');
            $data['file_path'] = $path;
        }

        $documentTemplate->update($data);

        return redirect()
            ->route('document-templates.index')
            ->with('success', 'Template dokumen berhasil diperbarui');
    }

    public function destroy(DocumentTemplate $documentTemplate)
    {
        // Delete file from storage
        if ($documentTemplate->file_path && \Storage::disk('public')->exists($documentTemplate->file_path)) {
            \Storage::disk('public')->delete($documentTemplate->file_path);
        }
        
        $documentTemplate->delete();

        return redirect()
            ->route('document-templates.index')
            ->with('success', 'Template dokumen berhasil dihapus');
    }
}
