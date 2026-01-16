@extends('layouts.dashboard')

@section('title', 'Dokumen Legal & Kepatuhan')

@section('content')
    <div class="h-full flex flex-col">

    {{-- Info Box --}}
    <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
        <h4 class="font-bold mb-1">ℹ️ Dokumen Legalitas</h4>
        <p>Pantau masa berlaku dokumen penting perusahaan seperti SIUP, TDP, Akta, dll. Sistem akan memberikan notifikasi jika dokumen mendekati kadaluarsa.</p>
    </div>

    {{-- Alert Section --}}
    @if($expiredCount > 0 || $expiringCount > 0)
        <div class="mb-4">
            @if($expiredCount > 0)
                <div class="p-3 bg-red-100 border-2 border-red-500 mb-2">
                    <div class="flex items-center">
                        <span class="text-2xl mr-2">⚠️</span>
                        <div>
                            <strong class="text-red-900">PERHATIAN!</strong>
                            <span class="text-red-800">Ada {{ $expiredCount }} dokumen yang sudah kadaluarsa dan perlu diperpanjang segera!</span>
                        </div>
                    </div>
                </div>
            @endif

            @if($expiringCount > 0)
                <div class="p-3 bg-yellow-100 border-2 border-yellow-500">
                    <div class="flex items-center">
                        <span class="text-2xl mr-2">⏰</span>
                        <div>
                            <strong class="text-yellow-900">REMINDER:</strong>
                            <span class="text-yellow-800">Ada {{ $expiringCount }} dokumen yang akan segera kadaluarsa. Segera rencanakan perpanjangan!</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <div class="flex items-end justify-between mb-4">
        {{-- Filters --}}
        <form method="GET" action="{{ route('legal-documents.index') }}" class="flex gap-2 items-end">
            <div>
                <label class="block text-xs font-bold mb-1">Jenis Dokumen</label>
                <select name="document_type" class="border-2 border-gray-400 px-2 py-1 text-sm bg-white">
                    <option value="">Semua Jenis</option>
                    <option value="akta_pendirian" {{ request('document_type') == 'akta_pendirian' ? 'selected' : '' }}>Akta Pendirian</option>
                    <option value="sk_kemenkumham" {{ request('document_type') == 'sk_kemenkumham' ? 'selected' : '' }}>SK Kemenkumham</option>
                    <option value="npwp" {{ request('document_type') == 'npwp' ? 'selected' : '' }}>NPWP</option>
                    <option value="nib" {{ request('document_type') == 'nib' ? 'selected' : '' }}>NIB</option>
                    <option value="siup" {{ request('document_type') == 'siup' ? 'selected' : '' }}>SIUP</option>
                    <option value="tdp" {{ request('document_type') == 'tdp' ? 'selected' : '' }}>TDP</option>
                    <option value="other" {{ request('document_type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold mb-1">Status</label>
                <select name="status" class="border-2 border-gray-400 px-2 py-1 text-sm bg-white">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="pending_renewal" {{ request('status') == 'pending_renewal' ? 'selected' : '' }}>Perlu Diperpanjang</option>
                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Kadaluarsa</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-700 text-white px-3 py-1 win-border text-sm mb-[2px]">
                🔍 Filter
            </button>
            @if(request('document_type') || request('status'))
                <a href="{{ route('legal-documents.index') }}" class="bg-gray-400 text-white px-3 py-1 win-border text-sm mb-[2px]">
                    ❌ Reset
                </a>
            @endif
        </form>

        <a href="{{ route('legal-documents.create') }}" class="bg-green-700 text-white px-3 py-1 win-border mb-[2px]">
            ➕ Tambah Dokumen
        </a>
    </div>

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900">
                    <tr>
                        <th class="border px-2 py-1 w-12">#</th>
                        <th class="border px-2 py-1">Jenis</th>
                        <th class="border px-2 py-1">No. Dokumen</th>
                        <th class="border px-2 py-1">Nama Dokumen</th>
                        <th class="border px-2 py-1">Penerbit</th>
                        <th class="border px-2 py-1">Tgl Terbit</th>
                        <th class="border px-2 py-1">Tgl Kadaluarsa</th>
                        <th class="border px-2 py-1">Sisa Hari</th>
                        <th class="border px-2 py-1">Status</th>
                        <th class="border px-2 py-1 w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $i => $doc)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                            <td class="border px-2 py-1 text-center">
                                <span class="px-2 py-0.5 text-xs win-border bg-purple-100">
                                    {{ $doc->getDocumentTypeLabel() }}
                                </span>
                            </td>
                            <td class="border px-2 py-1 font-bold text-xs">{{ $doc->document_number }}</td>
                            <td class="border px-2 py-1">{{ $doc->document_name }}</td>
                            <td class="border px-2 py-1">{{ $doc->issuer }}</td>
                            <td class="border px-2 py-1 text-xs text-center">
                                {{ $doc->issue_date->format('d/m/Y') }}
                            </td>
                            <td class="border px-2 py-1 text-xs text-center {{ $doc->getExpiryColorClass() }}">
                                @if($doc->is_permanent)
                                    <strong>PERMANEN</strong>
                                @elseif($doc->expiry_date)
                                    {{ $doc->expiry_date->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="border px-2 py-1 text-center {{ $doc->getExpiryColorClass() }}">
                                @if($doc->is_permanent)
                                    ∞
                                @elseif($doc->getDaysUntilExpiry() !== null)
                                    @php
                                        $days = $doc->getDaysUntilExpiry();
                                    @endphp
                                    @if($days < 0)
                                        <strong>{{ abs($days) }} hari lalu</strong>
                                    @else
                                        <strong>{{ $days }} hari</strong>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <span class="px-2 py-0.5 text-xs win-border {{ $doc->getStatusBadgeColor() }}">
                                    {{ $doc->getStatusLabel() }}
                                </span>
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('legal-documents.show', $doc) }}" class="text-blue-700" title="Detail">👁️</a>
                                <a href="{{ route('legal-documents.edit', $doc) }}" class="text-blue-700 ml-2" title="Edit">✏️</a>

                                <form action="{{ route('legal-documents.destroy', $doc) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus dokumen legal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 ml-2" title="Hapus">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($documents->count() === 0)
                        <tr>
                            <td colspan="10" class="border px-2 py-3 text-center text-gray-500">
                                Belum ada dokumen legal
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
