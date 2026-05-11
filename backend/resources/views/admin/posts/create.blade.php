<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Post</h2>
            <a class="text-sm font-semibold text-gray-900 hover:underline" href="{{ route('admin.posts.index') }}">Kembali</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="space-y-6" method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="title" value="Judul" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="slug" value="Slug (opsional)" />
                            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug')" />
                            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                        </div>

                        <div>
                            <x-input-label for="excerpt" value="Excerpt (opsional)" />
                            <textarea id="excerpt" name="excerpt" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="3">{{ old('excerpt') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('excerpt')" />
                        </div>

                        <div>
                            <x-input-label for="content" value="Konten" />
                            <textarea id="content" name="content" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="14">{{ old('content') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                            <div class="mt-3 flex flex-wrap items-center gap-3">
                                <button id="openMediaLibrary" type="button" class="inline-flex items-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-50">
                                    Media Library
                                </button>
                                <div class="text-xs text-gray-500">Pilih gambar yang sudah ada lalu sisipkan ke konten.</div>
                            </div>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <x-input-label for="status" value="Status" />
                                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="draft" @selected(old('status', 'draft') === 'draft')>draft</option>
                                    <option value="published" @selected(old('status') === 'published')>published</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>
                            <div>
                                <x-input-label for="published_at" value="Tanggal publish (opsional)" />
                                <x-text-input id="published_at" name="published_at" type="datetime-local" class="mt-1 block w-full" :value="old('published_at')" />
                                <x-input-error class="mt-2" :messages="$errors->get('published_at')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label value="Kategori" />
                            <div class="mt-2 grid gap-2 sm:grid-cols-2">
                                @foreach ($categories as $category)
                                    <label class="flex items-center gap-2 text-sm">
                                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(in_array($category->id, old('category_ids', []))) />
                                        <span class="text-gray-800">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('category_ids')" />
                        </div>

                        <div>
                            <x-input-label for="tags" value="Tag (pisahkan dengan koma)" />
                            <x-text-input id="tags" name="tags" type="text" class="mt-1 block w-full" :value="old('tags')" />
                            <x-input-error class="mt-2" :messages="$errors->get('tags')" />
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <x-input-label for="cover_file" value="Cover (opsional)" />
                                <input id="cover_file" name="cover_file" type="file" class="mt-1 block w-full text-sm" />
                                <x-input-error class="mt-2" :messages="$errors->get('cover_file')" />
                            </div>
                            <div>
                                <x-input-label for="og_file" value="OG Image (opsional)" />
                                <input id="og_file" name="og_file" type="file" class="mt-1 block w-full text-sm" />
                                <x-input-error class="mt-2" :messages="$errors->get('og_file')" />
                            </div>
                        </div>

                        <div class="rounded-lg border border-gray-200 p-4">
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <x-input-label for="meta_title" value="Meta title (opsional)" />
                                    <x-text-input id="meta_title" name="meta_title" type="text" class="mt-1 block w-full" :value="old('meta_title')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('meta_title')" />
                                </div>
                                <div>
                                    <x-input-label for="canonical_url" value="Canonical URL (opsional)" />
                                    <x-text-input id="canonical_url" name="canonical_url" type="text" class="mt-1 block w-full" :value="old('canonical_url')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('canonical_url')" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="meta_description" value="Meta description (opsional)" />
                                <textarea id="meta_description" name="meta_description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="3">{{ old('meta_description') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('meta_description')" />
                            </div>

                            <label class="mt-4 flex items-center gap-2 text-sm">
                                <input type="checkbox" name="noindex" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(old('noindex')) />
                                <span class="text-gray-800">Noindex</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-3">
                            <x-primary-button>Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="mediaModal" class="fixed inset-0 z-50 hidden">
        <div id="mediaModalBackdrop" class="absolute inset-0 bg-gray-900/40"></div>
        <div class="relative mx-auto mt-10 w-[95vw] max-w-5xl rounded-2xl bg-white shadow-soft">
            <div class="flex items-center justify-between gap-4 border-b border-gray-100 px-6 py-4">
                <div>
                    <div class="text-lg font-extrabold text-gray-900">Media Library</div>
                    <div class="mt-1 text-xs text-gray-500">Klik gambar untuk menyisipkan ke editor.</div>
                </div>
                <button id="closeMediaLibrary" type="button" class="rounded-md border border-gray-200 bg-white px-3 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-50">
                    Tutup
                </button>
            </div>
            <div class="px-6 py-4">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <input id="mediaSearch" type="text" placeholder="Cari judul..." class="w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-md" />
                    <div id="mediaStatus" class="text-sm text-gray-600"></div>
                </div>

                <div id="mediaGrid" class="mt-5 grid gap-4 sm:grid-cols-3 lg:grid-cols-4"></div>
            </div>
        </div>
    </div>

    <style>
        .ck-editor__editable {
            min-height: 520px;
        }
    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        const uploadUrl = '{{ route('admin.media.ckeditor') }}'
        const mediaJsonUrl = '{{ route('admin.media.json') }}'

        class CkUploadAdapter {
            constructor(loader) {
                this.loader = loader
                this.xhr = null
            }

            upload() {
                return this.loader.file.then((file) => new Promise((resolve, reject) => {
                    const xhr = (this.xhr = new XMLHttpRequest())
                    xhr.open('POST', uploadUrl, true)
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken)
                    xhr.responseType = 'json'

                    xhr.onload = () => {
                        if (xhr.status < 200 || xhr.status >= 300) {
                            reject('Upload gagal')
                            return
                        }

                        const response = xhr.response
                        if (!response || typeof response.url !== 'string' || response.url === '') {
                            reject('Response tidak valid')
                            return
                        }

                        resolve({ default: response.url })
                    }

                    xhr.onerror = () => reject('Upload gagal')

                    const data = new FormData()
                    data.append('upload', file, file.name)
                    xhr.send(data)
                }))
            }

            abort() {
                if (this.xhr) {
                    this.xhr.abort()
                }
            }
        }

        function CkUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => new CkUploadAdapter(loader)
        }

        const textarea = document.querySelector('#content')
        const form = textarea.closest('form')
        const modal = document.querySelector('#mediaModal')
        const modalBackdrop = document.querySelector('#mediaModalBackdrop')
        const openMediaBtn = document.querySelector('#openMediaLibrary')
        const closeMediaBtn = document.querySelector('#closeMediaLibrary')
        const mediaGrid = document.querySelector('#mediaGrid')
        const mediaStatus = document.querySelector('#mediaStatus')
        const mediaSearch = document.querySelector('#mediaSearch')
        let cachedMediaItems = []
        let editorInstance = null

        function openModal() {
            modal.classList.remove('hidden')
        }

        function closeModal() {
            modal.classList.add('hidden')
        }

        function renderMedia(items) {
            mediaGrid.innerHTML = ''

            if (!items.length) {
                mediaGrid.innerHTML = '<div class="rounded-xl border border-gray-200 bg-gray-50 p-4 text-sm text-gray-600 sm:col-span-3 lg:col-span-4">Tidak ada media.</div>'
                return
            }

            for (const item of items) {
                const button = document.createElement('button')
                button.type = 'button'
                button.className =
                    'group overflow-hidden rounded-xl border border-gray-200 bg-white text-left shadow-sm transition hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-soft focus:outline-none focus:ring-2 focus:ring-indigo-500'
                button.dataset.url = item.url || ''

                const thumb = item.thumb || item.url || ''
                const title = item.title || 'Media'

                button.innerHTML = `
                    <div class="aspect-[4/3] w-full bg-gray-100">
                        ${thumb ? `<img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="${thumb}" alt="" loading="lazy" decoding="async" />` : ''}
                    </div>
                    <div class="p-3">
                        <div class="truncate text-sm font-semibold text-gray-900">${title}</div>
                    </div>
                `

                button.addEventListener('click', () => {
                    const url = button.dataset.url
                    if (!url || !editorInstance) return

                    editorInstance.model.change((writer) => {
                        const imageElement = writer.createElement('imageBlock', { src: url })
                        editorInstance.model.insertContent(imageElement, editorInstance.model.document.selection)
                    })
                    closeModal()
                })

                mediaGrid.appendChild(button)
            }
        }

        async function loadMedia() {
            mediaStatus.textContent = 'Memuat...'
            try {
                const res = await fetch(mediaJsonUrl, { headers: { Accept: 'application/json' } })
                if (!res.ok) throw new Error('Fetch gagal')
                const data = await res.json()
                cachedMediaItems = Array.isArray(data) ? data : Array.isArray(data?.items) ? data.items : []
                mediaStatus.textContent = `${cachedMediaItems.length} item`
                renderMedia(cachedMediaItems)
            } catch {
                mediaStatus.textContent = 'Gagal memuat media'
                mediaGrid.innerHTML =
                    '<div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800 sm:col-span-3 lg:col-span-4">Gagal memuat media. Pastikan kamu sudah login.</div>'
            }
        }

        function filterMedia() {
            const q = (mediaSearch.value || '').toLowerCase().trim()
            if (!q) {
                renderMedia(cachedMediaItems)
                return
            }
            renderMedia(
                cachedMediaItems.filter((x) => {
                    const title = String(x.title || '').toLowerCase()
                    return title.includes(q)
                }),
            )
        }

        openMediaBtn.addEventListener('click', async () => {
            openModal()
            if (!cachedMediaItems.length) {
                await loadMedia()
            } else {
                renderMedia(cachedMediaItems)
            }
            mediaSearch.value = ''
            mediaSearch.focus()
        })

        closeMediaBtn.addEventListener('click', closeModal)
        modalBackdrop.addEventListener('click', closeModal)
        mediaSearch.addEventListener('input', filterMedia)

        ClassicEditor
            .create(textarea, {
                extraPlugins: [CkUploadAdapterPlugin],
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|',
                        'heading',
                        '|',
                        'bold', 'italic',
                        '|',
                        'bulletedList', 'numberedList',
                        '|',
                        'link', 'insertTable', 'uploadImage',
                        '|',
                        'blockQuote',
                    ],
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
                },
            })
            .then((editor) => {
                editorInstance = editor
                form.addEventListener('submit', () => {
                    textarea.value = editor.getData()
                })
            })
            .catch(() => {})
    </script>
</x-app-layout>
