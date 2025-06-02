<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Penting!
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user_id
use Illuminate\Support\Facades\Storage; // Untuk file uploads
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with('category', 'user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            // 'slug' => 'nullable|string|max:255|unique:posts,slug', // Slug otomatis
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Validasi gambar
        ]);

        $validated['user_id'] = Auth::id();
        // Slug akan dibuat otomatis oleh model event

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts_images', 'public'); // Simpan di storage/app/public/posts_images
            $validated['image'] = $path;
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil ditambahkan.');
    }

    public function show(Post $post): View
    {
        $post->load('category', 'user'); // Eager load
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            // 'slug' => 'nullable|string|max:255|unique:posts,slug,' . $post->id, // Slug otomatis
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada dan bukan gambar default
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $path = $request->file('image')->store('posts_images', 'public');
            $validated['image'] = $path;
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        // Hapus gambar terkait jika ada
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus.');
    }
}
