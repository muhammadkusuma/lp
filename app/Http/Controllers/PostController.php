<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        // Mengambil post dengan relasi author dan categories, diurutkan terbaru
        $posts = Post::with(['author', 'categories'])->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        // Asumsi model Category sudah ada berdasarkan migrasi
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'required',
            'status'     => 'required|in:draft,published',
            'categories' => 'array', // Array ID kategori
        ]);

        $post = Post::create([
            'author_id'    => Auth::id(), // Mengambil user yang login
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . Str::random(5),
            'content'      => $request->content,
            'status'       => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        // Simpan relasi kategori jika ada (Many-to-Many)
        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        }

        return redirect()->route('posts.index')->with('success', 'Post berhasil dibuat.');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'required',
            'status'     => 'required|in:draft,published',
            'categories' => 'array',
        ]);

        $post->update([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . Str::random(5), // Update slug jika judul berubah
            'content'      => $request->content,
            'status'       => $request->status,
            'published_at' => $request->status === 'published' && ! $post->published_at ? now() : $post->published_at,
        ]);

        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        }

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        $post->categories()->detach(); // Hapus relasi pivot dulu
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus.');
    }
}
