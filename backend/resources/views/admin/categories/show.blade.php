<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Kategori</h2>
            <a class="text-sm font-semibold text-gray-900 hover:underline" href="{{ route('admin.categories.edit', $category) }}">Edit</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-sm text-gray-500">Nama</div>
                    <div class="font-semibold text-gray-900">{{ $category->name }}</div>

                    <div class="mt-4 text-sm text-gray-500">Slug</div>
                    <div class="font-semibold text-gray-900">{{ $category->slug }}</div>

                    @if ($category->description)
                        <div class="mt-4 text-sm text-gray-500">Deskripsi</div>
                        <div class="mt-1 text-gray-800">{{ $category->description }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
