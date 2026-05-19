<script setup>
import { ref, computed, onMounted } from 'vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {
  faSearch,
  faSpinner,
  faChevronRight,
  faCalendarDays,
  faFolderOpen,
  faExclamationTriangle,
  faArrowRight
} from '@fortawesome/free-solid-svg-icons'

// State variables
const posts = ref([])
const loading = ref(false)
const error = ref(null)
const searchQuery = ref('')
const page = ref(1)
const perPage = 9
const hasMore = ref(true)

// Fetch blog posts from WordPress REST API
async function fetchPosts(isLoadMore = false) {
  loading.value = true
  if (!isLoadMore) {
    posts.value = []
    page.value = 1
    hasMore.value = true
  }
  error.value = null

  try {
    const response = await fetch(
      `https://blog.gunztravel.com/wp-json/wp/v2/posts?_embed=1&per_page=${perPage}&page=${page.value}`
    )

    if (!response.ok) {
      throw new Error(`Gagal mengambil data blog (Status: ${response.status})`)
    }

    const data = await response.json()
    
    if (data.length < perPage) {
      hasMore.value = false
    }

    if (isLoadMore) {
      posts.value = [...posts.value, ...data]
    } else {
      posts.value = data
    }
  } catch (err) {
    console.error(err)
    error.value = err.message || 'Terjadi kesalahan saat memuat artikel.'
  } finally {
    loading.value = false
  }
}

// Load more handler
function loadMore() {
  if (loading.value || !hasMore.value) return
  page.value += 1
  fetchPosts(true)
}

// Client-side search and filtering
const filteredPosts = computed(() => {
  if (!searchQuery.value) return posts.value
  const query = searchQuery.value.toLowerCase().trim()
  return posts.value.filter((post) => {
    const title = post.title?.rendered?.toLowerCase() || ''
    const excerpt = post.excerpt?.rendered?.toLowerCase() || ''
    return title.includes(query) || excerpt.includes(query)
  })
})

// Helper: Format date in Indonesian
function formatDate(dateStr) {
  if (!dateStr) return ''
  const date = new Date(dateStr)
  if (isNaN(date.getTime())) return dateStr
  const day = date.getDate()
  const months = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  ]
  const month = months[date.getMonth()]
  const year = date.getFullYear()
  return `${day} ${month} ${year}`
}

// Helper: Extract category name from WP embedded structure
function getCategoryName(post) {
  try {
    const terms = post._embedded?.['wp:term']?.[0]
    if (terms && terms.length > 0) {
      return terms[0].name
    }
  } catch (e) {
    // Fail silently and return default
  }
  return 'Berita'
}

