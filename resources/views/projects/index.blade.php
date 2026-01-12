@extends('layouts.dashboard')

@section('title', 'Projects')

@section('content')
    <div class="h-full flex flex-col">

        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">🚀 Projects</h2>
            <a href="{{ route('projects.create') }}" class="bg-green-700 text-white px-3 py-1 win-border hover:bg-green-600">
                ➕ Tambah Project
            </a>
        </div>

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900 sticky top-0">
                    <tr>
                        <th class="border px-2 py-1 text-center w-10">#</th>
                        <th class="border px-2 py-1 text-left">Project Name</th>
                        <th class="border px-2 py-1 text-left">Client</th>
                        <th class="border px-2 py-1 text-left">Service</th>
                        <th class="border px-2 py-1 text-center">Status</th>
                        <th class="border px-2 py-1 text-right">Value (IDR)</th>
                        <th class="border px-2 py-1 text-center">Timeline</th>
                        <th class="border px-2 py-1 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $i => $item)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                            <td class="border px-2 py-1 font-bold">{{ $item->name }}</td>
                            <td class="border px-2 py-1">{{ $item->client->company_name ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->service->name ?? '-' }}</td>
                            <td class="border px-2 py-1 text-center">
                                @php
                                    $statusColors = [
                                        'planning' => 'bg-gray-200 text-gray-800',
                                        'running' => 'bg-blue-200 text-blue-800',
                                        'done' => 'bg-green-200 text-green-800',
                                        'cancel' => 'bg-red-200 text-red-800',
                                    ];
                                    $color = $statusColors[$item->status] ?? 'bg-gray-100';
                                @endphp
                                <span class="px-2 py-0.5 rounded text-xs border border-gray-400 {{ $color }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="border px-2 py-1 text-right font-mono">
                                {{ number_format($item->value, 0, ',', '.') }}
                            </td>
                            <td class="border px-2 py-1 text-center text-xs text-gray-600">
                                <div>{{ $item->start_date ? date('d M Y', strtotime($item->start_date)) : '-' }}</div>
                                <div>s/d</div>
                                <div>{{ $item->end_date ? date('d M Y', strtotime($item->end_date)) : '-' }}</div>
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('projects.edit', $item->id) }}"
                                    class="text-blue-700 hover:text-blue-900 mr-2" title="Edit">✏️</a>

                                <form action="{{ route('projects.destroy', $item->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus project ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 hover:text-red-900" title="Hapus">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($projects->count() === 0)
                        <tr>
                            <td colspan="8" class="border px-2 py-8 text-center text-gray-500 italic">
                                Belum ada project. Silakan buat baru.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
