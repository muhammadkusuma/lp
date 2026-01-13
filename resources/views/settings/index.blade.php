@extends('layouts.dashboard')

@section('title', 'General Settings')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-bold text-blue-900 text-xl">⚙️ Pengaturan Aplikasi</h2>
    </div>

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 win-border">
        @csrf
        @method('PUT')

        {{-- GENERAL SETTINGS SECTION --}}
        <div class="mb-6 border-b pb-4">
            <h3 class="font-bold text-lg mb-4 text-gray-700">Identitas Aplikasi</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- App Name --}}
                <div class="mb-3">
                    <label for="app_name" class="block text-sm font-semibold mb-1">Nama Aplikasi</label>
                    <input type="text" name="app_name" id="app_name"
                        value="{{ $settings['app_name'] ?? 'PT SOFTWARE HOUSE' }}"
                        class="w-full border p-2 text-sm focus:outline-none focus:border-blue-500">
                </div>

                {{-- App Logo --}}
                <div class="mb-3">
                    <label class="block text-sm font-semibold mb-1">Logo Aplikasi</label>
                    @if (isset($settings['app_logo']))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="Logo"
                                class="h-16 w-auto border p-1">
                        </div>
                    @endif
                    <input type="file" name="app_logo"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>
        </div>

        {{-- CONTACT SETTINGS SECTION --}}
        <div class="mb-6">
            <h3 class="font-bold text-lg mb-4 text-gray-700">Informasi Kontak Perusahaan</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Email --}}
                <div class="mb-3">
                    <label for="company_email" class="block text-sm font-semibold mb-1">Email Resmi</label>
                    <input type="email" name="company_email" id="company_email"
                        value="{{ $settings['company_email'] ?? '' }}"
                        class="w-full border p-2 text-sm focus:outline-none focus:border-blue-500">
                </div>

                {{-- Phone --}}
                <div class="mb-3">
                    <label for="company_phone" class="block text-sm font-semibold mb-1">No. Telepon</label>
                    <input type="text" name="company_phone" id="company_phone"
                        value="{{ $settings['company_phone'] ?? '' }}"
                        class="w-full border p-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
            </div>

            {{-- Address --}}
            <div class="mb-3">
                <label for="company_address" class="block text-sm font-semibold mb-1">Alamat Lengkap</label>
                <textarea name="company_address" id="company_address" rows="3"
                    class="w-full border p-2 text-sm focus:outline-none focus:border-blue-500">{{ $settings['company_address'] ?? '' }}</textarea>
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex justify-end gap-2">
            <button type="submit" class="bg-blue-900 text-white px-4 py-2 text-sm hover:bg-blue-800 transition">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
@endsection
