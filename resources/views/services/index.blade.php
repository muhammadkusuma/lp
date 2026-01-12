@extends('layouts.dashboard')

@section('title', 'Services')

@section('content')
    <div class="h-full flex flex-col">

        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">🧩 Services</h2>

            <a href="{{ route('services.create') }}" class="bg-green-700 text-white px-3 py-1 win-border">
                ➕ Tambah Service
            </a>
        </div>

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900">
                    <tr>
                        <th class="border px-2 py-1 w-12">#</th>
                        <th class="border px-2 py-1">Nama Service</th>
                        <th class="border px-2 py-1">Harga</th>
                        <th class="border px-2 py-1">Unit</th>
                        <th class="border px-2 py-1">Status</th>
                        <th class="border px-2 py-1 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $i => $service)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                            <td class="border px-2 py-1 font-bold">{{ $service->name }}</td>
                            <td class="border px-2 py-1">
                                {{ $service->price ? 'Rp ' . number_format($service->price, 0, ',', '.') : '-' }}
                            </td>
                            <td class="border px-2 py-1">{{ $service->unit ?? '-' }}</td>
                            <td class="border px-2 py-1 text-center">
                                <span
                                    class="px-2 py-0.5 text-xs win-border
                            {{ $service->is_active ? 'bg-green-200' : 'bg-red-200' }}">
                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('services.edit', $service) }}" class="text-blue-700">✏️</a>

                                <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus service ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 ml-2">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($services->count() === 0)
                        <tr>
                            <td colspan="6" class="border px-2 py-3 text-center text-gray-500">
                                Belum ada service
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
