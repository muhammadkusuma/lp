@extends('layouts.dashboard')

@section('title', 'Manajemen Blog')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-blue-900">Daftar Artikel Blog</h2>
        <a href="{{ route('posts.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-sm font-bold win-border shadow-md">
            + Tambah Artikel
        </a>
    </div>

    <div class="overflow-x-auto win-border bg-white">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-xs font-bold border-b-2 border-gray-400">
                    <th class="p-3 border-r border-gray-300 w-10">No</th>
                    <th class="p-3 border-r border-gray-300">Judul</th>
                    <th class="p-3 border-r border-gray-300">Kategori</th>
                    <th class="p-3 border-r border-gray-300">Author</th>
                    <th class="p-3 border-r border-gray-300">Status</th>
                    <th class="p-3 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($posts as $key => $post)
                    <tr class="border-b border-gray-200 hover:bg-blue-50">
                        <td class="p-3 border-r border-gray-200 text-center">{{ $posts->firstItem() + $key }}</td>
                        <td class="p-3 border-r border-gray-200 font-semibold text-blue-800">
                            {{ $post->title }}
                            <div class="text-xs text-gray-500 mt-1">/{{ $post->slug }}</div>
                        </td>
                        <td class="p-3 border-r border-gray-200">
                            @foreach ($post->categories as $cat)
                                <span
                                    class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded border border-blue-300">
                                    {{ $cat->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="p-3 border-r border-gray-200">{{ $post->author->name ?? 'Unknown' }}</td>
                        <td class="p-3 border-r border-gray-200">
                            @if ($post->status == 'published')
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded border border-green-300">Published</span>
                            @else
                                <span
                                    class="bg-gray-100 text-gray-800 text-xs font-bold px-2 py-1 rounded border border-gray-300">Draft</span>
                            @endif
                        </td>
                        <td class="p-3 text-center flex justify-center gap-2">
                            <a href="{{ route('posts.edit', $post->id) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-black px-2 py-1 border border-black text-xs shadow-sm">Edit</a>

                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                onsubmit="return confirm('Hapus artikel ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 border border-black text-xs shadow-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500 italic">Belum ada artikel yang dibuat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
@endsection
