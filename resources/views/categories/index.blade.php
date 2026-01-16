@extends('layouts.dashboard')

@section('title', 'Kategori Artikel')

@section('content')
    {{-- Info Box --}}
    <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
        <h4 class="font-bold mb-1">ℹ️ Pengelompokan Konten</h4>
        <p>Kelola kategori untuk mengelompokkan artikel atau berita agar memudahkan pembaca dalam mencari konten yang relevan.</p>
    </div>

    <div class="flex items-center justify-between mb-4">
        <div class="flex gap-2">
            {{-- Search / Filter Placeholder --}}
        </div>

        <a href="{{ route('categories.create') }}" class="bg-blue-700 text-white px-4 py-2 win-border hover:bg-blue-600">
            + Tambah Kategori
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
                        <th class="border px-2 py-1 text-left">Nama Kategori</th>
                        <th class="border px-2 py-1 text-center w-24">Jumlah Artikel</th>
                        <th class="border px-2 py-1 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                        <tr class="hover:bg-yellow-50">
                            <td class="border px-2 py-1 text-center">
                                {{ $categories->firstItem() + $index }}
                            </td>
                            <td class="border px-2 py-1 font-semibold">
                                {{ $category->name }}
                            </td>
                            <td class="border px-2 py-1 text-center">
                                {{ $category->posts_count }}
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <div class="flex gap-1 justify-center">
                                    <a href="{{ route('categories.edit', $category) }}" 
                                       class="bg-yellow-600 text-white px-2 py-1 text-xs win-border hover:bg-yellow-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                            <td colspan="4" class="border px-2 py-4 text-center text-gray-500">
                                Belum ada kategori
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
