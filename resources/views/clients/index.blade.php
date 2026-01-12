@extends('layouts.dashboard')

@section('title', 'Clients')

@section('content')

    <div class="win-box h-full">
        <div class="win-titlebar flex justify-between">
            <span>👥 Clients</span>
            <a href="{{ route('clients.create') }}" class="win-btn">➕ Add</a>
        </div>

        <div class="p-3 text-sm">
            <table class="w-full border win-border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border p-1">Name</th>
                        <th class="border p-1">Company</th>
                        <th class="border p-1">Email</th>
                        <th class="border p-1">Phone</th>
                        <th class="border p-1 w-32">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td class="border p-1">{{ $client->name }}</td>
                            <td class="border p-1">{{ $client->company_name }}</td>
                            <td class="border p-1">{{ $client->email }}</td>
                            <td class="border p-1">{{ $client->phone }}</td>
                            <td class="border p-1 text-center">
                                <a href="{{ route('clients.edit', $client) }}" class="text-blue-700">✏️</a>
                                <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus client?')" class="text-red-700">🗑</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
