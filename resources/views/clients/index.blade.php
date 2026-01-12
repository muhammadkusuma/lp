@extends('layouts.dashboard')

@section('title', 'Clients')

@section('content')
    <div class="h-full flex flex-col">

        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">👥 Clients</h2>

            <a href="{{ route('clients.create') }}" class="bg-green-700 text-white px-3 py-1 win-border">
                ➕ Tambah Client
            </a>
        </div>

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900">
                    <tr>
                        <th class="border px-2 py-1 w-12">#</th>
                        <th class="border px-2 py-1">Contact Name</th>
                        <th class="border px-2 py-1">Company</th>
                        <th class="border px-2 py-1">Email</th>
                        <th class="border px-2 py-1">Phone</th>
                        <th class="border px-2 py-1 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $i => $client)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                            <td class="border px-2 py-1 font-bold">{{ $client->contact_name }}</td>
                            <td class="border px-2 py-1">{{ $client->company_name }}</td>
                            <td class="border px-2 py-1">{{ $client->email }}</td>
                            <td class="border px-2 py-1">{{ $client->phone }}</td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('clients.edit', $client) }}" class="text-blue-700">✏️</a>

                                <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus client ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 ml-2">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($clients->count() === 0)
                        <tr>
                            <td colspan="6" class="border px-2 py-3 text-center text-gray-500">
                                Belum ada client
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
