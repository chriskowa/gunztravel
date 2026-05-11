<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin</h2>
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
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                        <a class="rounded-lg border border-gray-200 px-4 py-3 hover:bg-gray-50" href="{{ route('admin.posts.index') }}">Kelola Post</a>
                        <a class="rounded-lg border border-gray-200 px-4 py-3 hover:bg-gray-50" href="{{ route('admin.categories.index') }}">Kelola Kategori</a>
                        <a class="rounded-lg border border-gray-200 px-4 py-3 hover:bg-gray-50" href="{{ route('admin.tags.index') }}">Kelola Tag</a>
                        <a class="rounded-lg border border-gray-200 px-4 py-3 hover:bg-gray-50" href="{{ route('admin.media.index') }}">Media Library</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
