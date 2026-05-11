<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Media Library</h2>
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
                    <form class="mb-8 grid gap-4 sm:grid-cols-[1fr_auto]" method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <x-input-label for="title" value="Judul (opsional)" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                            <div>
                                <x-input-label for="file" value="File" />
                                <input id="file" name="file" type="file" class="mt-2 block w-full text-sm" required />
                                <x-input-error class="mt-2" :messages="$errors->get('file')" />
                            </div>
                        </div>
                        <div class="flex items-end">
                            <x-primary-button>Upload</x-primary-button>
                        </div>
                    </form>

                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($mediaItems as $item)
                            @php
                                $media = $item->getFirstMedia('file');
                            @endphp
                            <div class="rounded-lg border border-gray-200 p-3">
                                <div class="aspect-video overflow-hidden rounded-md bg-gray-50">
                                    @if ($media)
                                        <img class="h-full w-full object-cover" src="{{ $media->getUrl('thumb') ?? $media->getUrl() }}" alt="" />
                                    @endif
                                </div>

                                <div class="mt-3">
                                    <div class="truncate text-sm font-semibold text-gray-900">{{ $item->title ?: ($media?->name ?? 'Media') }}</div>
                                    <div class="mt-1 truncate text-xs text-gray-500">{{ $media?->getUrl() }}</div>
                                </div>

                                <div class="mt-3 flex items-center justify-between gap-3">
                                    <button type="button" class="text-xs font-semibold text-gray-900 hover:underline" onclick="copyText('{{ $media?->getUrl() }}')">Copy URL</button>
                                    <form method="POST" action="{{ route('admin.media.destroy', $item) }}" onsubmit="return confirm('Hapus media ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-xs font-semibold text-red-700 hover:underline" type="submit">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $mediaItems->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyText(text) {
            if (!text) return
            navigator.clipboard.writeText(text)
        }
    </script>
</x-app-layout>
