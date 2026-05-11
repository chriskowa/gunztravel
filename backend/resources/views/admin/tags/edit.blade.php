<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Tag</h2>
            <div class="flex items-center gap-3">
                <a class="text-sm font-semibold text-gray-900 hover:underline" href="{{ route('admin.tags.index') }}">Kembali</a>
                <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}" onsubmit="return confirm('Hapus tag ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-sm font-semibold text-red-700 hover:underline" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-900">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="space-y-6" method="POST" action="{{ route('admin.tags.update', $tag) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $tag->name)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="slug" value="Slug" />
                            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', $tag->slug)" />
                            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                        </div>

                        <div class="flex items-center gap-3">
                            <x-primary-button>Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
