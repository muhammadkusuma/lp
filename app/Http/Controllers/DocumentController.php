<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::query();
        
        // Keyword search (searches in multiple fields)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('document_number', 'LIKE', "%{$keyword}%")
                  ->orWhere('title', 'LIKE', "%{$keyword}%")
                  ->orWhere('description', 'LIKE', "%{$keyword}%")
                  ->orWhere('keywords', 'LIKE', "%{$keyword}%");
            });
        }
        
        // Filter by direction
        if ($request->filled('direction')) {
            $query->where('direction', $request->direction);
        }
        
        // Filter by classification
        if ($request->filled('classification')) {
            $query->where('classification', $request->classification);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by date range
        if ($request->filled('date_from')) {
            $query->where('document_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('document_date', '<=', $request->date_to);
        }
        
        $documents = $query->orderBy('document_date', 'desc')->get();
        
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'direction' => 'required|in:incoming,outgoing',
            'title' => 'required|string|max:255',
            'classification' => 'required|in:legal,keuangan,operasional,sdm,umum',
            'sender' => 'required_if:direction,incoming|nullable|string|max:255',
            'recipient' => 'required_if:direction,outgoing|nullable|string|max:255',
            'document_date' => 'required|date',
            'received_date' => 'nullable|date',
            'sent_date' => 'nullable|date',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'status' => 'required|in:draft,processed,archived',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $data = $request->except('file');
        
        // Generate document number
        $data['document_number'] = Document::generateDocumentNumber($request->direction);
        
        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $year = date('Y');
            $month = date('m');
            $direction = $request->direction;
            
            // Create filename with document number
            $documentNumber = str_replace('/', '_', $data['document_number']);
            $filename = $documentNumber . '_' . $file->getClientOriginalName();
            
            // Store in organized directory structure
            $path = $file->storeAs(
                "documents/{$direction}/{$year}/{$month}",
                $filename,
                'public'
            );
            
            $data['file_path'] = $path;
        }

        Document::create($data);

        return redirect()
            ->route('documents.index')
            ->with('success', 'Dokumen berhasil ditambahkan dengan nomor: ' . $data['document_number']);
    }

    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'direction' => 'required|in:incoming,outgoing',
            'title' => 'required|string|max:255',
            'classification' => 'required|in:legal,keuangan,operasional,sdm,umum',
            'sender' => 'required_if:direction,incoming|nullable|string|max:255',
            'recipient' => 'required_if:direction,outgoing|nullable|string|max:255',
            'document_date' => 'required|date',
            'received_date' => 'nullable|date',
            'sent_date' => 'nullable|date',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'status' => 'required|in:draft,processed,archived',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $data = $request->except('file');
        
        // Handle new file upload
        if ($request->hasFile('file')) {
            // Delete old file
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            
            // Upload new file
            $file = $request->file('file');
            $year = date('Y');
            $month = date('m');
            $direction = $request->direction;
            
            $documentNumber = str_replace('/', '_', $document->document_number);
            $filename = $documentNumber . '_' . $file->getClientOriginalName();
            
            $path = $file->storeAs(
                "documents/{$direction}/{$year}/{$month}",
                $filename,
                'public'
            );
            
            $data['file_path'] = $path;
        }

        $document->update($data);

        return redirect()
            ->route('documents.show', $document)
            ->with('success', 'Dokumen berhasil diperbarui');
    }

    public function destroy(Document $document)
    {
        // Delete file from storage
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }
        
        $document->delete();

        return redirect()
            ->route('documents.index')
            ->with('success', 'Dokumen berhasil dihapus');
    }
}
