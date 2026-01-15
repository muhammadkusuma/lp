<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author', 'categories')
            ->latest()
            ->paginate(20);
        
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'categories' => 'array',
        ]);

        $post = Post::create([
            'author_id' => auth()->id(),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'status' => $validated['status'],
            'published_at' => $validated['status'] === 'published' 
                ? ($validated['published_at'] ?? now()) 
                : null,
        ]);

        if (!empty($validated['categories'])) {
            $post->categories()->attach($validated['categories']);
        }

        return redirect()->route('posts.index')->with('success', 'Artikel berhasil dibuat');
    }

    public function show(Post $post)
    {
        $post->load('author', 'categories');
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        $post->load('categories');
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'categories' => 'array',
        ]);

        $post->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'status' => $validated['status'],
            'published_at' => $validated['status'] === 'published' 
                ? ($validated['published_at'] ?? $post->published_at ?? now()) 
                : null,
        ]);

        $post->categories()->sync($validated['categories'] ?? []);

        return redirect()->route('posts.index')->with('success', 'Artikel berhasil diupdate');
    }

    public function destroy(Post $post)
    {
        $post->categories()->detach();
        $post->delete();
        
        return redirect()->route('posts.index')->with('success', 'Artikel berhasil dihapus');
    }
}
