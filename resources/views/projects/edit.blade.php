@extends('layouts.dashboard')

@section('title', 'Edit Project')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-bold text-blue-900 text-lg">✏️ Edit Project</h2>
            <a href="{{ route('projects.index') }}" class="text-sm text-blue-700 underline">← Kembali</a>
        </div>

        {{-- Info Box --}}
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-900 px-4 py-3 mb-4 text-sm">
            <p class="font-bold mb-1">⚠️ Edit Data Project</p>
            <p>Anda sedang mengubah detail project. Perubahan status atau nilai project akan tersimpan setelah klik Update.</p>
        </div>

        <form action="{{ route('projects.update', $project->id) }}" method="POST" class="bg-white p-4 win-border">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Nama Project --}}
                <div class="col-span-2">
                    <label class="block text-sm font-bold mb-1">Nama Project <span class="text-red-500">*</span></label>
                    <input type="text" name="name"
                        class="w-full border px-2 py-1 focus:outline-none focus:border-blue-500 bg-gray-50" required
                        value="{{ old('name', $project->name) }}">
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
                            <option value="{{ $client->id }}"
                                {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->company_name }} ({{ $client->contact_name }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Service --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Service / Layanan <span
                            class="text-red-500">*</span></label>
                    <select name="service_id" class="w-full border px-2 py-1 bg-white" required>
                        <option value="">-- Pilih Service --</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}"
                                {{ old('service_id', $project->service_id) == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Status</label>
                    <select name="status" class="w-full border px-2 py-1 bg-white">
                        <option value="planning" {{ old('status', $project->status) == 'planning' ? 'selected' : '' }}>
                            Planning</option>
                        <option value="running" {{ old('status', $project->status) == 'running' ? 'selected' : '' }}>
                            Running</option>
                        <option value="done" {{ old('status', $project->status) == 'done' ? 'selected' : '' }}>Done
                        </option>
                        <option value="cancel" {{ old('status', $project->status) == 'cancel' ? 'selected' : '' }}>Cancel
                        </option>
                    </select>
                </div>

                {{-- Value --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Nilai Project (IDR)</label>
                    <input type="number" name="value" class="w-full border px-2 py-1 bg-gray-50" placeholder="0"
                        value="{{ old('value', $project->value) }}">
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="w-full border px-2 py-1 bg-gray-50"
                        value="{{ old('start_date', $project->start_date) }}">
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">Tanggal Selesai</label>
                    <input type="date" name="end_date" class="w-full border px-2 py-1 bg-gray-50"
                        value="{{ old('end_date', $project->end_date) }}">
                </div>

            </div>

            <div class="mt-5 border-t pt-3 flex justify-end gap-2">
                <a href="{{ route('projects.index') }}"
                    class="bg-gray-500 text-white px-4 py-1 win-border hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-blue-700 text-white px-4 py-1 win-border hover:bg-blue-600">💾 Update
                    Project</button>
            </div>
        </form>
    </div>
@endsection
