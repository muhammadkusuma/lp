@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')
    <div class="h-full flex flex-col">

        <h2 class="font-bold text-blue-900 mb-3">✏️ Edit User</h2>

        <form method="POST" action="{{ route('users.update', $user) }}" class="grid grid-cols-2 gap-4 text-sm bg-white p-4 win-border">
            @csrf
            @method('PUT')

            <div>
                <label class="font-bold block mb-1">Nama <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                    class="w-full border px-2 py-1 win-border focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror">
                @error('name') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="font-bold block mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                    class="w-full border px-2 py-1 win-border focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror">
                @error('email') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="font-bold block mb-1">Password <span class="text-gray-500 font-normal">(Biarkan kosong jika tidak diganti)</span></label>
                <input type="password" name="password" 
                    class="w-full border px-2 py-1 win-border focus:outline-none focus:border-blue-500 @error('password') border-red-500 @enderror">
                @error('password') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="font-bold block mb-1">Role <span class="text-red-500">*</span></label>
                <select name="role_id" class="w-full border px-2 py-1 win-border focus:outline-none focus:border-blue-500 @error('role_id') border-red-500 @enderror">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="font-bold block mb-1">Status <span class="text-red-500">*</span></label>
                <select name="status" class="w-full border px-2 py-1 win-border focus:outline-none focus:border-blue-500 @error('status') border-red-500 @enderror">
                    <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="col-span-2 mt-4 flex gap-2">
                <button type="submit" class="bg-blue-700 text-white px-4 py-1 win-border hover:bg-blue-600 transition">
                    💾 Update
                </button>
                <a href="{{ route('users.index') }}" class="px-4 py-1 win-border bg-gray-200 hover:bg-gray-300 transition">
                    ↩️ Batal
                </a>
            </div>

        </form>
    </div>
@endsection