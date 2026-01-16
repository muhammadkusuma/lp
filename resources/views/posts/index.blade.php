@extends('layouts.dashboard')

@section('title', 'Artikel / Blog')

@section('content')
    {{-- Info Box --}}
    <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
        <h4 class="font-bold mb-1">ℹ️ Manajemen Konten</h4>
        <p>Buat dan kelola artikel berita atau blog untuk website Anda. Anda dapat menyimpan sebagai draft atau langsung mempublikasikannya.</p>
    </div>

    <div class="flex items-center justify-between mb-4">
        <div class="flex gap-2">
            {{-- Search / Filter Placeholder --}}
        </div>

        <a href="{{ route('posts.create') }}" class="bg-blue-700 text-white px-4 py-2 win-border hover:bg-blue-600">
            + Tambah Artikel
        </a>
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
                        <th class="border px-2 py-1 text-left">Judul</th>
                        <th class="border px-2 py-1 text-left w-32">Kategori</th>
                        <th class="border px-2 py-1 text-left w-24">Status</th>
                        <th class="border px-2 py-1 text-left w-32">Tanggal Publish</th>
                        <th class="border px-2 py-1 text-left w-32">Penulis</th>
                        <th class="border px-2 py-1 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $index => $post)
                        <tr class="hover:bg-yellow-50">
                            <td class="border px-2 py-1 text-center">
                                {{ $posts->firstItem() + $index }}
                            </td>
                            <td class="border px-2 py-1 font-semibold">
                                {{ $post->title }}
                            </td>
                            <td class="border px-2 py-1 text-sm">
                                @foreach($post->categories as $category)
                                    <span class="inline-block bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs mr-1">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="border px-2 py-1 text-center">
                                @if($post->status === 'published')
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">
                                        Published
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-semibold">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="border px-2 py-1 text-sm">
                                {{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td class="border px-2 py-1 text-sm">
                                {{ $post->author->name ?? '-' }}
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <div class="flex gap-1 justify-center">
                                    <a href="{{ route('posts.edit', $post) }}" 
                                       class="bg-yellow-600 text-white px-2 py-1 text-xs win-border hover:bg-yellow-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
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
                            <td colspan="7" class="border px-2 py-4 text-center text-gray-500">
                                Belum ada artikel
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
