@extends('public.layout')

@section('title', $post->meta_title ?: $post->title)
@section('meta_description', $post->meta_description ?: ($post->excerpt ?: ''))
@section('canonical', $post->canonical_url ?: url()->current())
@section('robots', $post->noindex ? 'noindex, nofollow' : 'index, follow')
@section('og_title', $post->meta_title ?: $post->title)
@section('og_description', $post->meta_description ?: ($post->excerpt ?: ''))
@section('og_image', $post->getFirstMediaUrl('og') ?: $post->getFirstMediaUrl('cover'))

@section('content')
    @php
        $coverUrl = $post->getFirstMediaUrl('cover');
        $ogUrl = $post->getFirstMediaUrl('og');
    @endphp

    <article class="rounded-2xl border border-gray-200 bg-white p-6">
        <div class="text-xs font-semibold text-gray-500">
            {{ $post->published_at?->format('Y-m-d') ?? $post->created_at->format('Y-m-d') }}
        </div>
        <h1 class="mt-2 text-3xl font-black tracking-tight text-gray-900">{{ $post->title }}</h1>

        @if ($post->categories->count() || $post->tags->count())
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach ($post->categories as $category)
                    <a class="rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-700 hover:bg-gray-200" href="{{ route('categories.show', $category->slug) }}">
                        {{ $category->name }}
                    </a>
                @endforeach
                @foreach ($post->tags as $tag)
                    <a class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-700 hover:bg-indigo-100" href="{{ route('tags.show', $tag->slug) }}">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif

        @if ($coverUrl)
            <img class="mt-6 w-full rounded-xl border border-gray-200" src="{{ $coverUrl }}" alt="" loading="lazy" decoding="async" />
        @endif

        @if ($ogUrl)
            <div class="mt-6 rounded-xl border border-gray-200 bg-gray-50 p-4">
                <div class="text-xs font-extrabold text-gray-700">OG Image</div>
                <img class="mt-3 w-full rounded-lg border border-gray-200 bg-white" src="{{ $ogUrl }}" alt="" loading="lazy" decoding="async" />
            </div>
        @endif

        @if ($post->excerpt)
            <p class="mt-6 text-gray-700">{{ $post->excerpt }}</p>
        @endif

        <div class="mt-8 space-y-4 text-gray-800">
            {!! $post->content !!}
        </div>
    </article>

    <div class="mt-8">
        <a class="text-sm font-semibold text-gray-900 hover:underline" href="{{ route('articles.index') }}">← Kembali ke artikel</a>
    </div>
@endsection
