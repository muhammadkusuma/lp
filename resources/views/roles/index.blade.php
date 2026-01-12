@extends('layouts.dashboard')

@section('title', 'Roles')

@section('content')
    <div class="h-full flex flex-col">

        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">🛡️ Roles</h2>

            <a href="{{ route('roles.create') }}" class="bg-green-700 text-white px-3 py-1 win-border">
                ➕ Tambah Role
            </a>
        </div>

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900">
                    <tr>
                        <th class="border px-2 py-1 w-12">#</th>
                        <th class="border px-2 py-1">Nama Role</th>
                        <th class="border px-2 py-1 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $i => $role)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                            <td class="border px-2 py-1 font-bold">{{ $role->name }}</td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('roles.edit', $role) }}" class="text-blue-700">✏️</a>

                                <form action="{{ route('roles.destroy', $role) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus role ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 ml-2">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($roles->count() === 0)
                        <tr>
                            <td colspan="3" class="border px-2 py-3 text-center text-gray-500">
                                Belum ada role
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection