@extends('layouts.dashboard')

@section('title', 'Users & Roles')

@section('content')
    <div class="h-full flex flex-col">

        {{-- Info Box --}}
        <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
            <h4 class="font-bold mb-1">ℹ️ Manajemen Pengguna</h4>
            <p>Halaman ini menampilkan daftar pengguna yang memiliki akses login ke sistem ini.</p>
        </div>

        <div class="flex items-center justify-between mb-4">
            <div class="flex gap-2">
                {{-- Search / Filter Placeholder --}}
            </div>

            <a href="{{ route('users.create') }}" class="bg-green-700 text-white px-3 py-1 win-border hover:bg-green-600 transition">
                ➕ Tambah User
            </a>
        </div>

        <div class="flex-1 overflow-auto win-border bg-white p-2">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900 sticky top-0">
                    <tr>
                        <th class="border px-2 py-1 text-left">Nama</th>
                        <th class="border px-2 py-1 text-left">Email</th>
                        <th class="border px-2 py-1 text-left">Role</th>
                        <th class="border px-2 py-1 text-center">Status</th>
                        <th class="border px-2 py-1 w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="hover:bg-blue-50">
                            <td class="border px-2 py-1">{{ $user->name }}</td>
                            <td class="border px-2 py-1">{{ $user->email }}</td>
                            <td class="border px-2 py-1">{{ $user->role->name ?? '-' }}</td>
                            <td class="border px-2 py-1 text-center">
                                <span class="px-2 py-0.5 text-xs rounded-full border 
                                    {{ $user->status === 'active' ? 'bg-green-100 text-green-800 border-green-200' : 'bg-red-100 text-red-800 border-red-200' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('users.edit', $user) }}" class="text-blue-700 hover:text-blue-900 mx-1" title="Edit">✏️</a>

                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 hover:text-red-900 mx-1" title="Hapus">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border px-2 py-4 text-center text-gray-500">Belum ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection