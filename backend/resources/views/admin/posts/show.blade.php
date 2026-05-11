<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Preview</h2>
            <div class="flex items-center gap-3">
                <a class="text-sm font-semibold text-gray-900 hover:underline" href="{{ route('admin.posts.edit', $post) }}">Edit</a>
                <a class="text-sm font-semibold text-gray-900 hover:underline" href="{{ route('admin.posts.index') }}">Kembali</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $post->title }}</h1>
                    <div class="mt-2 text-sm text-gray-500">
                        <span class="font-semibold">{{ $post->status }}</span>
                        @if ($post->published_at)
                            <span class="mx-2">•</span>
                            <span>{{ $post->published_at->format('Y-m-d H:i') }}</span>
                        @endif
                    </div>

                    @if ($post->getFirstMediaUrl('cover'))
                        <img class="mt-6 w-full rounded-lg border border-gray-200" src="{{ $post->getFirstMediaUrl('cover') }}" alt="" />
                    @endif

                    @if ($post->excerpt)
                        <p class="mt-6 text-gray-700">{{ $post->excerpt }}</p>
                    @endif

                    <div class="prose prose-slate mt-8 max-w-none">
                        {!! $post->content !!}
                    </div>
                </div>
            </article>
        </div>
    </div>
</x-app-layout>
