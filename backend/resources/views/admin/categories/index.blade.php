<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kategori</h2>
            <a class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-black" href="{{ route('admin.categories.create') }}">Tambah</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
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
                                    <th class="py-2 pr-4">Nama</th>
                                    <th class="py-2 pr-4">Slug</th>
                                    <th class="py-2 pr-0"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="py-3 pr-4 font-semibold text-gray-900">{{ $category->name }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $category->slug }}</td>
                                        <td class="py-3 pr-0 text-right">
                                            <a class="text-sm font-semibold text-gray-900 hover:underline" href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
