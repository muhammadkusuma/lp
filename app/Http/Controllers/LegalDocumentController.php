<?php

namespace App\Http\Controllers;

use App\Models\LegalDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LegalDocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = LegalDocument::query();
        
        // Auto-update all document statuses
        LegalDocument::all()->each->updateStatus();
        
        // Filter by document type
        if ($request->filled('document_type')) {
            $query->where('document_type', $request->document_type);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Order by expiry date (soonest first, nulls last)
        $documents = $query->orderByRaw('CASE WHEN expiry_date IS NULL THEN 1 ELSE 0 END')
                          ->orderBy('expiry_date', 'asc')
                          ->get();
        
        // Get alert counts
        $expiredCount = LegalDocument::where('status', 'expired')->count();
        $expiringCount = LegalDocument::where('status', 'pending_renewal')->count();
        
        return view('legal-documents.index', compact('documents', 'expiredCount', 'expiringCount'));
    }

    public function create()
    {
        return view('legal-documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_type' => 'required|in:akta_pendirian,sk_kemenkumham,npwp,nib,siup,tdp,other',
            'document_number' => 'required|string|max:100',
            'document_name' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:issue_date',
            'is_permanent' => 'boolean',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'notes' => 'nullable|string',
            'reminder_days' => 'nullable|integer|min:1|max:365',
        ]);

        $data = $request->except('file');
        $data['is_permanent'] = $request->has('is_permanent');
        $data['reminder_days'] = $request->reminder_days ?? 30;
        
        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $documentType = $request->document_type;
            $documentNumber = str_replace(['/', ' '], '_', $request->document_number);
            
            $filename = $documentType . '_' . $documentNumber . '_' . $file->getClientOriginalName();
            $path = $file->storeAs("legal-documents/{$documentType}", $filename, 'public');
            
            $data['file_path'] = $path;
        }
        
        $document = LegalDocument::create($data);
        $document->updateStatus();

        return redirect()
            ->route('legal-documents.index')
            ->with('success', 'Dokumen legal berhasil ditambahkan');
    }

    public function show(LegalDocument $legalDocument)
    {
        $legalDocument->updateStatus();
        return view('legal-documents.show', compact('legalDocument'));
    }

    public function edit(LegalDocument $legalDocument)
    {
        return view('legal-documents.edit', compact('legalDocument'));
    }

    public function update(Request $request, LegalDocument $legalDocument)
    {
        $request->validate([
            'document_type' => 'required|in:akta_pendirian,sk_kemenkumham,npwp,nib,siup,tdp,other',
            'document_number' => 'required|string|max:100',
            'document_name' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:issue_date',
            'is_permanent' => 'boolean',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'notes' => 'nullable|string',
            'reminder_days' => 'nullable|integer|min:1|max:365',
        ]);

        $data = $request->except('file');
        $data['is_permanent'] = $request->has('is_permanent');
        
        // Handle new file upload
        if ($request->hasFile('file')) {
            // Delete old file
            if ($legalDocument->file_path && Storage::disk('public')->exists($legalDocument->file_path)) {
                Storage::disk('public')->delete($legalDocument->file_path);
            }
            
            // Upload new file
            $file = $request->file('file');
            $documentType = $request->document_type;
            $documentNumber = str_replace(['/', ' '], '_', $request->document_number);
            
            $filename = $documentType . '_' . $documentNumber . '_' . $file->getClientOriginalName();
            $path = $file->storeAs("legal-documents/{$documentType}", $filename, 'public');
            
            $data['file_path'] = $path;
        }

        $legalDocument->update($data);
        $legalDocument->updateStatus();

        return redirect()
            ->route('legal-documents.show', $legalDocument)
            ->with('success', 'Dokumen legal berhasil diperbarui');
    }

    public function destroy(LegalDocument $legalDocument)
    {
        // Delete file from storage
        if ($legalDocument->file_path && Storage::disk('public')->exists($legalDocument->file_path)) {
            Storage::disk('public')->delete($legalDocument->file_path);
        }
        
        $legalDocument->delete();

        return redirect()
            ->route('legal-documents.index')
            ->with('success', 'Dokumen legal berhasil dihapus');
    }
}
