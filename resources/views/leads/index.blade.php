@extends('layouts.dashboard')

@section('title', 'Leads')

@section('content')
    <div class="h-full flex flex-col">

        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">🎯 Leads</h2>

            <a href="{{ route('leads.create') }}" class="bg-green-700 text-white px-3 py-1 win-border">
                ➕ Tambah Lead
            </a>
        </div>

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900">
                    <tr>
                        <th class="border px-2 py-1 w-12">#</th>
                        <th class="border px-2 py-1">Nama</th>
                        <th class="border px-2 py-1">Email</th>
                        <th class="border px-2 py-1">Source</th>
                        <th class="border px-2 py-1 text-center">Status</th>
                        <th class="border px-2 py-1 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leads as $i => $lead)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                            <td class="border px-2 py-1 font-bold">{{ $lead->name }}</td>
                            <td class="border px-2 py-1">{{ $lead->email }}</td>
                            <td class="border px-2 py-1">{{ $lead->source }}</td>
                            <td class="border px-2 py-1 text-center">
                                <span class="px-2 py-0.5 rounded text-xs border border-gray-400 bg-gray-100">
                                    {{ $lead->status }}
                                </span>
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('leads.edit', $lead) }}" class="text-blue-700">✏️</a>

                                <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus lead ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 ml-2">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($leads->count() === 0)
                        <tr>
                            <td colspan="6" class="border px-2 py-3 text-center text-gray-500">
                                Belum ada data leads
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
