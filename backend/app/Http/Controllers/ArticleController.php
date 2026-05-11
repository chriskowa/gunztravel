<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $posts = $this->publishedPosts()
            ->with(['categories', 'tags', 'media'])
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(12);

        return view('public.articles.index', compact('posts'));
    }

    public function show(string $slug): View
    {
        $post = $this->publishedPosts()
            ->where('slug', $slug)
            ->with(['categories', 'tags', 'media'])
            ->firstOrFail();

        return view('public.articles.show', compact('post'));
    }

    public function category(string $slug): View
    {
        $category = Category::query()->where('slug', $slug)->firstOrFail();

        $posts = $this->publishedPosts()
            ->with(['categories', 'tags', 'media'])
            ->whereHas('categories', fn ($q) => $q->where('categories.id', $category->id))
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(12);

        return view('public.categories.show', compact('category', 'posts'));
    }

    public function tag(string $slug): View
    {
        $tag = Tag::query()->where('slug', $slug)->firstOrFail();

        $posts = $this->publishedPosts()
            ->with(['categories', 'tags', 'media'])
            ->whereHas('tags', fn ($q) => $q->where('tags.id', $tag->id))
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(12);

        return view('public.tags.show', compact('tag', 'posts'));
    }

    public function sitemap(): Response
    {
        $baseUrl = rtrim(config('app.url'), '/');

        $urls = [];
        $urls[] = $baseUrl.'/artikel';

        foreach (Category::query()->orderBy('id')->get(['slug']) as $category) {
            $urls[] = $baseUrl.'/kategori/'.$category->slug;
        }

        foreach (Tag::query()->orderBy('id')->get(['slug']) as $tag) {
            $urls[] = $baseUrl.'/tag/'.$tag->slug;
        }

        foreach ($this->publishedPosts()->orderBy('id')->get(['slug', 'updated_at']) as $post) {
            $urls[] = $baseUrl.'/artikel/'.$post->slug;
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>'.e($url)."</loc>\n";
            $xml .= "  </url>\n";
        }

        $xml .= "</urlset>\n";

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    private function publishedPosts()
    {
        return Post::query()
            ->where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }
}
