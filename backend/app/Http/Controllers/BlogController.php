<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    /**
     * Render the blog landing page with static SEO tags in HTML head.
     */
    public function index()
    {
        $baseUrl = rtrim(config('app.url'), '/');
        
        $seo = [
            'title' => 'Blog & Tips Perjalanan | Gunz Travel',
            'description' => 'Temukan informasi rute travel, tips perjalanan sewa mobil, dan destinasi wisata terbaru dari Gunz Travel.',
            'canonical' => $baseUrl . '/blog',
            'image' => $baseUrl . '/logo-gunz-travel.webp',
            'og_type' => 'website'
        ];

        return view('spa', compact('seo'));
    }

    /**
     * Render the blog post page with dynamically fetched SEO tags in HTML head.
     */
    public function show($slug)
    {
        $baseUrl = rtrim(config('app.url'), '/');

        // Cache the metadata for 12 hours to guarantee high performance
        $seo = Cache::remember('seo_blog_post_' . $slug, now()->addHours(12), function () use ($slug, $baseUrl) {
            try {
                $response = Http::timeout(4)->get("https://blog.gunztravel.com/wp-json/wp/v2/posts", [
                    'slug' => $slug,
                    '_embed' => 1
                ]);

                if ($response->successful() && !empty($response->json())) {
                    $post = $response->json()[0];
                    $title = $post['title']['rendered'] ?? '';
                    
                    // Decode HTML entities in title (e.g. &#8211; to –)
                    $title = html_entity_decode($title, ENT_QUOTES, 'UTF-8');

                    // Extract and clean excerpt for description
                    $excerpt = '';
                    if (!empty($post['excerpt']['rendered'])) {
                        $excerpt = strip_tags($post['excerpt']['rendered']);
                        $excerpt = html_entity_decode($excerpt, ENT_QUOTES, 'UTF-8');
                        $excerpt = preg_replace('/\s+/', ' ', $excerpt);
                        $excerpt = mb_strimwidth(trim($excerpt), 0, 160, '...');
                    }

                    // Extract featured image
                    $image = $baseUrl . '/logo-gunz-travel.webp';
                    if (!empty($post['_embedded']['wp:featuredmedia'][0]['source_url'])) {
                        $image = $post['_embedded']['wp:featuredmedia'][0]['source_url'];
                    }

                    $canonical = $baseUrl . '/blog/' . $slug;

                    // Build JSON-LD structured schema
                    $schema = [
                        '@context' => 'https://schema.org',
                        '@type' => 'BlogPosting',
                        'headline' => $title,
                        'description' => $excerpt,
                        'image' => [$image],
                        'datePublished' => $post['date'] ?? null,
                        'dateModified' => $post['modified'] ?? ($post['date'] ?? null),
                        'mainEntityOfPage' => [
                            '@type' => 'WebPage',
                            '@id' => $canonical
                        ],
                        'author' => [
                            '@type' => 'Organization',
                            'name' => 'Gunz Travel Team',
                            'url' => $baseUrl
                        ],
                        'publisher' => [
                            '@type' => 'TravelAgency',
                            'name' => 'Gunz Travel',
                            'logo' => [
                                '@type' => 'ImageObject',
                                'url' => $baseUrl . '/logo-gunz-travel.webp'
                            ]
                        ]
                    ];

                    return [
                        'title' => $title . ' | Gunz Travel',
                        'description' => $excerpt,
                        'canonical' => $canonical,
                        'image' => $image,
                        'og_type' => 'article',
                        'schema' => $schema
                    ];
                }
            } catch (\Exception $e) {
                Log::error('Blog SSR Meta fetch error for slug ' . $slug . ': ' . $e->getMessage());
            }

            return null;
        });

        // Fallback to standard SPA view if fetch fails
        if (!$seo) {
            return view('spa');
        }

        return view('spa', compact('seo'));
    }
}
