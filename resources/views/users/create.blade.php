@extends('layouts.dashboard')

@section('title', 'Tambah User')

@section('content')
    <div class="h-full flex flex-col">

        <h2 class="font-bold text-blue-900 mb-3">➕ Tambah User</h2>

        <form method="POST" action="{{ route('users.store') }}" class="grid grid-cols-2 gap-4 text-sm">
            @csrf

            <div>
                <label class="font-bold">Nama</label>
                <input type="text" name="name" class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Email</label>
                <input type="email" name="email" class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Password</label>
                <input type="password" name="password" class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Role</label>
                <select name="role_id" class="w-full border px-2 py-1 win-border">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-2 mt-2">
                <button class="bg-blue-700 text-white px-4 py-1 win-border">
                    💾 Simpan
                </button>
                <a href="{{ route('users.index') }}" class="ml-2 px-4 py-1 win-border bg-gray-200">
                    ↩️ Batal
                </a>
            </div>

        </form>
    </div>
@endsection
