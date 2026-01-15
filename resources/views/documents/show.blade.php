@extends('layouts.dashboard')

@section('title', 'Detail Dokumen')

@section('content')
    <div class="h-full flex flex-col">

        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">📄 Detail Dokumen</h2>
            <div class="flex gap-2">
                <a href="{{ route('documents.edit', $document) }}" class="bg-blue-700 text-white px-3 py-1 win-border">
                    ✏️ Edit
                </a>
                <form action="{{ route('documents.destroy', $document) }}" method="POST" class="inline"
                    onsubmit="return confirm('Hapus dokumen ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-700 text-white px-3 py-1 win-border">🗑️ Hapus</button>
                </form>
                <a href="{{ route('documents.index') }}" class="bg-gray-400 text-white px-3 py-1 win-border">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="overflow-auto">
            <div class="win-border bg-white p-4">
                <h3 class="font-bold text-lg mb-3 border-b-2 border-blue-900 pb-1">Informasi Dokumen</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div class="mb-3">
                            <label class="font-bold text-sm">Nomor Dokumen:</label>
                            <div class="text-lg font-bold text-blue-900">{{ $document->document_number }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Arah:</label>
                            <div>
                                <span class="px-2 py-1 text-sm win-border {{ $document->getDirectionBadgeColor() }}">
                                    {{ $document->getDirectionLabel() }}
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Judul:</label>
                            <div>{{ $document->title }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Klasifikasi:</label>
                            <div>
                                <span class="px-2 py-1 text-sm win-border bg-purple-100">
                                    {{ $document->getClassificationLabel() }}
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="font-bold text-sm">Status:</label>
                            <div>
                                <span class="px-2 py-1 text-sm win-border {{ $document->getStatusBadgeColor() }}">
                                    {{ $document->getStatusLabel() }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        @if($document->direction === 'incoming')
                            <div class="mb-3">
                                <label class="font-bold text-sm">Pengirim:</label>
                                <div>{{ $document->sender }}</div>
                            </div>
                        @else
                            <div class="mb-3">
                                <label class="font-bold text-sm">Penerima:</label>
                                <div>{{ $document->recipient }}</div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="font-bold text-sm">Tanggal Dokumen:</label>
                            <div>{{ $document->document_date->format('d/m/Y') }}</div>
                        </div>

                        @if($document->direction === 'incoming' && $document->received_date)
                            <div class="mb-3">
                                <label class="font-bold text-sm">Tanggal Diterima:</label>
                                <div>{{ $document->received_date->format('d/m/Y') }}</div>
                            </div>
                        @endif

                        @if($document->direction === 'outgoing' && $document->sent_date)
                            <div class="mb-3">
                                <label class="font-bold text-sm">Tanggal Dikirim:</label>
                                <div>{{ $document->sent_date->format('d/m/Y') }}</div>
                            </div>
                        @endif

                        @if($document->keywords)
                            <div class="mb-3">
                                <label class="font-bold text-sm">Kata Kunci:</label>
                                <div class="text-sm">
                                    @foreach(explode(',', $document->keywords) as $keyword)
                                        <span class="inline-block px-2 py-0.5 bg-gray-200 border border-gray-400 mr-1 mb-1">
                                            {{ trim($keyword) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if($document->description)
                    <div class="mb-3 mt-4">
                        <label class="font-bold text-sm">Deskripsi:</label>
                        <div class="p-2 bg-gray-50 border border-gray-300 mt-1">{{ $document->description }}</div>
                    </div>
                @endif

                @if($document->file_path)
                    <div class="mt-4 p-3 bg-blue-50 border-2 border-blue-300">
                        <label class="font-bold text-sm">File Dokumen:</label>
                        <div class="mt-1">
                            <a href="{{ asset('storage/' . $document->file_path) }}" 
                               target="_blank" 
                               class="text-blue-700 hover:underline font-bold text-lg">
                                📎 {{ basename($document->file_path) }}
                            </a>
                        </div>
                        <div class="mt-2 text-xs text-gray-600">
                            Lokasi: {{ $document->file_path }}
                        </div>
                    </div>
                @endif

                <div class="mt-4 p-2 bg-gray-100 border border-gray-300 text-xs">
                    <strong>Dibuat:</strong> {{ $document->created_at->format('d/m/Y H:i') }} | 
                    <strong>Terakhir diubah:</strong> {{ $document->updated_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>

    </div>
@endsection
