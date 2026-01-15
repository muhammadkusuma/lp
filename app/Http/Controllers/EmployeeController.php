<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Menampilkan daftar karyawan
     */
    public function index(Request $request)
    {
        $query = Employee::query();

        // Filter berdasarkan tipe karyawan
        if ($request->filled('employee_type')) {
            $query->where('employee_type', $request->employee_type);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $employees = $query->latest()->get();

        return view('employees.index', compact('employees'));
    }

    /**
     * Menampilkan form tambah karyawan baru
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Menyimpan data karyawan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_type' => 'required|in:owner,freelancer,contract',
            'full_name' => 'required|string|max:255',
            'id_number' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'position' => 'required|string|max:255',
            'join_date' => 'required|date',
            'contract_start' => 'nullable|date',
            'contract_end' => 'nullable|date|after:contract_start',
            'is_permanent' => 'boolean',
            'salary' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'reminder_days' => 'nullable|integer|min:1|max:365',
        ], [
            'employee_type.required' => 'Tipe karyawan wajib dipilih',
            'full_name.required' => 'Nama lengkap wajib diisi',
            'position.required' => 'Posisi/jabatan wajib diisi',
            'join_date.required' => 'Tanggal bergabung wajib diisi',
            'contract_end.after' => 'Tanggal akhir kontrak harus setelah tanggal mulai kontrak',
            'salary.numeric' => 'Gaji harus berupa angka',
            'salary.min' => 'Gaji tidak boleh negatif',
        ]);

        $employee = Employee::create($validated);
        $employee->updateStatus();

        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil ditambahkan');
    }

    /**
     * Menampilkan detail karyawan
     */
    public function show(Employee $employee)
    {
        $employee->load('documents');
        return view('employees.show', compact('employee'));
    }

    /**
     * Menampilkan form edit karyawan
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Memperbarui data karyawan
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'employee_type' => 'required|in:owner,freelancer,contract',
            'full_name' => 'required|string|max:255',
            'id_number' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'position' => 'required|string|max:255',
            'join_date' => 'required|date',
            'contract_start' => 'nullable|date',
            'contract_end' => 'nullable|date|after:contract_start',
            'is_permanent' => 'boolean',
            'salary' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'reminder_days' => 'nullable|integer|min:1|max:365',
        ], [
            'employee_type.required' => 'Tipe karyawan wajib dipilih',
            'full_name.required' => 'Nama lengkap wajib diisi',
            'position.required' => 'Posisi/jabatan wajib diisi',
            'join_date.required' => 'Tanggal bergabung wajib diisi',
            'contract_end.after' => 'Tanggal akhir kontrak harus setelah tanggal mulai kontrak',
            'salary.numeric' => 'Gaji harus berupa angka',
            'salary.min' => 'Gaji tidak boleh negatif',
        ]);

        $employee->update($validated);
        $employee->updateStatus();

        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil diperbarui');
    }

    /**
     * Menghapus data karyawan
     */
    public function destroy(Employee $employee)
    {
        // Hapus semua dokumen terkait
        foreach ($employee->documents as $document) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            $document->delete();
        }

        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil dihapus');
    }

    /**
     * Upload dokumen karyawan
     */
    public function uploadDocument(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'document_type' => 'required|in:ktp,npwp,cv,contract,certificate,other',
            'document_name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'upload_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:upload_date',
            'notes' => 'nullable|string',
        ], [
            'document_type.required' => 'Tipe dokumen wajib dipilih',
            'document_name.required' => 'Nama dokumen wajib diisi',
            'file.required' => 'File dokumen wajib diunggah',
            'file.mimes' => 'File harus berformat: pdf, jpg, jpeg, png, doc, atau docx',
            'file.max' => 'Ukuran file maksimal 5MB',
            'upload_date.required' => 'Tanggal upload wajib diisi',
            'expiry_date.after' => 'Tanggal kadaluarsa harus setelah tanggal upload',
        ]);

        // Upload file
        $filePath = $request->file('file')->store('employee-documents', 'public');

        EmployeeDocument::create([
            'employee_id' => $employee->id,
            'document_type' => $validated['document_type'],
            'document_name' => $validated['document_name'],
            'file_path' => $filePath,
            'upload_date' => $validated['upload_date'],
            'expiry_date' => $validated['expiry_date'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('employees.show', $employee)
            ->with('success', 'Dokumen berhasil diunggah');
    }

    /**
     * Hapus dokumen karyawan
     */
    public function deleteDocument(Employee $employee, EmployeeDocument $document)
    {
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('employees.show', $employee)
            ->with('success', 'Dokumen berhasil dihapus');
    }
}
