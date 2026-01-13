@extends('layouts.dashboard')

@section('title', 'Portfolio')

@section('content')
    <div class="h-full flex flex-col">

        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-blue-900">📂 Portfolio</h2>
            <a href="{{ route('portfolios.create') }}"
                class="bg-green-700 text-white px-3 py-1 win-border hover:bg-green-600">
                ➕ Tambah Portfolio
            </a>
        </div>

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-blue-200 text-blue-900 sticky top-0">
                    <tr>
                        <th class="border px-2 py-1 text-center w-10">#</th>
                        <th class="border px-2 py-1 text-center w-20">Image</th>
                        <th class="border px-2 py-1 text-left">Title</th>
                        <th class="border px-2 py-1 text-left">Project Base</th>
                        <th class="border px-2 py-1 text-left">Description</th>
                        <th class="border px-2 py-1 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($portfolios as $i => $item)
                        <tr class="hover:bg-blue-100">
                            <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                            <td class="border px-2 py-1 text-center">
                                @if ($item->image_url)
                                    <img src="{{ asset('storage/' . $item->image_url) }}" alt="img"
                                        class="h-10 w-10 object-cover border border-gray-400 mx-auto">
                                @else
                                    <span class="text-xs text-gray-400">No Img</span>
                                @endif
                            </td>
                            <td class="border px-2 py-1 font-bold">{{ $item->title }}</td>
                            <td class="border px-2 py-1">
                                @if ($item->project)
                                    <span class="text-xs bg-blue-100 text-blue-800 px-1 rounded border border-blue-300">
                                        {{ $item->project->name }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="border px-2 py-1 text-gray-600 truncate max-w-xs">
                                {{ Str::limit($item->description, 50) }}
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <a href="{{ route('portfolios.edit', $item->id) }}"
                                    class="text-blue-700 hover:text-blue-900 mr-2" title="Edit">✏️</a>

                                <form action="{{ route('portfolios.destroy', $item->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus portfolio ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 hover:text-red-900" title="Hapus">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($portfolios->count() === 0)
                        <tr>
                            <td colspan="6" class="border px-2 py-8 text-center text-gray-500 italic">
                                Belum ada data portfolio.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
