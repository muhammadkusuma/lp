@extends('layouts.dashboard')

@section('title', 'Daftar Pengeluaran')

@section('content')
    <div class="h-full flex flex-col">

        {{-- Info Box --}}
        <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
            <h4 class="font-bold mb-1">ℹ️ Manajemen Pengeluaran</h4>
            <p>Catat dan pantau seluruh pengeluaran operasional perusahaan (Gaji, Server, Marketing, dll) di sini.</p>
        </div>

        <div class="flex items-center justify-between mb-4">
            <div class="flex gap-2">
                {{-- Search / Filter Placeholder --}}
                <form method="GET" action="{{ route('expenses.index') }}" class="flex gap-2 items-center">
                   <select name="category" class="border px-2 py-1 text-sm rounded bg-white" onchange="this.form.submit()">
                       <option value="">Semua Kategori</option>
                       <option value="operational" {{ request('category') == 'operational' ? 'selected' : '' }}>Operasional</option>
                       <option value="salary" {{ request('category') == 'salary' ? 'selected' : '' }}>Gaji & Tunjangan</option>
                       <option value="infrastructure" {{ request('category') == 'infrastructure' ? 'selected' : '' }}>Infrastruktur / Server</option>
                       <option value="marketing" {{ request('category') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                       <option value="other" {{ request('category') == 'other' ? 'selected' : '' }}>Lainnya</option>
                   </select>
                </form>
            </div>

            <a href="{{ route('expenses.create') }}" class="bg-red-700 text-white px-3 py-1 win-border hover:bg-red-600">
                ➕ Catat Pengeluaran
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900 sticky top-0">
                    <tr>
                        <th class="border px-2 py-1 w-12 text-center">No</th>
                        <th class="border px-2 py-1 text-left">Tanggal</th>
                        <th class="border px-2 py-1 text-left">Judul Pengeluaran</th>
                        <th class="border px-2 py-1 text-left">Kategori</th>
                        <th class="border px-2 py-1 text-right">Jumlah (RP)</th>
                        <th class="border px-2 py-1 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expenses as $index => $expense)
                        <tr class="hover:bg-red-50">
                            <td class="border px-2 py-1 text-center">{{ $expenses->firstItem() + $index }}</td>
                            <td class="border px-2 py-1 text-center font-mono">
                                {{ $expense->expense_date->format('d/m/Y') }}
                            </td>
                            <td class="border px-2 py-1 font-semibold">
                                {{ $expense->title }}
                                @if($expense->description)
                                    <div class="text-xs text-gray-500 font-normal">{{ Str::limit($expense->description, 50) }}</div>
                                @endif
                            </td>
                            <td class="border px-2 py-1">
                                <span class="px-2 py-0.5 rounded text-xs border border-gray-300 bg-gray-100">
                                    {{ ucfirst($expense->category) }}
                                </span>
                            </td>
                            <td class="border px-2 py-1 text-right font-mono text-red-700 font-bold">
                                Rp {{ number_format($expense->amount, 0, ',', '.') }}
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <div class="flex justify-center gap-1">
                                    <a href="{{ route('expenses.edit', $expense->id) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                        ✏️
                                    </a>
                                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data pengeluaran ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border px-2 py-8 text-center text-gray-500 italic">
                                Belum ada data pengeluaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
             {{ $expenses->links() }}
        </div>
    </div>
@endsection
