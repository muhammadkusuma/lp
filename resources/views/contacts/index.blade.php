@extends('layouts.dashboard')

@section('title', 'Contacts / Inbox')

@section('content')
    <div class="h-full flex flex-col">

        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">📬 Inbox Messages</h2>
            
            {{-- Tidak ada tombol 'Create' karena pesan biasanya berasal dari pengunjung website --}}
            <span class="text-sm text-gray-500">
                Total: {{ $contacts->count() }} Pesan
            </span>
        </div>

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900">
                    <tr>
                        <th class="border px-2 py-1 w-12">#</th>
                        <th class="border px-2 py-1 w-1/5">Nama Pengirim</th>
                        <th class="border px-2 py-1 w-1/5">Email</th>
                        <th class="border px-2 py-1">Pesan (Cuplikan)</th>
                        <th class="border px-2 py-1 w-32">Tanggal</th>
                        <th class="border px-2 py-1 w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $i => $contact)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                            <td class="border px-2 py-1 font-bold">{{ $contact->name }}</td>
                            <td class="border px-2 py-1">
                                <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:underline">
                                    {{ $contact->email }}
                                </a>
                            </td>
                            <td class="border px-2 py-1 text-gray-600">
                                {{ Str::limit($contact->message, 50) }}
                            </td>
                            <td class="border px-2 py-1 text-center text-xs">
                                {{ $contact->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('contacts.show', $contact) }}" class="text-blue-700 mr-2" title="Lihat Detail">
                                    👁️
                                </a>

                                <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus pesan dari {{ $contact->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700" title="Hapus">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($contacts->count() === 0)
                        <tr>
                            <td colspan="6" class="border px-2 py-8 text-center text-gray-500">
                                📭 Belum ada pesan masuk.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection