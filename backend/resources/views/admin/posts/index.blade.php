<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post</h2>
            <a class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-black" href="{{ route('admin.posts.create') }}">Tambah</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-900">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-left text-gray-500">
                                <tr>
                                    <th class="py-2 pr-4">Judul</th>
                                    <th class="py-2 pr-4">Status</th>
                                    <th class="py-2 pr-4">Publish</th>
                                    <th class="py-2 pr-4">Author</th>
                                    <th class="py-2 pr-0"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="py-3 pr-4">
                                            <div class="font-semibold text-gray-900">{{ $post->title }}</div>
                                            <div class="text-xs text-gray-500">/{{ $post->slug }}</div>
                                        </td>
                                        <td class="py-3 pr-4">
                                            <span class="inline-flex rounded-full px-2 py-1 text-xs font-semibold {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
                                                {{ $post->status }}
                                            </span>
                                        </td>
                                        <td class="py-3 pr-4 text-gray-700">
                                            {{ $post->published_at?->format('Y-m-d H:i') }}
                                        </td>
                                        <td class="py-3 pr-4 text-gray-700">
                                            {{ $post->author?->name }}
                                        </td>
                                        <td class="py-3 pr-0 text-right">
                                            <a class="text-sm font-semibold text-gray-900 hover:underline" target="_blank" rel="noopener" href="{{ route('articles.show', $post->slug) }}">Lihat</a>
                                            <span class="mx-2 text-gray-300">|</span>
                                            <a class="text-sm font-semibold text-gray-900 hover:underline" href="{{ route('admin.posts.edit', $post) }}">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
