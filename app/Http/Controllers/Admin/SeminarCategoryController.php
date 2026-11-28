<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeminarCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeminarCategoryController extends Controller
{
    public function index()
    {
        $categories = SeminarCategory::withCount('profiles')
            ->latest()
            ->paginate(15);

        return view('admin.seminar.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'badge_color' => 'nullable|string|in:blue,emerald,purple,amber,rose,indigo,cyan',
        ]);

        $slug = $this->generateUniqueSlug($request->name);

        SeminarCategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'event_date' => $request->event_date ?: null,
            'location' => $request->location,
            'badge_color' => $request->badge_color ?: 'blue',
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.seminar.categories.index')->with('success', 'Kategori seminar berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $category = SeminarCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'badge_color' => 'nullable|string|in:blue,emerald,purple,amber,rose,indigo,cyan',
        ]);

        $slug = $category->name === $request->name
            ? $category->slug
            : $this->generateUniqueSlug($request->name, $category->id);

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'event_date' => $request->event_date ?: null,
            'location' => $request->location,
            'badge_color' => $request->badge_color ?: 'blue',
            'is_active' => $request->has('is_active') ? $request->boolean('is_active') : $category->is_active,
        ]);

        return redirect()->route('admin.seminar.categories.index')->with('success', 'Kategori seminar berhasil diperbarui.');
    }

    public function toggleActive($id)
    {
        $category = SeminarCategory::findOrFail($id);
        $category->update(['is_active' => !$category->is_active]);

        return redirect()->route('admin.seminar.categories.index')->with('success', 'Status kategori seminar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = SeminarCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.seminar.categories.index')->with('success', 'Kategori seminar berhasil dihapus.');
    }

    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'seminar';
        $slug = $base;
        $counter = 2;

        while (
            SeminarCategory::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }
}