// Helper: Clean WordPress HTML text for excerpts
function stripHtml(html) {
  if (!html) return ''
  let text = html.replace(/<[^>]*>/g, '')
  text = text.replace(/&nbsp;/g, ' ')
             .replace(/&amp;/g, '&')
             .replace(/&lt;/g, '<')
             .replace(/&gt;/g, '>')
             .replace(/&quot;/g, '"')
             .replace(/&#39;/g, "'")
             .replace(/&rsquo;/g, "'")
             .replace(/&ldquo;/g, '"')
             .replace(/&rdquo;/g, '"')
             .replace(/\[&hellip;\]/g, '...')
  return text.trim()
}

// Helper: Extract featured image URL
function getFeaturedImage(post) {
  try {
    const media = post._embedded?.['wp:featuredmedia']?.[0]
    if (media) {
      // Prefer medium large or large size for optimal loading/display quality, or fallback to source_url
      return media.media_details?.sizes?.medium_large?.source_url || media.source_url
    }
  } catch (e) {
    // Fail silently
  }
  return null
}

onMounted(() => {
  fetchPosts()
})
</script>

<template>
  <main class="min-h-screen bg-[#fffdf7] pb-16">
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-orange-50 via-white to-amber-50 px-4 py-16 lg:px-6 lg:py-24">
      <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-brand-100/40 blur-3xl"></div>
      <div class="absolute -left-24 -bottom-24 h-96 w-96 rounded-full bg-amber-100/30 blur-3xl"></div>
      
      <div class="relative mx-auto max-w-7xl text-center">
        <p class="mb-4 text-sm font-extrabold uppercase tracking-widest text-brand-700">Gunz Travel Blog</p>
        <h1 class="text-4xl font-black leading-tight tracking-tight text-slate-950 sm:text-5xl lg:text-6xl">
          Artikel & Tips Perjalanan
        </h1>
        <p class="mx-auto mt-6 max-w-2xl text-base leading-relaxed text-slate-600 sm:text-lg">
          Kumpulan informasi rute travel, rekomendasi wisata Malang-Batu, tips sewa mobil, dan update destinasi terkini dari Gunz Travel.
        </p>

        <!-- Search Bar -->
        <div class="mx-auto mt-10 max-w-md">
          <div class="relative flex items-center rounded-full border border-slate-200 bg-white p-1.5 shadow-soft focus-within:border-brand-400 focus-within:ring-2 focus-within:ring-brand-100">
            <span class="pl-4 text-slate-400">
              <font-awesome-icon :icon="faSearch" />
            </span>
            <input
              type="text"
              v-model="searchQuery"
              placeholder="Cari artikel..."
              class="w-full bg-transparent px-3 py-2 text-sm text-slate-800 placeholder-slate-400 outline-none"
              aria-label="Cari artikel blog"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Blog Posts List -->
    <section class="mx-auto max-w-7xl px-4 py-12 lg:px-6">
      <!-- Loading State (Initially fetching data) -->
      <div v-if="loading && posts.length === 0" class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <div
          v-for="i in 6"
          :key="i"
          class="overflow-hidden rounded-[2rem] border border-slate-200/60 bg-white p-5 shadow-soft"
        >
          <div class="aspect-video w-full animate-pulse rounded-2xl bg-slate-200"></div>
          <div class="mt-6 space-y-3">
            <div class="h-4 w-24 animate-pulse rounded-full bg-slate-200"></div>
            <div class="h-6 w-full animate-pulse rounded bg-slate-200"></div>
            <div class="h-6 w-4/5 animate-pulse rounded bg-slate-200"></div>
            <div class="h-4 w-full animate-pulse rounded bg-slate-200"></div>
            <div class="h-4 w-2/3 animate-pulse rounded bg-slate-200"></div>
            <div class="pt-4">
              <div class="h-4 w-32 animate-pulse rounded bg-slate-200"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Error State -->
      <div v-else-if="error" class="rounded-[2rem] border border-red-100 bg-red-50/50 p-8 text-center sm:p-12">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-3xl bg-red-100 text-2xl text-red-700">
          <font-awesome-icon :icon="faExclamationTriangle" />
        </div>
        <h3 class="mt-6 text-xl font-black text-slate-950">Gagal Memuat Artikel</h3>
        <p class="mt-2 text-sm text-slate-600 max-w-md mx-auto">{{ error }}</p>
        <button
          @click="fetchPosts(false)"
          class="mt-6 inline-flex items-center gap-2 rounded-full bg-brand-500 px-6 py-3 text-sm font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white"
        >
          Coba Lagi
        </button>
      </div>

      <!-- Empty State -->
      <div v-else-if="filteredPosts.length === 0" class="rounded-[2rem] border border-slate-200 bg-white p-12 text-center">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-3xl bg-brand-50 text-2xl text-brand-700">
          <font-awesome-icon :icon="faSearch" />
        </div>
        <h3 class="mt-6 text-xl font-black text-slate-950">Artikel Tidak Ditemukan</h3>
        <p class="mt-2 text-sm text-slate-600 max-w-md mx-auto">
          Tidak ada artikel yang cocok dengan kata kunci "{{ searchQuery }}". Cobalah kata kunci lainnya.
        </p>
        <button
          @click="searchQuery = ''"
          class="mt-6 inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-extrabold text-slate-800 transition hover:bg-brand-50"
        >
          Bersihkan Pencarian
        </button>
      </div>

      <!-- Posts Grid -->
      <div v-else class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <router-link
          v-for="post in filteredPosts"
          :key="post.id"
          :to="'/blog/' + post.slug"
          class="group flex flex-col overflow-hidden rounded-[2rem] border border-slate-200/60 bg-white p-5 shadow-soft transition-all duration-300 hover:-translate-y-1.5 hover:border-brand-200 hover:shadow-xl"
        >
          <!-- Thumbnail Image -->
          <div class="relative aspect-video w-full overflow-hidden rounded-2xl bg-slate-100">
            <img
              v-if="getFeaturedImage(post)"
              :src="getFeaturedImage(post)"
              :alt="post.title?.rendered"
              class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
              loading="lazy"
            />
            <!-- Fallback design if no image -->
            <div v-else class="flex h-full w-full items-center justify-center bg-gradient-to-br from-brand-500/20 via-amber-50 to-brand-100 text-center">
              <span class="text-sm font-bold text-brand-800">Gunz Travel</span>
            </div>
            
            <!-- Category Badge -->
            <span class="absolute left-3 top-3 inline-flex items-center gap-1.5 rounded-full bg-brand-500 px-3.5 py-1.5 text-xs font-extrabold text-ink-900 shadow-sm">
              <font-awesome-icon :icon="faFolderOpen" class="text-[10px]" />
              {{ getCategoryName(post) }}
            </span>
          </div>

          <!-- Post Content Details -->
          <div class="flex flex-1 flex-col pt-6">
            <!-- Metadata (Date) -->
            <div class="flex items-center gap-2 text-xs font-bold text-slate-500">
              <font-awesome-icon :icon="faCalendarDays" />
              <span>{{ formatDate(post.date) }}</span>
            </div>

            <!-- Title -->
            <h2 class="mt-3 text-xl font-black leading-snug text-slate-950 transition group-hover:text-brand-700" v-html="post.title?.rendered">
            </h2>

            <!-- Excerpt -->
            <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-slate-600" v-html="stripHtml(post.excerpt?.rendered)">
            </p>

            <!-- Card Action (Read More link) -->
            <div class="mt-auto pt-6 border-t border-slate-100 flex items-center justify-between text-sm font-extrabold text-brand-800">
              <span>Baca Selengkapnya</span>
              <font-awesome-icon :icon="faChevronRight" class="h-3 w-3 transition-transform duration-300 group-hover:translate-x-1" />
            </div>
          </div>
        </router-link>
      </div>

      <!-- Pagination / Load More Button -->
      <div v-if="hasMore && filteredPosts.length > 0 && searchQuery === ''" class="mt-16 text-center">
        <button
          @click="loadMore"
          :disabled="loading"
          class="cta-glow inline-flex items-center gap-2.5 rounded-full bg-brand-500 px-8 py-4 text-sm font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white disabled:opacity-70 disabled:cursor-not-allowed"
        >
          <font-awesome-icon v-if="loading" :icon="faSpinner" class="animate-spin" />
          <span>{{ loading ? 'Memuat...' : 'Muat Lebih Banyak' }}</span>
          <font-awesome-icon v-if="!loading" :icon="faArrowRight" class="text-xs" />
        </button>
      </div>
    </section>
  </main>
</template>
