@extends('layouts.dashboard')

@section('title', 'Company Legal')

@section('content')
    <div class="h-full flex flex-col">

        {{-- Header --}}
        <div class="mb-3">
            <h2 class="font-bold text-blue-900">📜 Company Legal</h2>
            <p class="text-xs text-gray-600">
                Informasi legal & badan hukum perusahaan
            </p>
        </div>

        <form method="POST" action="{{ route('company.legal.update') }}" class="flex-1 flex flex-col">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4 text-sm flex-1">

                {{-- LEFT --}}
                <div class="space-y-3">
                    <div>
                        <label class="font-bold">Bentuk Perusahaan</label>
                        <input type="text" name="company_type" value="{{ $legal->company_type ?? 'PT Perorangan' }}"
                            class="w-full border px-2 py-1 win-border">
                    </div>

                    <div>
                        <label class="font-bold">NPWP</label>
                        <input type="text" name="npwp" value="{{ $legal->npwp ?? '' }}"
                            class="w-full border px-2 py-1 win-border">
                    </div>

                    <div>
                        <label class="font-bold">NIB</label>
                        <input type="text" name="nib" value="{{ $legal->nib ?? '' }}"
                            class="w-full border px-2 py-1 win-border">
                    </div>

                    <div>
                        <label class="font-bold">SIUP</label>
                        <input type="text" name="siup" value="{{ $legal->siup ?? '' }}"
                            class="w-full border px-2 py-1 win-border">
                    </div>
                </div>

                {{-- RIGHT --}}
                <div class="space-y-3">
                    <div>
                        <label class="font-bold">No Akta Pendirian</label>
                        <input type="text" name="akta_pendirian" value="{{ $legal->akta_pendirian ?? '' }}"
                            class="w-full border px-2 py-1 win-border">
                    </div>

                    <div>
                        <label class="font-bold">Tanggal Pendirian</label>
                        <input type="date" name="tanggal_pendirian" value="{{ $legal->tanggal_pendirian ?? '' }}"
                            class="w-full border px-2 py-1 win-border">
                    </div>

                    <div>
                        <label class="font-bold">Notaris</label>
                        <input type="text" name="notaris" value="{{ $legal->notaris ?? '' }}"
                            class="w-full border px-2 py-1 win-border">
                    </div>

                    <div>
                        <label class="font-bold">Status Badan Hukum</label>
                        <select name="status_badan_hukum" class="w-full border px-2 py-1 win-border">
                            <option value="aktif" {{ ($legal->status_badan_hukum ?? '') === 'aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="non-aktif"
                                {{ ($legal->status_badan_hukum ?? '') === 'non-aktif' ? 'selected' : '' }}>
                                Non-Aktif
                            </option>
                        </select>
                    </div>
                </div>

            </div>

            {{-- Footer --}}
            <div class="pt-3 border-t mt-3">
                <button type="submit" class="bg-blue-700 text-white px-5 py-1 win-border">
                    💾 Simpan Data Legal
                </button>
            </div>

        </form>
    </div>
@endsection
