<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MediaItem;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();

        $targetUserCount = 6;
        $currentUserCount = User::query()->count();

        if ($currentUserCount < $targetUserCount) {
            User::factory()->count($targetUserCount - $currentUserCount)->create();
        }

        $categories = collect([
            'Travel Tips',
            'Destinations',
            'Itinerary',
            'Budget Travel',
            'Family Trip',
            'Solo Travel',
            'Food & Culture',
            'News',
        ])->map(function (string $name) use ($faker) {
            $slug = Str::slug($name);

            return Category::query()->updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'description' => $faker->sentence()]
            );
        });

        $tags = collect([
            'beach',
            'mountain',
            'city',
            'adventure',
            'culinary',
            'hotel',
            'flight',
            'backpacking',
            'weekend',
            'promo',
            'guide',
            'must-visit',
        ])->map(function (string $name) {
            $slug = Str::slug($name);

            return Tag::query()->updateOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
        });

        if (! Post::query()->exists()) {
            $authors = User::query()->pluck('id');

            $uniquePostSlug = function (string $base): string {
                $slug = $base;
                $i = 2;

                while (Post::query()->where('slug', $slug)->exists()) {
                    $slug = $base.'-'.$i;
                    $i++;
                }

                return $slug;
            };

            $postCount = 25;

            for ($i = 0; $i < $postCount; $i++) {
                $title = $faker->sentence(6);
                $status = $faker->boolean(70) ? 'published' : 'draft';

                $post = Post::query()->create([
                    'author_id' => $authors->random(),
                    'title' => $title,
                    'slug' => $uniquePostSlug(Str::slug($title)),
                    'excerpt' => $faker->paragraph(),
                    'content' => collect($faker->paragraphs(6))->implode("\n\n"),
                    'status' => $status,
                    'published_at' => $status === 'published' ? now()->subDays($faker->numberBetween(0, 60)) : null,
                    'meta_title' => $faker->sentence(8),
                    'meta_description' => $faker->sentence(14),
                    'canonical_url' => null,
                    'noindex' => false,
                ]);

                $post->categories()->sync($categories->random(random_int(1, 3))->pluck('id')->all());

                if ($faker->boolean(80)) {
                    $post->tags()->sync($tags->random(random_int(1, 5))->pluck('id')->all());
                }
            }
        }

        if (! MediaItem::query()->exists()) {
            $uploaders = User::query()->pluck('id');

            for ($i = 0; $i < 10; $i++) {
                MediaItem::query()->create([
                    'uploader_id' => $faker->boolean(90) ? $uploaders->random() : null,
                    'title' => $faker->sentence(3),
                ]);
            }
        }
    }
}
