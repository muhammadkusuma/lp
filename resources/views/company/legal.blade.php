@extends('layouts.dashboard')

@section('title', 'Company Legal')

@section('content')
    <div class="h-full flex flex-col">

        {{-- Info Box --}}
        <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
            <h4 class="font-bold mb-1">ℹ️ Data Legalitas</h4>
            <p>Penyimpanan data NPWP, NIB, dan Akta Pendirian untuk keperluan administrasi dan validasi dokumen hukum perusahaan.</p>
        </div>

        <form method="POST" action="{{ route('company.legal.update') }}" class="flex-1 flex flex-col">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4 text-sm flex-1">

                {{-- LEFT COLUMN --}}
                <div class="space-y-3">
                    <div>
                        <label class="font-bold block mb-1">NPWP</label>
                        <input type="text" name="npwp" value="{{ old('npwp', $legal->npwp ?? '') }}"
                            class="w-full border px-2 py-1 win-border" placeholder="Nomor Pokok Wajib Pajak">
                        @error('npwp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="font-bold block mb-1">NIB</label>
                        <input type="text" name="nib" value="{{ old('nib', $legal->nib ?? '') }}"
                            class="w-full border px-2 py-1 win-border" placeholder="Nomor Induk Berusaha">
                        @error('nib') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- RIGHT COLUMN --}}
                <div class="space-y-3">
                    <div>
                        <label class="font-bold block mb-1">No. Akta Pendirian</label>
                        <input type="text" name="akta_pendirian" value="{{ old('akta_pendirian', $legal->akta_pendirian ?? '') }}"
                            class="w-full border px-2 py-1 win-border" placeholder="Nomor Akta">
                        @error('akta_pendirian') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="font-bold block mb-1">Tanggal Pendirian</label>
                        <input type="date" name="tanggal_pendirian" value="{{ old('tanggal_pendirian', $legal->tanggal_pendirian ?? '') }}"
                            class="w-full border px-2 py-1 win-border">
                        @error('tanggal_pendirian') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

            {{-- Footer --}}
            <div class="pt-3 border-t mt-3">
                <button type="submit" class="bg-blue-700 text-white px-5 py-1 win-border hover:bg-blue-800 transition">
                    💾 Simpan Data Legal
                </button>
            </div>

        </form>
    </div>
@endsection