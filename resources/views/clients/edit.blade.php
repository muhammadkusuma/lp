@extends('layouts.dashboard')

@section('title', 'Edit Client')

@section('content')
    <div class="h-full flex flex-col">

        <h2 class="font-bold text-blue-900 mb-3">✏️ Edit Client</h2>

        <form method="POST" action="{{ route('clients.update', $client) }}"
            class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            @csrf
            @method('PUT')

            <div>
                <label class="font-bold">Contact Name</label>
                <input type="text" name="contact_name" value="{{ $client->contact_name }}"
                    class="w-full border px-2 py-1 win-border" required>
            </div>

            <div>
                <label class="font-bold">Company Name</label>
                <input type="text" name="company_name" value="{{ $client->company_name }}"
                    class="w-full border px-2 py-1 win-border" required>
            </div>

            <div>
                <label class="font-bold">Email</label>
                <input type="email" name="email" value="{{ $client->email }}" class="w-full border px-2 py-1 win-border"
                    required>
            </div>

            <div>
                <label class="font-bold">Phone</label>
                <input type="text" name="phone" value="{{ $client->phone }}"
                    class="w-full border px-2 py-1 win-border">
            </div>

            <div class="md:col-span-2">
                <label class="font-bold">Address</label>
                <textarea name="address" rows="3" class="w-full border px-2 py-1 win-border">{{ $client->address }}</textarea>
            </div>

            <div class="mt-2 md:col-span-2">
                <button class="bg-blue-700 text-white px-4 py-1 win-border">
                    💾 Update
                </button>
                <a href="{{ route('clients.index') }}" class="ml-2 px-4 py-1 win-border bg-gray-200">
                    ↩️ Batal
                </a>
            </div>
        </form>

    </div>
@endsection
