@extends('layouts.dashboard')

@section('title', 'Manajemen Karyawan')

@section('content')
<div class="mb-4">
    <h2 class="text-2xl font-bold text-blue-900">📋 Manajemen Karyawan & SDM</h2>
    <p class="text-sm text-gray-600 mt-2">
        <strong>Penjelasan:</strong> Halaman ini digunakan untuk mengelola data karyawan, freelancer, dan pemilik perusahaan.
        Anda dapat menambah, mengedit, dan menghapus data karyawan. Sistem akan otomatis memberikan reminder jika kontrak karyawan akan segera berakhir.
    </p>
</div>

<div class="flex justify-between items-center mb-4">
    <div class="flex gap-2">
        <form method="GET" action="{{ route('employees.index') }}" class="flex gap-2">
            <select name="employee_type" class="border px-2 py-1 text-sm">
                <option value="">Semua Tipe</option>
                <option value="owner" {{ request('employee_type') == 'owner' ? 'selected' : '' }}>Pemilik/Direktur</option>
                <option value="freelancer" {{ request('employee_type') == 'freelancer' ? 'selected' : '' }}>Freelancer</option>
                <option value="contract" {{ request('employee_type') == 'contract' ? 'selected' : '' }}>Karyawan Kontrak</option>
            </select>
            
            <select name="status" class="border px-2 py-1 text-sm">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="contract_ending" {{ request('status') == 'contract_ending' ? 'selected' : '' }}>Kontrak Akan Berakhir</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
            
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 text-sm hover:bg-blue-700">
                Filter
            </button>
            <a href="{{ route('employees.index') }}" class="bg-gray-500 text-white px-3 py-1 text-sm hover:bg-gray-600">
                Reset
            </a>
        </form>
    </div>
    
    <a href="{{ route('employees.create') }}" class="bg-green-600 text-white px-4 py-2 hover:bg-green-700 font-semibold">
        + Tambah Karyawan
    </a>
</div>

@if($employees->isEmpty())
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 text-center">
        <strong>Belum ada data karyawan.</strong> Klik tombol "Tambah Karyawan" untuk menambah data.
    </div>
@else
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-2 py-2 text-left">No</th>
                <th class="border px-2 py-2 text-left">Nama Lengkap</th>
                <th class="border px-2 py-2 text-left">Tipe</th>
                <th class="border px-2 py-2 text-left">Posisi</th>
                <th class="border px-2 py-2 text-left">Email</th>
                <th class="border px-2 py-2 text-left">Telepon</th>
                <th class="border px-2 py-2 text-left">Tanggal Bergabung</th>
                <th class="border px-2 py-2 text-left">Kontrak Berakhir</th>
                <th class="border px-2 py-2 text-left">Status</th>
                <th class="border px-2 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $index => $employee)
            <tr class="hover:bg-blue-50">
                <td class="border px-2 py-2">{{ $index + 1 }}</td>
                <td class="border px-2 py-2 font-semibold">{{ $employee->full_name }}</td>
                <td class="border px-2 py-2">
                    <span class="text-xs bg-blue-100 px-2 py-1 rounded">
                        {{ $employee->getEmployeeTypeLabel() }}
                    </span>
                </td>
                <td class="border px-2 py-2">{{ $employee->position }}</td>
                <td class="border px-2 py-2">{{ $employee->email ?? '-' }}</td>
                <td class="border px-2 py-2">{{ $employee->phone ?? '-' }}</td>
                <td class="border px-2 py-2">{{ $employee->join_date->format('d/m/Y') }}</td>
                <td class="border px-2 py-2 {{ $employee->getContractColorClass() }}">
                    @if($employee->employee_type == 'owner' || $employee->is_permanent)
                        Permanen
                    @elseif($employee->contract_end)
                        {{ $employee->contract_end->format('d/m/Y') }}
                        @if($employee->isContractEnding())
                            <br><small>({{ abs($employee->getDaysUntilContractEnd()) }} hari lagi)</small>
                        @elseif($employee->isContractExpired())
                            <br><small>(Sudah Berakhir)</small>
                        @endif
                    @else
                        -
                    @endif
                </td>
                <td class="border px-2 py-2">
                    <span class="text-xs {{ $employee->getStatusBadgeColor() }} px-2 py-1 rounded">
                        {{ $employee->getStatusLabel() }}
                    </span>
                </td>
                <td class="border px-2 py-2 text-center">
                    <div class="flex gap-1 justify-center">
                        <a href="{{ route('employees.show', $employee) }}" 
                           class="bg-blue-500 text-white px-2 py-1 text-xs hover:bg-blue-600">
                            Detail
                        </a>
                        <a href="{{ route('employees.edit', $employee) }}" 
                           class="bg-yellow-500 text-white px-2 py-1 text-xs hover:bg-yellow-600">
                            Edit
                        </a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus data karyawan ini?')">
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
    
    <div class="mt-4 text-sm text-gray-600">
        <strong>Total:</strong> {{ $employees->count() }} karyawan
    </div>
@endif

<div class="mt-6 p-4 bg-blue-50 border border-blue-200 text-sm">
    <strong>ℹ️ Keterangan Status:</strong>
    <ul class="mt-2 space-y-1">
        <li><span class="bg-green-200 px-2 py-1 rounded text-xs">Aktif</span> - Karyawan masih aktif bekerja</li>
        <li><span class="bg-yellow-200 px-2 py-1 rounded text-xs">Kontrak Akan Berakhir</span> - Kontrak akan berakhir dalam waktu dekat (sesuai reminder yang diset)</li>
        <li><span class="bg-red-200 px-2 py-1 rounded text-xs">Tidak Aktif</span> - Karyawan sudah tidak aktif atau kontrak sudah berakhir</li>
    </ul>
</div>
@endsection
