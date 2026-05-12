<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Post</h2>
            <div class="flex flex-wrap items-center gap-3">
                <a class="text-sm font-semibold text-gray-900 hover:underline" href="{{ route('admin.posts.index') }}">Kembali</a>
                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Hapus post ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-sm font-semibold text-red-700 hover:underline" type="submit">Hapus</button>
                </form>
            </div>
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
                    <div class="mb-6 text-sm text-gray-600">
                        URL: <span class="font-semibold text-gray-900">/artikel/{{ $post->slug }}</span>
                    </div>

                    <form class="space-y-6" method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <div class="flex items-center justify-between gap-3">
                                <x-input-label for="title" value="Judul" />
                                <button type="button" class="ai-btn" data-ai-field="title" aria-label="Generate judul">
                                    <span class="ai-btn__icon" aria-hidden="true">✦</span>
                                </button>
                            </div>
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $post->title)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="slug" value="Slug" />
                            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', $post->slug)" />
                            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                        </div>

                        <div>
                            <div class="flex items-center justify-between gap-3">
                                <x-input-label for="excerpt" value="Excerpt (opsional)" />
                                <button type="button" class="ai-btn" data-ai-field="excerpt" aria-label="Generate excerpt">
                                    <span class="ai-btn__icon" aria-hidden="true">✦</span>
                                </button>
                            </div>
                            <textarea id="excerpt" name="excerpt" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('excerpt')" />
                        </div>

                        <div>
                            <div class="flex items-center justify-between gap-3">
                                <x-input-label for="content" value="Konten" />
                                <button type="button" class="ai-btn" data-ai-field="content" aria-label="Generate konten">
                                    <span class="ai-btn__icon" aria-hidden="true">✦</span>
                                </button>
                            </div>
                            <textarea id="content" name="content" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="14">{{ old('content', $post->content) }}</textarea>
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
                                    <option value="draft" @selected(old('status', $post->status) === 'draft')>draft</option>
                                    <option value="published" @selected(old('status', $post->status) === 'published')>published</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>
                            <div>
                                <x-input-label for="published_at" value="Tanggal publish (opsional)" />
                                <x-text-input id="published_at" name="published_at" type="datetime-local" class="mt-1 block w-full" :value="old('published_at', optional($post->published_at)->format('Y-m-d\\TH:i'))" />
                                <x-input-error class="mt-2" :messages="$errors->get('published_at')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label value="Kategori" />
                            <div class="mt-2 grid gap-2 sm:grid-cols-2">
                                @foreach ($categories as $category)
                                    <label class="flex items-center gap-2 text-sm">
                                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(in_array($category->id, old('category_ids', $selectedCategoryIds))) />
                                        <span class="text-gray-800">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('category_ids')" />
                        </div>

                        <div>
                            <x-input-label for="tags" value="Tag (pisahkan dengan koma)" />
                            <x-text-input id="tags" name="tags" type="text" class="mt-1 block w-full" :value="old('tags', $tagsCsv)" />
                            <x-input-error class="mt-2" :messages="$errors->get('tags')" />
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <div class="flex items-center justify-between gap-3">
                                    <x-input-label for="cover_file" value="Cover (opsional)" />
                                    @if ($post->getFirstMediaUrl('cover'))
                                        <a class="text-xs font-semibold text-gray-700 hover:underline" target="_blank" rel="noopener" href="{{ $post->getFirstMediaUrl('cover') }}">Lihat</a>
                                    @endif
                                </div>
                                @if ($post->getFirstMediaUrl('cover'))
                                    <img class="mt-2 h-28 w-auto rounded-md border border-gray-200" src="{{ $post->getFirstMediaUrl('cover', 'thumb') }}" alt="" />
                                @endif
                                <input id="cover_file" name="cover_file" type="file" class="mt-2 block w-full text-sm" />
                                <x-input-error class="mt-2" :messages="$errors->get('cover_file')" />
                            </div>
                            <div>
                                <div class="flex items-center justify-between gap-3">
                                    <x-input-label for="og_file" value="OG Image (opsional)" />
                                    @if ($post->getFirstMediaUrl('og'))
                                        <a class="text-xs font-semibold text-gray-700 hover:underline" target="_blank" rel="noopener" href="{{ $post->getFirstMediaUrl('og') }}">Lihat</a>
                                    @endif
                                </div>
                                @if ($post->getFirstMediaUrl('og'))
                                    <img class="mt-2 h-28 w-auto rounded-md border border-gray-200" src="{{ $post->getFirstMediaUrl('og', 'thumb') }}" alt="" />
                                @endif
                                <input id="og_file" name="og_file" type="file" class="mt-2 block w-full text-sm" />
                                <x-input-error class="mt-2" :messages="$errors->get('og_file')" />
                            </div>
                        </div>

                        <div class="rounded-lg border border-gray-200 p-4">
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <div class="flex items-center justify-between gap-3">
                                        <x-input-label for="meta_title" value="Meta title (opsional)" />
                                        <button type="button" class="ai-btn" data-ai-field="meta_title" aria-label="Generate meta title">
                                            <span class="ai-btn__icon" aria-hidden="true">✦</span>
                                        </button>
                                    </div>
                                    <x-text-input id="meta_title" name="meta_title" type="text" class="mt-1 block w-full" :value="old('meta_title', $post->meta_title)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('meta_title')" />
                                </div>
                                <div>
                                    <x-input-label for="canonical_url" value="Canonical URL (opsional)" />
                                    <x-text-input id="canonical_url" name="canonical_url" type="text" class="mt-1 block w-full" :value="old('canonical_url', $post->canonical_url)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('canonical_url')" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="flex items-center justify-between gap-3">
                                    <x-input-label for="meta_description" value="Meta description (opsional)" />
                                    <button type="button" class="ai-btn" data-ai-field="meta_description" aria-label="Generate meta description">
                                        <span class="ai-btn__icon" aria-hidden="true">✦</span>
                                    </button>
                                </div>
                                <textarea id="meta_description" name="meta_description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="3">{{ old('meta_description', $post->meta_description) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('meta_description')" />
                            </div>

                            <label class="mt-4 flex items-center gap-2 text-sm">
                                <input type="checkbox" name="noindex" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(old('noindex', $post->noindex)) />
                                <span class="text-gray-800">Noindex</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-3">
                            <x-primary-button>Simpan</x-primary-button>
                            <a class="text-sm font-semibold text-gray-900 hover:underline" href="{{ route('admin.posts.show', $post) }}">Preview Admin</a>
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

        .ai-btn {
            display: inline-flex;
            height: 34px;
            width: 34px;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid rgb(229 231 235);
            background: white;
            color: rgb(17 24 39);
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.06);
        }

        .ai-btn:hover {
            background: rgb(249 250 251);
        }

        .ai-btn[disabled] {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .ai-btn__icon {
            font-weight: 900;
            color: rgb(232 121 0);
        }
    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        const uploadUrl = '{{ route('admin.media.ckeditor') }}'
        const mediaJsonUrl = '{{ route('admin.media.json') }}'
        const aiGenerateUrl = '{{ route('admin.ai.generate') }}'

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

        function setAiLoading(btn, loading) {
            if (!btn) return
            btn.disabled = loading
            btn.dataset.loading = loading ? '1' : ''
        }

        function getTopic() {
            const titleEl = document.querySelector('#title')
            return (titleEl?.value || '').trim()
        }

        function getFieldValue(field) {
            if (field === 'content') {
                return editorInstance ? editorInstance.getData() : (document.querySelector('#content')?.value || '')
            }

            const el = document.querySelector(`#${field}`)
            return (el?.value || '').trim()
        }

        function setFieldValue(field, value) {
            if (field === 'content') {
                if (editorInstance) {
                    editorInstance.setData(value)
                } else {
                    const el = document.querySelector('#content')
                    if (el) el.value = value
                }
                return
            }

            const el = document.querySelector(`#${field}`)
            if (el) el.value = value
        }

        async function generateField(field, btn) {
            const topic = getTopic()
            if (!topic) {
                alert('Isi Judul dulu untuk menentukan topik.')
                return
            }

            setAiLoading(btn, true)

            try {
                const res = await fetch(aiGenerateUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        topic,
                        field,
                        current: getFieldValue(field),
                    }),
                })

                const data = await res.json().catch(() => ({}))
                if (!res.ok) {
                    throw new Error(data?.message || 'AI gagal')
                }

                if (typeof data?.text !== 'string') {
                    throw new Error('Response AI tidak valid')
                }

                setFieldValue(field, data.text)
            } catch (e) {
                alert(e?.message || 'AI gagal')
            } finally {
                setAiLoading(btn, false)
            }
        }

        document.querySelectorAll('button.ai-btn[data-ai-field]').forEach((btn) => {
            btn.addEventListener('click', () => {
                const field = btn.getAttribute('data-ai-field')
                if (!field || btn.dataset.loading === '1') return
                generateField(field, btn)
            })
        })

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
