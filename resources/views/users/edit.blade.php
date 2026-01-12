@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')
    <div class="h-full flex flex-col">

        <h2 class="font-bold text-blue-900 mb-3">✏️ Edit User</h2>

        <form method="POST" action="{{ route('users.update', $user) }}" class="grid grid-cols-2 gap-4 text-sm">
            @csrf
            @method('PUT')

            <div>
                <label class="font-bold">Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Password (opsional)</label>
                <input type="password" name="password" class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Role</label>
                <select name="role_id" class="w-full border px-2 py-1 win-border">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-bold">Status</label>
                <select name="status" class="w-full border px-2 py-1 win-border">
                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="col-span-2 mt-2">
                <button class="bg-blue-700 text-white px-4 py-1 win-border">
                    💾 Update
                </button>
                <a href="{{ route('users.index') }}" class="ml-2 px-4 py-1 win-border bg-gray-200">
                    ↩️ Batal
                </a>
            </div>

        </form>
    </div>
@endsection
