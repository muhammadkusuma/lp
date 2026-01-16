@extends('layouts.dashboard')

@section('title', 'Template Dokumen')

@section('content')
    <div class="h-full flex flex-col">

        {{-- Info Box --}}
        <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
            <h4 class="font-bold mb-1">ℹ️ Bank Template</h4>
            <p>Simpan template standar perusahaan (kop surat, format kontrak, memo) agar mudah diakses oleh seluruh tim.</p>
        </div>

        <div class="flex items-center justify-between mb-4">
            <div class="flex gap-2">
                {{-- Search / Filter Placeholder --}}
            </div>

            <a href="{{ route('document-templates.create') }}" class="bg-green-700 text-white px-3 py-1 win-border hover:bg-green-600">
                ➕ Tambah Template
            </a>
        </div>

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900">
                    <tr>
                        <th class="border px-2 py-1 w-12">#</th>
                        <th class="border px-2 py-1">Nama Template</th>
                        <th class="border px-2 py-1">Jenis</th>
                        <th class="border px-2 py-1">File</th>
                        <th class="border px-2 py-1">Status</th>
                        <th class="border px-2 py-1 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($templates as $i => $template)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                            <td class="border px-2 py-1 font-bold">{{ $template->name }}</td>
                            <td class="border px-2 py-1">
                                <span class="px-2 py-0.5 text-xs win-border bg-blue-100">
                                    {{ $template->getTypeLabel() }}
                                </span>
                            </td>
                            <td class="border px-2 py-1">
                                @if($template->file_path)
                                    <a href="{{ asset('storage/' . $template->file_path) }}" 
                                       target="_blank" 
                                       class="text-blue-700 hover:underline">
                                        📎 {{ basename($template->file_path) }}
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <span
                                    class="px-2 py-0.5 text-xs win-border
                            {{ $template->status === 'active' ? 'bg-green-200' : 'bg-red-200' }}">
                                    {{ ucfirst($template->status) }}
                                </span>
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('document-templates.edit', $template) }}" class="text-blue-700">✏️</a>

                                <form action="{{ route('document-templates.destroy', $template) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus template ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 ml-2">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($templates->count() === 0)
                        <tr>
                            <td colspan="6" class="border px-2 py-3 text-center text-gray-500">
                                Belum ada template dokumen
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
