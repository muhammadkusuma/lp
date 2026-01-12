@extends('layouts.dashboard')

@section('title', 'Users & Roles')

@section('content')
    <div class="h-full flex flex-col">

        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">👥 Users & Roles</h2>
            <a href="{{ route('users.create') }}" class="bg-green-700 text-white px-3 py-1 win-border">
                ➕ Tambah User
            </a>
        </div>

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900">
                    <tr>
                        <th class="border px-2 py-1">Nama</th>
                        <th class="border px-2 py-1">Email</th>
                        <th class="border px-2 py-1">Role</th>
                        <th class="border px-2 py-1">Status</th>
                        <th class="border px-2 py-1 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1">{{ $user->name }}</td>
                            <td class="border px-2 py-1">{{ $user->email }}</td>
                            <td class="border px-2 py-1">{{ $user->role->name ?? '-' }}</td>
                            <td class="border px-2 py-1">
                                <span
                                    class="px-2 py-0.5 text-xs win-border
                            {{ $user->status === 'active' ? 'bg-green-200' : 'bg-red-200' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('users.edit', $user) }}" class="text-blue-700">✏️</a>

                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 ml-2">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
