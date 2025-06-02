<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Penting!
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk slug manual jika model event tidak dipakai
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            // 'slug' => 'nullable|string|max:255|unique:categories,slug', // Slug dibuat otomatis oleh model
        ]);

        // Slug akan dibuat otomatis oleh model event 'creating' atau 'updating'
        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // 'show' method tidak kita gunakan berdasarkan route.

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            // 'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id, // Slug diupdate otomatis
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        // Cek jika ada post yang menggunakan kategori ini (opsional, tergantung kebutuhan)
        if ($category->posts()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh post.');
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}