@extends('public.layout')

@section('title', 'Tag: '.$tag->name)
@section('meta_description', 'Artikel dengan tag '.$tag->name)
@section('canonical', url()->current())

@section('content')
    <div class="rounded-3xl border border-gray-200 bg-gradient-to-br from-brand-50 via-white to-white p-6 shadow-sm sm:p-10">
        <div class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-xs font-extrabold text-gray-700 shadow-sm">
            Tag
        </div>
        <h1 class="mt-4 text-3xl font-black tracking-tight text-gray-900 sm:text-4xl">#{{ $tag->name }}</h1>
        <p class="mt-3 max-w-2xl text-gray-600">Artikel dengan tag ini.</p>
    </div>

    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($posts as $post)
            @php
                $date = $post->published_at?->format('Y-m-d') ?? $post->created_at->format('Y-m-d');
                $cover = $post->getFirstMediaUrl('cover', 'thumb');
                $excerpt = $post->excerpt ?: \Illuminate\Support\Str::limit(trim(strip_tags((string) $post->content)), 140);
            @endphp

            <a class="group overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-soft" href="{{ route('articles.show', $post->slug) }}">
                <div class="relative aspect-[16/10] w-full bg-gray-100">
                    @if ($cover)
                        <img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $cover }}" alt="" loading="lazy" decoding="async" />
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-brand-50 via-white to-gray-50"></div>
                    @endif
                </div>

                <div class="p-5">
                    <div class="flex items-center justify-between gap-4">
                        <div class="text-xs font-semibold text-gray-500">{{ $date }}</div>
                        @if ($post->categories->count())
                            <div class="flex flex-wrap items-center justify-end gap-2">
                                @foreach ($post->categories->take(1) as $category)
                                    <span class="rounded-full bg-brand-50 px-3 py-1 text-xs font-bold text-brand-800">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="mt-3 text-lg font-black tracking-tight text-gray-900 group-hover:text-brand-800">
                        {{ $post->title }}
                    </div>

                    @if ($excerpt)
                        <div class="mt-2 text-sm leading-6 text-gray-600">{{ $excerpt }}</div>
                    @endif

                    <div class="mt-5 inline-flex items-center gap-2 text-sm font-extrabold text-brand-700">
                        Baca selengkapnya <span class="transition group-hover:translate-x-0.5">→</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="rounded-2xl border border-gray-200 bg-white p-6 text-gray-600 sm:col-span-2 lg:col-span-3">
                Belum ada artikel dengan tag ini.
            </div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $posts->links() }}
    </div>
@endsection
