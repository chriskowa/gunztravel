<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

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

        $staticPaths = [
            '/',
            '/sewa-mobil-malang/',
            '/travel-malang-surabaya/',
            '/travel-malang-juanda/',
            '/travel-juanda-malang/',
            '/travel-batu-juanda/',
            '/sewa-avanza-malang/',
            '/sewa-innova-reborn-malang/',
            '/sewa-alphard-vellfire-malang/',
            '/sewa-pajero-fortuner-malang/',
            '/sewa-hiace-malang/',
            '/sewa-elf-malang/',
            '/paket-wisata-bromo/',
            '/city-tour-malang-batu/',
            '/wisata-religi-malang/',
            '/blog',
        ];

        $xml = Cache::remember('sitemap_xml_data', now()->addHours(6), function () use ($baseUrl, $staticPaths) {
            $urls = [];
            foreach ($staticPaths as $path) {
                $url = $baseUrl . '/' . ltrim($path, '/');
                $urls[] = [
                    'loc' => $url,
                    'lastmod' => null
                ];
            }

            try {
                // Fetch published posts from the WordPress subdomain REST API
                $response = Http::timeout(5)->get('https://blog.gunztravel.com/wp-json/wp/v2/posts', [
                    '_fields' => 'slug,modified',
                    'per_page' => 100
                ]);

                if ($response->successful()) {
                    $posts = $response->json();
                    foreach ($posts as $post) {
                        if (!empty($post['slug'])) {
                            $urls[] = [
                                'loc' => $baseUrl . '/blog/' . $post['slug'],
                                'lastmod' => $post['modified'] ?? null
                            ];
                        }
                    }
                }
            } catch (\Exception $e) {
                logger()->error('Sitemap WP API fetch failed: ' . $e->getMessage());
            }

            $xmlStr = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $xmlStr .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

            foreach ($urls as $item) {
                $xmlStr .= "  <url>\n";
                $xmlStr .= '    <loc>' . e($item['loc']) . "</loc>\n";
                if (!empty($item['lastmod'])) {
                    $xmlStr .= '    <lastmod>' . e($item['lastmod']) . "</lastmod>\n";
                }
                $xmlStr .= "  </url>\n";
            }

            $xmlStr .= "</urlset>\n";
            return $xmlStr;
        });

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
