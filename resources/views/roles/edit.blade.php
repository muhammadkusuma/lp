@extends('layouts.dashboard')

@section('title', 'Edit Role')

@section('content')
    <div class="h-full flex flex-col">

        <h2 class="font-bold text-blue-900 mb-3">✏️ Edit Role</h2>

        {{-- Info Box --}}
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-900 px-4 py-3 mb-4 text-sm">
            <p class="font-bold mb-1">⚠️ Edit Role</p>
            <p>Mengubah nama role akan mempengaruhi tampilan role pada user yang terkait.</p>
        </div>

        <form method="POST" action="{{ route('roles.update', $role) }}" class="grid grid-cols-1 gap-4 text-sm">
            @csrf
            @method('PUT')

            <div>
                <label class="font-bold">Nama Role</label>
                <input type="text" name="name" value="{{ $role->name }}" class="w-full border px-2 py-1 win-border">
            </div>

            <div class="mt-2">
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