@extends('layouts.dashboard')

@section('title', 'Edit Lead')

@section('content')
    <div class="max-w-md mx-auto mt-4">
        <div class="win-border bg-white p-4">
            <h2 class="font-bold text-blue-900 mb-4 border-b pb-2">✏️ Edit Lead</h2>

            {{-- Info Box --}}
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-900 px-4 py-3 mb-4 text-sm">
                <p class="font-bold mb-1">⚠️ Update Lead</p>
                <p>Perbarui status atau informasi calon pelanggan di sini.</p>
            </div>

            <form action="{{ route('leads.update', $lead) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="block text-sm font-bold mb-1">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full border p-1 win-border" required
                        value="{{ old('name', $lead->name) }}">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold mb-1">Email</label>
                    <input type="email" name="email" class="w-full border p-1 win-border" required
                        value="{{ old('email', $lead->email) }}">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold mb-1">Sumber (Source)</label>
                    <input type="text" name="source" class="w-full border p-1 win-border" required
                        value="{{ old('source', $lead->source) }}">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Status</label>
                    <select name="status" class="w-full border p-1 win-border bg-white" required>
                        @foreach (['New', 'Contacted', 'Qualified', 'Lost', 'Closed'] as $status)
                            <option value="{{ $status }}" {{ $lead->status == $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('leads.index') }}"
                        class="bg-gray-500 text-white px-3 py-1 win-border text-sm">Kembali</a>
                    <button type="submit" class="bg-blue-700 text-white px-4 py-1 win-border font-bold">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
