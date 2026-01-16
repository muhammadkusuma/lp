@extends('layouts.dashboard')

@section('title', 'Tambah Project')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-bold text-blue-900 text-lg">➕ Tambah Project Baru</h2>
            <a href="{{ route('projects.index') }}" class="text-sm text-blue-700 underline">← Kembali</a>
        </div>

        {{-- Info Box --}}
        <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
            <p class="font-bold mb-1">ℹ️ Project Baru</p>
            <p>Tambahkan proyek baru dengan memilih Client dan Service yang sesuai. Tentukan juga nilai proyek dan jadwalnya.</p>
        </div>

        <form action="{{ route('projects.store') }}" method="POST" class="bg-white p-4 win-border">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Nama Project --}}
                <div class="col-span-2">
                    <label class="block text-sm font-bold mb-1">Nama Project <span class="text-red-500">*</span></label>
                    <input type="text" name="name"
                        class="w-full border px-2 py-1 focus:outline-none focus:border-blue-500 bg-gray-50" required
                        value="{{ old('name') }}">
                    @error('name')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Client --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Client <span class="text-red-500">*</span></label>
                    <select name="client_id" class="w-full border px-2 py-1 bg-white" required>
                        <option value="">-- Pilih Client --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->company_name }} ({{ $client->contact_name }})
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Service --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Service / Layanan <span
                            class="text-red-500">*</span></label>
                    <select name="service_id" class="w-full border px-2 py-1 bg-white" required>
                        <option value="">-- Pilih Service --</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Status</label>
                    <select name="status" class="w-full border px-2 py-1 bg-white">
                        <option value="planning" {{ old('status') == 'planning' ? 'selected' : '' }}>Planning</option>
                        <option value="running" {{ old('status') == 'running' ? 'selected' : '' }}>Running</option>
                        <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
                        <option value="cancel" {{ old('status') == 'cancel' ? 'selected' : '' }}>Cancel</option>
                    </select>
                </div>

                {{-- Value --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Nilai Project (IDR)</label>
                    <input type="number" name="value" class="w-full border px-2 py-1 bg-gray-50" placeholder="0"
                        value="{{ old('value') }}">
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="w-full border px-2 py-1 bg-gray-50"
                        value="{{ old('start_date') }}">
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">Tanggal Selesai</label>
                    <input type="date" name="end_date" class="w-full border px-2 py-1 bg-gray-50"
                        value="{{ old('end_date') }}">
                </div>

            </div>

            <div class="mt-5 border-t pt-3 flex justify-end gap-2">
                <a href="{{ route('projects.index') }}"
                    class="bg-gray-500 text-white px-4 py-1 win-border hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-blue-700 text-white px-4 py-1 win-border hover:bg-blue-600">💾
                    Simpan</button>
            </div>
        </form>
    </div>
@endsection
