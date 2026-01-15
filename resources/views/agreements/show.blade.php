@extends('layouts.dashboard')

@section('title', 'Detail Perjanjian')

@section('content')
    <div class="h-full flex flex-col">

        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">📋 Detail Perjanjian</h2>
            <div class="flex gap-2">
                <a href="{{ route('agreements.edit', $agreement) }}" class="bg-blue-700 text-white px-3 py-1 win-border">
                    ✏️ Edit
                </a>
                <form action="{{ route('agreements.destroy', $agreement) }}" method="POST" class="inline"
                    onsubmit="return confirm('Hapus perjanjian ini dan semua versinya?')">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-700 text-white px-3 py-1 win-border">🗑️ Hapus</button>
                </form>
                <a href="{{ route('agreements.index') }}" class="bg-gray-400 text-white px-3 py-1 win-border">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="overflow-auto">
            {{-- Agreement Details --}}
            <div class="win-border bg-white p-4 mb-4">
                <h3 class="font-bold text-lg mb-3 border-b-2 border-blue-900 pb-1">Informasi Perjanjian</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div class="mb-3">
                            <label class="font-bold text-sm">Nomor Perjanjian:</label>
                            <div class="text-lg font-bold text-blue-900">{{ $agreement->agreement_number }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Judul:</label>
                            <div>{{ $agreement->title }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Jenis:</label>
                            <div>
                                <span class="px-2 py-1 text-sm win-border bg-blue-100">
                                    {{ $agreement->getTypeLabel() }}
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Status:</label>
                            <div>
                                <span class="px-2 py-1 text-sm win-border {{ $agreement->getStatusBadgeColor() }}">
                                    {{ $agreement->getStatusLabel() }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3">
                            <label class="font-bold text-sm">Nama Pihak:</label>
                            <div>{{ $agreement->party_name }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Kontak Pihak:</label>
                            <div>{{ $agreement->party_contact ?? '-' }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Periode:</label>
                            <div>
                                {{ $agreement->start_date->format('d/m/Y') }}
                                @if($agreement->end_date)
                                    s/d {{ $agreement->end_date->format('d/m/Y') }}
                                    @if($agreement->isExpired())
                                        <span class="text-red-600 font-bold">(Sudah Berakhir)</span>
                                    @endif
                                @else
                                    <span class="text-gray-600">(Tidak ada batas waktu)</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Versi Saat Ini:</label>
                            <div class="text-lg font-bold">v{{ $agreement->current_version }}</div>
                        </div>
                    </div>
                </div>

                @if($agreement->description)
                    <div class="mb-3 mt-4">
                        <label class="font-bold text-sm">Deskripsi:</label>
                        <div class="p-2 bg-gray-50 border border-gray-300 mt-1">{{ $agreement->description }}</div>
                    </div>
                @endif

                @if($agreement->current_file_path)
                    <div class="mt-4 p-3 bg-blue-50 border-2 border-blue-300">
                        <label class="font-bold text-sm">File Perjanjian Terkini:</label>
                        <div class="mt-1">
                            <a href="{{ asset('storage/' . $agreement->current_file_path) }}" 
                               target="_blank" 
                               class="text-blue-700 hover:underline font-bold text-lg">
                                📎 {{ basename($agreement->current_file_path) }}
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Version History --}}
            <div class="win-border bg-white p-4">
                <h3 class="font-bold text-lg mb-3 border-b-2 border-blue-900 pb-1">🔄 Riwayat Revisi & Versi Dokumen</h3>
                
                @if($agreement->versions->count() > 0)
                    <table class="w-full text-sm border-collapse">
                        <thead class="bg-blue-200 text-blue-900">
                            <tr>
                                <th class="border px-2 py-1 w-20">Versi</th>
                                <th class="border px-2 py-1">File</th>
                                <th class="border px-2 py-1">Catatan</th>
                                <th class="border px-2 py-1">Diupload Oleh</th>
                                <th class="border px-2 py-1">Tanggal Upload</th>
                                <th class="border px-2 py-1 w-24">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agreement->versions as $version)
                                <tr class="hover:bg-blue-100 {{ $version->version_number == $agreement->current_version ? 'bg-green-50' : '' }}">
                                    <td class="border px-2 py-1 text-center">
                                        <span class="font-bold text-lg">v{{ $version->version_number }}</span>
                                        @if($version->version_number == $agreement->current_version)
                                            <br><span class="text-xs text-green-700 font-bold">(Terkini)</span>
                                        @endif
                                    </td>
                                    <td class="border px-2 py-1">
                                        <span class="text-xs">{{ basename($version->file_path) }}</span>
                                    </td>
                                    <td class="border px-2 py-1">
                                        {{ $version->notes ?? '-' }}
                                    </td>
                                    <td class="border px-2 py-1">
                                        {{ $version->uploader->name ?? 'System' }}
                                    </td>
                                    <td class="border px-2 py-1 text-xs">
                                        {{ $version->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="border px-2 py-1 text-center">
                                        <a href="{{ asset('storage/' . $version->file_path) }}" 
                                           target="_blank" 
                                           class="text-blue-700 hover:underline"
                                           title="Download">
                                            📥
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center text-gray-500 py-4">
                        Belum ada riwayat versi
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
