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

        {{-- Form --}}
        <form method="POST" action="{{ route('company.profile.update') }}" class="flex-1 flex flex-col">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4 text-sm flex-1">

                {{-- LEFT --}}
                <div class="space-y-3">
                    <div>
                        <label class="font-bold">Nama Perusahaan</label>
                        <input type="text" name="name" value="{{ $company->name ?? '' }}"
                            class="w-full border px-2 py-1 win-border">
                    </div>

                    <div>
                        <label class="font-bold">Nama Legal</label>
                        <input type="text" name="legal_name" value="{{ $company->legal_name ?? '' }}"
                            class="w-full border px-2 py-1 win-border">
                    </div>

                    <div>
                        <label class="font-bold">Email</label>
                        <input type="email" name="email" value="{{ $company->email ?? '' }}"
                            class="w-full border px-2 py-1 win-border">
                    </div>

                    <div>
                        <label class="font-bold">Telepon</label>
                        <input type="text" name="phone" value="{{ $company->phone ?? '' }}"
                            class="w-full border px-2 py-1 win-border">
                    </div>
                </div>

                {{-- RIGHT --}}
                <div class="space-y-3">
                    <div>
                        <label class="font-bold">Website</label>
                        <input type="text" name="website" value="{{ $company->website ?? '' }}"
                            class="w-full border px-2 py-1 win-border">
                    </div>

                    <div>
                        <label class="font-bold">Logo URL</label>
                        <input type="text" name="logo_url" value="{{ $company->logo_url ?? '' }}"
                            class="w-full border px-2 py-1 win-border">
                    </div>

                    <div>
                        <label class="font-bold">Alamat</label>
                        <textarea name="address" rows="2" class="w-full border px-2 py-1 win-border">{{ $company->address ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="font-bold">Deskripsi</label>
                        <textarea name="description" rows="2" class="w-full border px-2 py-1 win-border">{{ $company->description ?? '' }}</textarea>
                    </div>
                </div>

            </div>

            {{-- Footer --}}
            <div class="pt-3 border-t mt-3">
                <button type="submit" class="bg-blue-700 text-white px-5 py-1 win-border">
                    💾 Simpan Profile
                </button>
            </div>

        </form>
    </div>
@endsection
