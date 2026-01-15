@extends('layouts.dashboard')

@section('title', 'Detail Pesan Kontak')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-blue-900 text-lg">📧 Detail Pesan Kontak</h2>
        <a href="{{ route('contacts.index') }}" class="text-sm text-blue-700 underline">← Kembali</a>
    </div>

    <div class="bg-white p-6 win-border">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-bold mb-1 text-gray-700">Nama</label>
                <p class="text-lg font-semibold">{{ $contact->name }}</p>
            </div>
            <div>
                <label class="block text-sm font-bold mb-1 text-gray-700">Email</label>
                <p class="text-lg">
                    <a href="mailto:{{ $contact->email }}" class="text-blue-700 underline">
                        {{ $contact->email }}
                    </a>
                </p>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-1 text-gray-700">Tanggal Dikirim</label>
            <p class="text-lg">{{ $contact->created_at->format('d F Y, H:i') }} WIB</p>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2 text-gray-700">Pesan</label>
            <div class="bg-gray-50 border border-gray-300 rounded p-4">
                <p class="whitespace-pre-wrap leading-relaxed">{{ $contact->message }}</p>
            </div>
        </div>

        <div class="flex gap-2 pt-4 border-t">
            <a href="mailto:{{ $contact->email }}?subject=Re: Pesan dari {{ $contact->name }}" 
               class="bg-blue-700 text-white px-4 py-2 win-border hover:bg-blue-600">
                📧 Balas via Email
            </a>
            <form action="{{ route('contacts.destroy', $contact) }}" method="POST" 
                  onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-700 text-white px-4 py-2 win-border hover:bg-red-600">
                    🗑️ Hapus Pesan
                </button>
            </form>
        </div>
    </div>
@endsection
