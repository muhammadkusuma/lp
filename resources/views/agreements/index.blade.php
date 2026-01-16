@extends('layouts.dashboard')

@section('title', 'Manajemen Perjanjian')

@section('content')
    <div class="h-full flex flex-col">

    {{-- Info Box --}}
    <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
        <h4 class="font-bold mb-1">ℹ️ Dokumen Perjanjian</h4>
        <p>Kelola arsip dokumen perjanjian legal seperti PKWT, Freelance, atau Kemitraan beserta versi perubahannya.</p>
    </div>

    <div class="flex items-end justify-between mb-4">
        {{-- Filters --}}
        <form method="GET" action="{{ route('agreements.index') }}" class="flex gap-2 items-end">
            <div>
                <label class="block text-xs font-bold mb-1">Jenis</label>
                <select name="type" class="border-2 border-gray-400 px-2 py-1 text-sm bg-white">
                    <option value="">Semua Jenis</option>
                    <option value="non_profit" {{ request('type') == 'non_profit' ? 'selected' : '' }}>Non-Profit / Kemitraan</option>
                    <option value="freelancer" {{ request('type') == 'freelancer' ? 'selected' : '' }}>Freelancer</option>
                    <option value="pkwt" {{ request('type') == 'pkwt' ? 'selected' : '' }}>PKWT</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold mb-1">Status</label>
                <select name="status" class="border-2 border-gray-400 px-2 py-1 text-sm bg-white">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Berakhir</option>
                    <option value="extended" {{ request('status') == 'extended' ? 'selected' : '' }}>Diperpanjang</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-700 text-white px-3 py-1 win-border text-sm mb-[2px]">
                🔍 Filter
            </button>
            @if(request('type') || request('status'))
                <a href="{{ route('agreements.index') }}" class="bg-gray-400 text-white px-3 py-1 win-border text-sm mb-[2px]">
                    ❌ Reset
                </a>
            @endif
        </form>

        <a href="{{ route('agreements.create') }}" class="bg-green-700 text-white px-3 py-1 win-border mb-[2px]">
            ➕ Tambah Perjanjian
        </a>
    </div>

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900">
                    <tr>
                        <th class="border px-2 py-1 w-12">#</th>
                        <th class="border px-2 py-1">No. Perjanjian</th>
                        <th class="border px-2 py-1">Judul</th>
                        <th class="border px-2 py-1">Jenis</th>
                        <th class="border px-2 py-1">Pihak</th>
                        <th class="border px-2 py-1">Periode</th>
                        <th class="border px-2 py-1">Status</th>
                        <th class="border px-2 py-1">Versi</th>
                        <th class="border px-2 py-1 w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agreements as $i => $agreement)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                            <td class="border px-2 py-1 font-bold">{{ $agreement->agreement_number }}</td>
                            <td class="border px-2 py-1">{{ $agreement->title }}</td>
                            <td class="border px-2 py-1">
                                <span class="px-2 py-0.5 text-xs win-border bg-blue-100">
                                    {{ $agreement->getTypeLabel() }}
                                </span>
                            </td>
                            <td class="border px-2 py-1">{{ $agreement->party_name }}</td>
                            <td class="border px-2 py-1 text-xs">
                                {{ $agreement->start_date->format('d/m/Y') }}
                                @if($agreement->end_date)
                                    <br>s/d {{ $agreement->end_date->format('d/m/Y') }}
                                @endif
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <span class="px-2 py-0.5 text-xs win-border {{ $agreement->getStatusBadgeColor() }}">
                                    {{ $agreement->getStatusLabel() }}
                                </span>
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <span class="font-bold">v{{ $agreement->current_version }}</span>
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('agreements.show', $agreement) }}" class="text-blue-700" title="Detail">👁️</a>
                                <a href="{{ route('agreements.edit', $agreement) }}" class="text-blue-700 ml-2" title="Edit">✏️</a>

                                <form action="{{ route('agreements.destroy', $agreement) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus perjanjian ini dan semua versinya?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 ml-2" title="Hapus">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($agreements->count() === 0)
                        <tr>
                            <td colspan="9" class="border px-2 py-3 text-center text-gray-500">
                                Belum ada perjanjian
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
