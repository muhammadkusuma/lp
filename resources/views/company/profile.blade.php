@extends('layouts.dashboard')

@section('title', 'Company Profile')

@section('content')
    <div class="h-full flex flex-col">

        {{-- Header --}}
        <div class="mb-3">
            <h2 class="font-bold text-blue-900">🏢 Company Profile</h2>
            <p class="text-xs text-gray-600">
                Informasi utama perusahaan (landing page, invoice, dokumen legal)
            </p>
        </div>

        {{-- Tampilkan Pesan Sukses/Error --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 mb-3 text-sm rounded border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-2 mb-3 text-sm rounded border border-red-200">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        {{-- PENTING: enctype="multipart/form-data" diperlukan untuk upload file --}}
        <form method="POST" action="{{ route('company.profile.update') }}" enctype="multipart/form-data" class="flex-1 flex flex-col">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm flex-1 overflow-y-auto pr-2">

                {{-- LEFT COLUMN --}}
                <div class="space-y-3">
                    <div>
                        <label class="font-bold block mb-1">Nama Perusahaan <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $company->name ?? '') }}"
                            class="w-full border px-2 py-1 win-border focus:outline-none focus:border-blue-500" required>
                    </div>

                    <div>
                        <label class="font-bold block mb-1">Nama Legal (PT/CV)</label>
                        <input type="text" name="legal_name" value="{{ old('legal_name', $company->legal_name ?? '') }}"
                            class="w-full border px-2 py-1 win-border focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="font-bold block mb-1">Email Resmi</label>
                        <input type="email" name="email" value="{{ old('email', $company->email ?? '') }}"
                            class="w-full border px-2 py-1 win-border focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="font-bold block mb-1">Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $company->phone ?? '') }}"
                            class="w-full border px-2 py-1 win-border focus:outline-none focus:border-blue-500">
                    </div>

                     <div>
                        <label class="font-bold block mb-1">Website</label>
                        <input type="url" name="website" value="{{ old('website', $company->website ?? '') }}"
                            placeholder="https://example.com"
                            class="w-full border px-2 py-1 win-border focus:outline-none focus:border-blue-500">
                    </div>
                </div>

                {{-- RIGHT COLUMN --}}
                <div class="space-y-3">
                    <div>
                        <label class="font-bold block mb-1">Logo Perusahaan</label>
                        
                        @if(isset($company->logo_url))
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $company->logo_url) }}" alt="Logo" class="h-16 w-auto border p-1 bg-gray-50">
                            </div>
                        @endif

                        <input type="file" name="logo" accept="image/*"
                            class="w-full border px-2 py-1 win-border bg-white text-sm">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, SVG (Max 2MB)</p>
                    </div>

                    <div>
                        <label class="font-bold block mb-1">Alamat Lengkap</label>
                        <textarea name="address" rows="3" 
                            class="w-full border px-2 py-1 win-border focus:outline-none focus:border-blue-500">{{ old('address', $company->address ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="font-bold block mb-1">Deskripsi Singkat</label>
                        <textarea name="description" rows="3" 
                            class="w-full border px-2 py-1 win-border focus:outline-none focus:border-blue-500">{{ old('description', $company->description ?? '') }}</textarea>
                    </div>
                </div>

            </div>

            {{-- Footer --}}
            <div class="pt-3 border-t mt-3">
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 win-border flex items-center gap-2">
                    <span>💾</span> Simpan Profile
                </button>
            </div>

        </form>
    </div>
@endsection