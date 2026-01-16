@extends('layouts.dashboard')

@section('title', 'Manajemen Dokumen')

@section('content')
    <div class="h-full flex flex-col">

    {{-- Info Box --}}
    <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
        <h4 class="font-bold mb-1">ℹ️ Arsip Dokumen</h4>
        <p>Kelola surat masuk, surat keluar, dan dokumen penting lainnya di sini. Gunakan filter pencarian untuk menemukan dokumen dengan cepat.</p>
    </div>

    <div class="flex items-center justify-between mb-4">
        <div class="flex gap-2">
            {{-- Search / Filter Placeholder (Filters are below) --}}
        </div>

        <a href="{{ route('documents.create') }}" class="bg-green-700 text-white px-3 py-1 win-border">
            ➕ Tambah Dokumen
        </a>
    </div>

        {{-- Advanced Search/Filter --}}
        <div class="mb-3 p-3 bg-gray-100 win-border">
            <form method="GET" action="{{ route('documents.index') }}">
                <div class="grid grid-cols-3 gap-2 mb-2">
                    <div>
                        <label class="block text-xs font-bold mb-1">Kata Kunci</label>
                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 text-sm"
                            placeholder="Cari nomor, judul, deskripsi...">
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Arah Dokumen</label>
                        <select name="direction" class="w-full border-2 border-gray-400 px-2 py-1 text-sm">
                            <option value="">Semua</option>
                            <option value="incoming" {{ request('direction') == 'incoming' ? 'selected' : '' }}>Dokumen Masuk</option>
                            <option value="outgoing" {{ request('direction') == 'outgoing' ? 'selected' : '' }}>Dokumen Keluar</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Klasifikasi</label>
                        <select name="classification" class="w-full border-2 border-gray-400 px-2 py-1 text-sm">
                            <option value="">Semua</option>
                            <option value="legal" {{ request('classification') == 'legal' ? 'selected' : '' }}>Legal</option>
                            <option value="keuangan" {{ request('classification') == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                            <option value="operasional" {{ request('classification') == 'operasional' ? 'selected' : '' }}>Operasional</option>
                            <option value="sdm" {{ request('classification') == 'sdm' ? 'selected' : '' }}>SDM</option>
                            <option value="umum" {{ request('classification') == 'umum' ? 'selected' : '' }}>Umum</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-2">
                    <div>
                        <label class="block text-xs font-bold mb-1">Status</label>
                        <select name="status" class="w-full border-2 border-gray-400 px-2 py-1 text-sm">
                            <option value="">Semua</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Diproses</option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Diarsipkan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Tanggal Dari</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Tanggal Sampai</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                            class="w-full border-2 border-gray-400 px-2 py-1 text-sm">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="bg-blue-700 text-white px-3 py-1 win-border text-sm">
                            🔍 Cari
                        </button>
                        @if(request()->hasAny(['keyword', 'direction', 'classification', 'status', 'date_from', 'date_to']))
                            <a href="{{ route('documents.index') }}" class="bg-gray-400 text-white px-3 py-1 win-border text-sm">
                                ❌ Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900">
                    <tr>
                        <th class="border px-2 py-1 w-12">#</th>
                        <th class="border px-2 py-1">No. Dokumen</th>
                        <th class="border px-2 py-1">Arah</th>
                        <th class="border px-2 py-1">Judul</th>
                        <th class="border px-2 py-1">Klasifikasi</th>
                        <th class="border px-2 py-1">Pengirim/Penerima</th>
                        <th class="border px-2 py-1">Tgl Dokumen</th>
                        <th class="border px-2 py-1">Status</th>
                        <th class="border px-2 py-1 w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $i => $doc)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                            <td class="border px-2 py-1 font-bold text-xs">{{ $doc->document_number }}</td>
                            <td class="border px-2 py-1 text-center">
                                <span class="px-2 py-0.5 text-xs win-border {{ $doc->getDirectionBadgeColor() }}">
                                    {{ $doc->direction === 'incoming' ? '📥 Masuk' : '📤 Keluar' }}
                                </span>
                            </td>
                            <td class="border px-2 py-1">{{ $doc->title }}</td>
                            <td class="border px-2 py-1 text-center">
                                <span class="px-2 py-0.5 text-xs win-border bg-purple-100">
                                    {{ $doc->getClassificationLabel() }}
                                </span>
                            </td>
                            <td class="border px-2 py-1">
                                {{ $doc->direction === 'incoming' ? $doc->sender : $doc->recipient }}
                            </td>
                            <td class="border px-2 py-1 text-xs text-center">
                                {{ $doc->document_date->format('d/m/Y') }}
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <span class="px-2 py-0.5 text-xs win-border {{ $doc->getStatusBadgeColor() }}">
                                    {{ $doc->getStatusLabel() }}
                                </span>
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('documents.show', $doc) }}" class="text-blue-700" title="Detail">👁️</a>
                                <a href="{{ route('documents.edit', $doc) }}" class="text-blue-700 ml-2" title="Edit">✏️</a>

                                <form action="{{ route('documents.destroy', $doc) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus dokumen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 ml-2" title="Hapus">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($documents->count() === 0)
                        <tr>
                            <td colspan="9" class="border px-2 py-3 text-center text-gray-500">
                                @if(request()->hasAny(['keyword', 'direction', 'classification', 'status', 'date_from', 'date_to']))
                                    Tidak ada dokumen yang sesuai dengan kriteria pencarian
                                @else
                                    Belum ada dokumen
                                @endif
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
