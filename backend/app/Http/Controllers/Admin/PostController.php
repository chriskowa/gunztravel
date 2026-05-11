<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->with(['author'])
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::query()->orderBy('name')->get();
        $tags = Tag::query()->orderBy('name')->get();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:2000'],
            'canonical_url' => ['nullable', 'string', 'max:2048'],
            'noindex' => ['nullable', 'boolean'],
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['integer'],
            'tags' => ['nullable', 'string'],
            'cover_file' => ['nullable', 'image', 'max:5120'],
            'og_file' => ['nullable', 'image', 'max:5120'],
        ]);

        $slugBase = trim((string) ($validated['slug'] ?? '')) !== '' ? (string) $validated['slug'] : (string) $validated['title'];
        $slug = $this->makeUniqueSlug($slugBase);

        $post = Post::create([
            'author_id' => $request->user()->id,
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'] ?? null,
            'status' => $validated['status'],
            'published_at' => $validated['published_at'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'canonical_url' => $validated['canonical_url'] ?? null,
            'noindex' => (bool) ($validated['noindex'] ?? false),
        ]);

        $post->categories()->sync($validated['category_ids'] ?? []);
        $post->tags()->sync($this->resolveTagIds($validated['tags'] ?? ''));

        if ($request->hasFile('cover_file')) {
            $post->addMediaFromRequest('cover_file')->toMediaCollection('cover');
        }

        if ($request->hasFile('og_file')) {
            $post->addMediaFromRequest('og_file')->toMediaCollection('og');
        }

        return redirect()->route('admin.posts.edit', $post)->with('status', 'Post dibuat.');
    }

    public function show(Post $post): View
    {
        $post->load(['categories', 'tags', 'media']);

        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        $post->load(['categories', 'tags', 'media']);
        $categories = Category::query()->orderBy('name')->get();
        $tags = Tag::query()->orderBy('name')->get();
        $selectedCategoryIds = $post->categories->pluck('id')->all();
        $tagsCsv = $post->tags->pluck('name')->implode(', ');

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'selectedCategoryIds', 'tagsCsv'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:2000'],
            'canonical_url' => ['nullable', 'string', 'max:2048'],
            'noindex' => ['nullable', 'boolean'],
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['integer'],
            'tags' => ['nullable', 'string'],
            'cover_file' => ['nullable', 'image', 'max:5120'],
            'og_file' => ['nullable', 'image', 'max:5120'],
        ]);

        $slugBase = trim((string) ($validated['slug'] ?? '')) !== '' ? (string) $validated['slug'] : (string) $validated['title'];
        $slug = $this->makeUniqueSlug($slugBase, $post->id);

        $post->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'] ?? null,
            'status' => $validated['status'],
            'published_at' => $validated['published_at'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'canonical_url' => $validated['canonical_url'] ?? null,
            'noindex' => (bool) ($validated['noindex'] ?? false),
        ]);

        $post->categories()->sync($validated['category_ids'] ?? []);
        $post->tags()->sync($this->resolveTagIds($validated['tags'] ?? ''));

        if ($request->hasFile('cover_file')) {
            $post->clearMediaCollection('cover');
            $post->addMediaFromRequest('cover_file')->toMediaCollection('cover');
        }

        if ($request->hasFile('og_file')) {
            $post->clearMediaCollection('og');
            $post->addMediaFromRequest('og_file')->toMediaCollection('og');
        }

        return redirect()->route('admin.posts.edit', $post)->with('status', 'Post diperbarui.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', 'Post dihapus.');
    }

    private function makeUniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value);
        $base = $base !== '' ? $base : Str::random(8);
        $slug = $base;
        $i = 2;

        while (Post::query()
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }

    private function resolveTagIds(string $csv): array
    {
        $names = collect(explode(',', $csv))
            ->map(fn ($t) => trim($t))
            ->filter()
            ->unique()
            ->values();

        if ($names->isEmpty()) {
            return [];
        }

        $existing = Tag::query()->whereIn('name', $names)->get()->keyBy('name');
        $ids = [];

        foreach ($names as $name) {
            $tag = $existing->get($name);
            if (! $tag) {
                $tag = Tag::create([
                    'name' => $name,
                    'slug' => $this->makeUniqueTagSlug($name),
                ]);
            }

            $ids[] = $tag->id;
        }

        return $ids;
    }

    private function makeUniqueTagSlug(string $value): string
    {
        $base = Str::slug($value);
        $base = $base !== '' ? $base : Str::random(8);
        $slug = $base;
        $i = 2;

        while (Tag::query()->where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}
