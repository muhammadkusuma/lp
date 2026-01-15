@extends('layouts.dashboard')

@section('title', 'Detail Dokumen Legal')

@section('content')
    <div class="h-full flex flex-col">

        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">⚖️ Detail Dokumen Legal</h2>
            <div class="flex gap-2">
                <a href="{{ route('legal-documents.edit', $legalDocument) }}" class="bg-blue-700 text-white px-3 py-1 win-border">
                    ✏️ Edit
                </a>
                <form action="{{ route('legal-documents.destroy', $legalDocument) }}" method="POST" class="inline"
                    onsubmit="return confirm('Hapus dokumen legal ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-700 text-white px-3 py-1 win-border">🗑️ Hapus</button>
                </form>
                <a href="{{ route('legal-documents.index') }}" class="bg-gray-400 text-white px-3 py-1 win-border">
                    ← Kembali
                </a>
            </div>
        </div>

        {{-- Expiry Alert --}}
        @if($legalDocument->isExpired())
            <div class="mb-3 p-4 bg-red-100 border-2 border-red-500">
                <div class="flex items-center">
                    <span class="text-3xl mr-3">⚠️</span>
                    <div>
                        <strong class="text-red-900 text-lg">DOKUMEN KADALUARSA!</strong><br>
                        <span class="text-red-800">Dokumen ini sudah kadaluarsa <strong>{{ abs($legalDocument->getDaysUntilExpiry()) }} hari yang lalu</strong>. Segera perpanjang!</span>
                    </div>
                </div>
            </div>
        @elseif($legalDocument->isExpiringSoon())
            <div class="mb-3 p-4 bg-yellow-100 border-2 border-yellow-500">
                <div class="flex items-center">
                    <span class="text-3xl mr-3">⏰</span>
                    <div>
                        <strong class="text-yellow-900 text-lg">REMINDER PERPANJANGAN</strong><br>
                        <span class="text-yellow-800">Dokumen ini akan kadaluarsa dalam <strong>{{ $legalDocument->getDaysUntilExpiry() }} hari</strong>. Segera rencanakan perpanjangan!</span>
                    </div>
                </div>
            </div>
        @elseif($legalDocument->is_permanent)
            <div class="mb-3 p-4 bg-blue-100 border-2 border-blue-300">
                <div class="flex items-center">
                    <span class="text-3xl mr-3">♾️</span>
                    <div>
                        <strong class="text-blue-900 text-lg">DOKUMEN PERMANEN</strong><br>
                        <span class="text-blue-800">Dokumen ini tidak memiliki masa berlaku (permanen).</span>
                    </div>
                </div>
            </div>
        @else
            <div class="mb-3 p-4 bg-green-100 border-2 border-green-300">
                <div class="flex items-center">
                    <span class="text-3xl mr-3">✅</span>
                    <div>
                        <strong class="text-green-900 text-lg">DOKUMEN AKTIF</strong><br>
                        <span class="text-green-800">Dokumen masih berlaku. Sisa waktu: <strong>{{ $legalDocument->getDaysUntilExpiry() }} hari</strong>.</span>
                    </div>
                </div>
            </div>
        @endif

        <div class="overflow-auto">
            <div class="win-border bg-white p-4">
                <h3 class="font-bold text-lg mb-3 border-b-2 border-blue-900 pb-1">Informasi Dokumen</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div class="mb-3">
                            <label class="font-bold text-sm">Jenis Dokumen:</label>
                            <div>
                                <span class="px-2 py-1 text-sm win-border bg-purple-100">
                                    {{ $legalDocument->getDocumentTypeLabel() }}
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Nomor Dokumen:</label>
                            <div class="text-lg font-bold text-blue-900">{{ $legalDocument->document_number }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Nama Dokumen:</label>
                            <div>{{ $legalDocument->document_name }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Penerbit:</label>
                            <div>{{ $legalDocument->issuer }}</div>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3">
                            <label class="font-bold text-sm">Tanggal Terbit:</label>
                            <div>{{ $legalDocument->issue_date->format('d/m/Y') }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Tanggal Kadaluarsa:</label>
                            <div class="{{ $legalDocument->getExpiryColorClass() }}">
                                @if($legalDocument->is_permanent)
                                    <strong>PERMANEN (Tidak Ada Masa Berlaku)</strong>
                                @elseif($legalDocument->expiry_date)
                                    <strong>{{ $legalDocument->expiry_date->format('d/m/Y') }}</strong>
                                @else
                                    -
                                @endif
                            </div>
                        </div>

                        @if(!$legalDocument->is_permanent && $legalDocument->expiry_date)
                            <div class="mb-3">
                                <label class="font-bold text-sm">Sisa Waktu:</label>
                                <div class="{{ $legalDocument->getExpiryColorClass() }}">
                                    @php
                                        $days = $legalDocument->getDaysUntilExpiry();
                                    @endphp
                                    @if($days < 0)
                                        <strong>Kadaluarsa {{ abs($days) }} hari yang lalu</strong>
                                    @else
                                        <strong>{{ $days }} hari lagi</strong>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="font-bold text-sm">Reminder:</label>
                                <div>{{ $legalDocument->reminder_days }} hari sebelum kadaluarsa</div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="font-bold text-sm">Status:</label>
                            <div>
                                <span class="px-2 py-1 text-sm win-border {{ $legalDocument->getStatusBadgeColor() }}">
                                    {{ $legalDocument->getStatusLabel() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($legalDocument->notes)
                    <div class="mb-3 mt-4">
                        <label class="font-bold text-sm">Catatan:</label>
                        <div class="p-2 bg-gray-50 border border-gray-300 mt-1">{{ $legalDocument->notes }}</div>
                    </div>
                @endif

                @if($legalDocument->file_path)
                    <div class="mt-4 p-3 bg-blue-50 border-2 border-blue-300">
                        <label class="font-bold text-sm">File Dokumen:</label>
                        <div class="mt-1">
                            <a href="{{ asset('storage/' . $legalDocument->file_path) }}" 
                               target="_blank" 
                               class="text-blue-700 hover:underline font-bold text-lg">
                                📎 {{ basename($legalDocument->file_path) }}
                            </a>
                        </div>
                        <div class="mt-2 text-xs text-gray-600">
                            Lokasi: {{ $legalDocument->file_path }}
                        </div>
                    </div>
                @endif

                <div class="mt-4 p-2 bg-gray-100 border border-gray-300 text-xs">
                    <strong>Dibuat:</strong> {{ $legalDocument->created_at->format('d/m/Y H:i') }} | 
                    <strong>Terakhir diubah:</strong> {{ $legalDocument->updated_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>

    </div>
@endsection
