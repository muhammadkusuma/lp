@extends('layouts.dashboard')

@section('title', 'Baca Pesan')

@section('content')
    <div class="h-full flex flex-col">
        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">📖 Baca Pesan</h2>
            <a href="{{ route('contacts.index') }}" class="bg-gray-200 text-black px-3 py-1 win-border hover:bg-gray-300">
                🔙 Kembali
            </a>
        </div>

        <div class="win-border bg-white p-6 max-w-2xl mx-auto w-full shadow-md">
            
            <div class="border-b pb-4 mb-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $contact->name }}</h3>
                        <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:underline">
                            {{ $contact->email }}
                        </a>
                    </div>
                    <div class="text-right text-sm text-gray-500">
                        <p>{{ $contact->created_at->format('l, d F Y') }}</p>
                        <p>{{ $contact->created_at->format('H:i') }} WIB</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-4 border border-gray-200 rounded min-h-[150px] whitespace-pre-wrap font-sans text-gray-800">
{{ $contact->message }}
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <a href="mailto:{{ $contact->email }}" class="bg-blue-700 text-white px-4 py-2 win-border hover:bg-blue-600">
                    📧 Balas Email
                </a>
                
                <form action="{{ route('contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-700 text-white px-4 py-2 win-border hover:bg-red-600">
                        🗑️ Hapus
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection