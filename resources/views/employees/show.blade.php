@extends('layouts.dashboard')

@section('title', 'Detail Karyawan')

@section('content')
<div class="mb-4">
    <h2 class="text-2xl font-bold text-blue-900">👤 Detail Karyawan</h2>
    <p class="text-sm text-gray-600 mt-2">
        <strong>Penjelasan:</strong> Halaman ini menampilkan detail lengkap data karyawan beserta dokumen-dokumen yang terkait.
    </p>
</div>

<div class="bg-gray-50 p-4 mb-4 border">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <h3 class="font-bold text-lg mb-3 text-blue-800">Informasi Pribadi</h3>
            <table class="w-full text-sm">
                <tr>
                    <td class="py-1 font-semibold w-1/3">Nama Lengkap:</td>
                    <td class="py-1">{{ $employee->full_name }}</td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold">Tipe Karyawan:</td>
                    <td class="py-1">
                        <span class="bg-blue-100 px-2 py-1 rounded text-xs">
                            {{ $employee->getEmployeeTypeLabel() }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold">NIK / No. Identitas:</td>
                    <td class="py-1">{{ $employee->id_number ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold">Email:</td>
                    <td class="py-1">{{ $employee->email ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold">Telepon:</td>
                    <td class="py-1">{{ $employee->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold">Alamat:</td>
                    <td class="py-1">{{ $employee->address ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <div>
            <h3 class="font-bold text-lg mb-3 text-blue-800">Informasi Pekerjaan</h3>
            <table class="w-full text-sm">
                <tr>
                    <td class="py-1 font-semibold w-1/3">Posisi / Jabatan:</td>
                    <td class="py-1">{{ $employee->position }}</td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold">Tanggal Bergabung:</td>
                    <td class="py-1">{{ $employee->join_date->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold">Tanggal Mulai Kontrak:</td>
                    <td class="py-1">{{ $employee->contract_start?->format('d/m/Y') ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold">Tanggal Akhir Kontrak:</td>
                    <td class="py-1 {{ $employee->getContractColorClass() }}">
                        @if($employee->employee_type == 'owner' || $employee->is_permanent)
                            Permanen
                        @elseif($employee->contract_end)
                            {{ $employee->contract_end->format('d/m/Y') }}
                            @if($employee->isContractEnding())
                                <br><small>(⚠️ {{ abs($employee->getDaysUntilContractEnd()) }} hari lagi)</small>
                            @elseif($employee->isContractExpired())
                                <br><small>(❌ Sudah Berakhir)</small>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold">Status:</td>
                    <td class="py-1">
                        <span class="{{ $employee->getStatusBadgeColor() }} px-2 py-1 rounded text-xs">
                            {{ $employee->getStatusLabel() }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold">Gaji:</td>
                    <td class="py-1">{{ $employee->salary ? 'Rp ' . number_format($employee->salary, 0, ',', '.') : '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

    @if($employee->notes)
    <div class="mt-4">
        <h3 class="font-bold text-sm mb-1">Catatan:</h3>
        <p class="text-sm bg-yellow-50 p-2 border border-yellow-200">{{ $employee->notes }}</p>
    </div>
    @endif
</div>

<div class="flex gap-2 mb-4">
    <a href="{{ route('employees.edit', $employee) }}" class="bg-yellow-500 text-white px-4 py-2 hover:bg-yellow-600">
        ✏️ Edit Data
    </a>
    <a href="{{ route('employees.index') }}" class="bg-gray-500 text-white px-4 py-2 hover:bg-gray-600">
        ← Kembali ke Daftar
    </a>
</div>

<hr class="my-6">

<div>
    <h3 class="text-xl font-bold text-blue-900 mb-3">📎 Dokumen Karyawan</h3>
    <p class="text-sm text-gray-600 mb-4">
        Daftar dokumen yang terkait dengan karyawan ini (KTP, NPWP, CV, Kontrak, Sertifikat, dll).
    </p>

    @if($employee->documents->isEmpty())
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 text-center mb-4">
            Belum ada dokumen yang diunggah untuk karyawan ini.
        </div>
    @else
        <table class="w-full border-collapse border mb-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-2 py-2 text-left">No</th>
                    <th class="border px-2 py-2 text-left">Tipe Dokumen</th>
                    <th class="border px-2 py-2 text-left">Nama Dokumen</th>
                    <th class="border px-2 py-2 text-left">Tanggal Upload</th>
                    <th class="border px-2 py-2 text-left">Tanggal Kadaluarsa</th>
                    <th class="border px-2 py-2 text-left">Catatan</th>
                    <th class="border px-2 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employee->documents as $index => $document)
                <tr class="hover:bg-blue-50">
                    <td class="border px-2 py-2">{{ $index + 1 }}</td>
                    <td class="border px-2 py-2">
                        <span class="text-xs bg-purple-100 px-2 py-1 rounded">
                            {{ $document->getDocumentTypeLabel() }}
                        </span>
                    </td>
                    <td class="border px-2 py-2 font-semibold">{{ $document->document_name }}</td>
                    <td class="border px-2 py-2">{{ $document->upload_date->format('d/m/Y') }}</td>
                    <td class="border px-2 py-2 {{ $document->isExpiringSoon() ? 'text-red-700 font-bold' : '' }}">
                        {{ $document->expiry_date?->format('d/m/Y') ?? '-' }}
                        @if($document->isExpiringSoon())
                            <br><small>(⚠️ Akan kadaluarsa)</small>
                        @endif
                    </td>
                    <td class="border px-2 py-2 text-xs">{{ $document->notes ?? '-' }}</td>
                    <td class="border px-2 py-2 text-center">
                        <div class="flex gap-1 justify-center">
                            <a href="{{ Storage::url($document->file_path) }}" target="_blank"
                               class="bg-blue-500 text-white px-2 py-1 text-xs hover:bg-blue-600">
                                Lihat
                            </a>
                            <form action="{{ route('employees.documents.delete', [$employee, $document]) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 text-xs hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="bg-blue-50 p-4 border border-blue-200">
        <h4 class="font-bold mb-2">📤 Upload Dokumen Baru</h4>
        <form action="{{ route('employees.documents.upload', $employee) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf
            
            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label class="block font-semibold mb-1 text-sm">Tipe Dokumen *</label>
                    <select name="document_type" class="w-full border px-2 py-1 text-sm" required>
                        <option value="">-- Pilih --</option>
                        <option value="ktp">KTP</option>
                        <option value="npwp">NPWP</option>
                        <option value="cv">CV / Resume</option>
                        <option value="contract">Kontrak Kerja</option>
                        <option value="certificate">Sertifikat</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-sm">Nama Dokumen *</label>
                    <input type="text" name="document_name" class="w-full border px-2 py-1 text-sm" required>
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-sm">File Dokumen * (Max 5MB)</label>
                    <input type="file" name="file" class="w-full border px-2 py-1 text-sm" required
                           accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label class="block font-semibold mb-1 text-sm">Tanggal Upload *</label>
                    <input type="date" name="upload_date" value="{{ date('Y-m-d') }}" class="w-full border px-2 py-1 text-sm" required>
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-sm">Tanggal Kadaluarsa</label>
                    <input type="date" name="expiry_date" class="w-full border px-2 py-1 text-sm">
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-sm">Catatan</label>
                    <input type="text" name="notes" class="w-full border px-2 py-1 text-sm">
                </div>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 text-sm hover:bg-green-700">
                📤 Upload Dokumen
            </button>
        </form>
    </div>
</div>
@endsection
