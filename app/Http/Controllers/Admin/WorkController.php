<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class WorkController extends Controller
{
    public function index(): View
    {
        $works = Work::latest()->paginate(10);
        return view('admin.works.index', compact('works'));
    }

    public function create(): View
    {
        return view('admin.works.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+5),
            'category' => 'required|string|max:255',
            'project_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('works_images', 'public');
            $validated['image'] = $path;
        }

        Work::create($validated);
        return redirect()->route('admin.works.index')->with('success', 'Projek berhasil ditambahkan.');
    }

    public function show(Work $work): View
    {
        return view('admin.works.show', compact('work'));
    }

    public function edit(Work $work): View
    {
        return view('admin.works.edit', compact('work'));
    }

    public function update(Request $request, Work $work): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+5),
            'category' => 'required|string|max:255',
            'project_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($work->image && Storage::disk('public')->exists($work->image)) {
                Storage::disk('public')->delete($work->image);
            }
            $path = $request->file('image')->store('works_images', 'public');
            $validated['image'] = $path;
        }

        $work->update($validated);
        return redirect()->route('admin.works.index')->with('success', 'Projek berhasil diperbarui.');
    }

    public function destroy(Work $work): RedirectResponse
    {
        if ($work->image && Storage::disk('public')->exists($work->image)) {
            Storage::disk('public')->delete($work->image);
        }
        $work->delete();
        return redirect()->route('admin.works.index')->with('success', 'Projek berhasil dihapus.');
    }
}
