@extends('layouts.dashboard')

@section('title', 'Edit Role')

@section('content')
    <div class="h-full flex flex-col">

        <h2 class="font-bold text-blue-900 mb-3">✏️ Edit Role</h2>

        <form method="POST" action="{{ route('roles.update', $role) }}" class="grid grid-cols-2 gap-4 text-sm">
            @csrf
            @method('PUT')

            <div>
                <label class="font-bold">Nama Role</label>
                <input type="text" name="name" value="{{ $role->name }}" class="w-full border px-2 py-1 win-border">
            </div>

            <div>
                <label class="font-bold">Deskripsi</label>
                <input type="text" name="description" value="{{ $role->description }}"
                    class="w-full border px-2 py-1 win-border">
            </div>

            <div class="col-span-2 mt-2">
                <button class="bg-blue-700 text-white px-4 py-1 win-border">
                    💾 Update
                </button>
                <a href="{{ route('roles.index') }}" class="ml-2 px-4 py-1 win-border bg-gray-200">
                    ↩️ Batal
                </a>
            </div>
        </form>

    </div>
@endsection
