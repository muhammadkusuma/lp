@extends('layouts.dashboard')

@section('title', 'Testimonial')

@section('content')
    <div class="h-full flex flex-col">

        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">💬 Testimonial</h2>

            <a href="{{ route('testimonials.create') }}" class="bg-green-700 text-white px-3 py-1 win-border">
                ➕ Tambah Testimonial
            </a>
        </div>

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900">
                    <tr>
                        <th class="border px-2 py-1 w-12">#</th>
                        <th class="border px-2 py-1 text-left w-1/4">Nama Klien</th>
                        <th class="border px-2 py-1 text-center w-16">Rating</th>
                        <th class="border px-2 py-1 text-left">Isi Testimonial</th>
                        <th class="border px-2 py-1 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testimonials as $i => $item)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                            <td class="border px-2 py-1 font-bold">{{ $item->client_name }}</td>
                            <td class="border px-2 py-1 text-center">
                                <span class="text-yellow-600 font-bold">★ {{ $item->rating }}</span>
                            </td>
                            <td class="border px-2 py-1 truncate max-w-xs" title="{{ $item->content }}">
                                {{ Str::limit($item->content, 60) }}
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('testimonials.edit', $item) }}" class="text-blue-700">✏️</a>

                                <form action="{{ route('testimonials.destroy', $item) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus testimonial dari {{ $item->client_name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 ml-2">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($testimonials->count() === 0)
                        <tr>
                            <td colspan="5" class="border px-2 py-3 text-center text-gray-500">
                                Belum ada testimonial
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
