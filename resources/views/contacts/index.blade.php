@extends('layouts.dashboard')

@section('title', 'Pesan Kontak')

@section('content')
    {{-- Info Box --}}
    <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
        <h4 class="font-bold mb-1">ℹ️ Kotak Masuk</h4>
        <p>Daftar pesan yang dikirim oleh pengunjung melalui formulir kontak di landing page website utama.</p>
    </div>

    <div class="flex items-center justify-between mb-4">
        <div class="flex gap-2">
            {{-- Search / Filter Placeholder --}}
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 win-border">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border">
                <thead class="bg-blue-200 text-blue-900">
                    <tr>
                        <th class="border px-2 py-1 text-left w-10">No</th>
                        <th class="border px-2 py-1 text-left">Nama</th>
                        <th class="border px-2 py-1 text-left">Email</th>
                        <th class="border px-2 py-1 text-left">Pesan</th>
                        <th class="border px-2 py-1 text-left w-32">Tanggal</th>
                        <th class="border px-2 py-1 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $index => $contact)
                        <tr class="hover:bg-yellow-50">
                            <td class="border px-2 py-1 text-center">
                                {{ $contacts->firstItem() + $index }}
                            </td>
                            <td class="border px-2 py-1 font-semibold">
                                {{ $contact->name }}
                            </td>
                            <td class="border px-2 py-1">
                                <a href="mailto:{{ $contact->email }}" class="text-blue-700 underline">
                                    {{ $contact->email }}
                                </a>
                            </td>
                            <td class="border px-2 py-1">
                                <div class="max-w-md">
                                    {{ Str::limit($contact->message, 100) }}
                                </div>
                            </td>
                            <td class="border px-2 py-1 text-sm">
                                {{ $contact->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <div class="flex gap-1 justify-center">
                                    <a href="{{ route('contacts.show', $contact) }}" 
                                       class="bg-blue-700 text-white px-2 py-1 text-xs win-border hover:bg-blue-600">
                                        Lihat
                                    </a>
                                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-700 text-white px-2 py-1 text-xs win-border hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border px-2 py-4 text-center text-gray-500">
                                Belum ada pesan kontak
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($contacts->hasPages())
            <div class="mt-4">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
@endsection
