<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(): View
    {
        $tags = Tag::query()->orderBy('name')->paginate(100);

        return view('admin.tags.index', compact('tags'));
    }

    public function create(): View
    {
        return view('admin.tags.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
        ]);

        $slugBase = trim((string) ($validated['slug'] ?? '')) !== '' ? (string) $validated['slug'] : (string) $validated['name'];
        $slug = $this->makeUniqueSlug($slugBase);

        Tag::create([
            'name' => $validated['name'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.tags.index')->with('status', 'Tag dibuat.');
    }

    public function show(Tag $tag): View
    {
        return view('admin.tags.show', compact('tag'));
    }

    public function edit(Tag $tag): View
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
        ]);

        $slugBase = trim((string) ($validated['slug'] ?? '')) !== '' ? (string) $validated['slug'] : (string) $validated['name'];
        $slug = $this->makeUniqueSlug($slugBase, $tag->id);

        $tag->update([
            'name' => $validated['name'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.tags.edit', $tag)->with('status', 'Tag diperbarui.');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('status', 'Tag dihapus.');
    }

    private function makeUniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value);
        $base = $base !== '' ? $base : Str::random(8);
        $slug = $base;
        $i = 2;

        while (Tag::query()
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}
