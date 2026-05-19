<script setup>
import { ref, watch, onMounted, onUnmounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {
  faCalendarDays,
  faFolderOpen,
  faUser,
  faClock,
  faArrowLeft,
  faChevronRight,
  faSpinner,
  faExclamationTriangle
} from '@fortawesome/free-solid-svg-icons'
import { faWhatsapp } from '@fortawesome/free-brands-svg-icons'

const route = useRoute()
const router = useRouter()

// State
const post = ref(null)
const recentPosts = ref([])
const loading = ref(true)
const loadingRecent = ref(true)
const error = ref(null)

const phone = '6281805093192'
const siteName = 'Gunz Travel'
const siteUrl = 'https://gunztravel.com'

// Reading time calculation helper
function getReadingTime(htmlContent) {
  if (!htmlContent) return 1
  const text = htmlContent.replace(/<[^>]*>/g, '')
  const words = text.trim().split(/\s+/).length
  return Math.max(1, Math.round(words / 200)) // 200 words per minute
}

// Formatting Indonesian Date
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

// Category extraction helper
function getCategoryName(p) {
  try {
    const terms = p._embedded?.['wp:term']?.[0]
    if (terms && terms.length > 0) {
      return terms[0].name
    }
  } catch (e) {}
  return 'Berita'
}

// Strip HTML for metadata description
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
  return text.trim()
}

// Extract featured image
function getFeaturedImage(p) {
  try {
    const media = p._embedded?.['wp:featuredmedia']?.[0]
    if (media) {
      return media.media_details?.sizes?.large?.source_url || media.source_url
    }
  } catch (e) {}
  return null
}

// Fetch single post details by slug
async function fetchPostDetail(slug) {
  loading.value = true
  error.value = null
  post.value = null

  try {
    const response = await fetch(
      `https://blog.gunztravel.com/wp-json/wp/v2/posts?slug=${slug}&_embed=1`
    )

    if (!response.ok) {
      throw new Error(`Gagal mengambil artikel (Status: ${response.status})`)
    }

    const data = await response.json()
    
    if (data.length === 0) {
      // Post not found
      error.value = 'Artikel tidak ditemukan'
      return
    }

    const fetchedPost = data[0]
    post.value = fetchedPost
    
    // Update head SEO metadata
    updateMetaTags(fetchedPost)
    injectStructuredData(fetchedPost)
    
  } catch (err) {
    console.error(err)
    error.value = err.message || 'Terjadi kesalahan saat memuat artikel.'
  } finally {
    loading.value = false
  }
}

// Fetch 3 recent posts (excluding current post)
async function fetchRecentPosts(excludeId) {
  loadingRecent.value = true
  try {
    const response = await fetch(
      `https://blog.gunztravel.com/wp-json/wp/v2/posts?_embed=1&per_page=4`
    )
    if (response.ok) {
      const data = await response.json()
      // Filter out current post
      recentPosts.value = data.filter(p => p.id !== excludeId).slice(0, 3)
    }
  } catch (err) {
    console.error('Gagal memuat artikel rekomendasi:', err)
  } finally {
    loadingRecent.value = false
  }
}

// Programmatic SEO Updates
function updateMetaTags(p) {
  const postTitle = p.title?.rendered || ''
  const fullTitle = `${postTitle} | ${siteName}`
  const excerpt = stripHtml(p.excerpt?.rendered || '').substring(0, 160)
  const imageUrl = getFeaturedImage(p) || (siteUrl + '/logo-gunz-travel.webp')
  const currentPathUrl = siteUrl + '/blog/' + p.slug

  document.title = fullTitle

  function setMeta(attr, key, content) {
    let el = document.querySelector(`meta[${attr}="${key}"]`)
    if (!el) {
      el = document.createElement('meta')
      el.setAttribute(attr, key)
      document.head.appendChild(el)
    }
    el.setAttribute('content', content)
  }

  setMeta('name', 'description', excerpt)
  setMeta('property', 'og:title', fullTitle)
  setMeta('property', 'og:description', excerpt)
  setMeta('property', 'og:type', 'article')
  setMeta('property', 'og:url', currentPathUrl)
  setMeta('property', 'og:image', imageUrl)
  setMeta('property', 'og:site_name', siteName)
  setMeta('property', 'og:locale', 'id_ID')
  
  setMeta('name', 'twitter:card', 'summary_large_image')
  setMeta('name', 'twitter:title', fullTitle)
  setMeta('name', 'twitter:description', excerpt)
  setMeta('name', 'twitter:image', imageUrl)

  let canonical = document.querySelector('link[rel="canonical"]')
  if (!canonical) {
    canonical = document.createElement('link')
    canonical.setAttribute('rel', 'canonical')
    document.head.appendChild(canonical)
  }
  canonical.setAttribute('href', currentPathUrl)
}

// Structured Data injection
function injectStructuredData(p) {
  const scriptId = 'ld-blog-post-detail'
  let scriptEl = document.getElementById(scriptId)
  if (!scriptEl) {
    scriptEl = document.createElement('script')
    scriptEl.id = scriptId
    scriptEl.type = 'application/ld+json'
    document.head.appendChild(scriptEl)
  }

  const imageUrl = getFeaturedImage(p) || (siteUrl + '/logo-gunz-travel.webp')
  const articleSchema = {
    '@context': 'https://schema.org',
    '@type': 'BlogPosting',
    'headline': p.title?.rendered,
    'description': stripHtml(p.excerpt?.rendered || '').substring(0, 160),
    'image': [imageUrl],
    'datePublished': p.date,
    'dateModified': p.modified || p.date,
    'mainEntityOfPage': {
      '@type': 'WebPage',
      '@id': siteUrl + '/blog/' + p.slug
    },
    'author': {
      '@type': 'Organization',
      'name': 'Gunz Travel Team',
      'url': siteUrl
    },
    'publisher': {
      '@type': 'TravelAgency',
      'name': 'Gunz Travel',
      'logo': {
        '@type': 'ImageObject',
        'url': siteUrl + '/logo-gunz-travel.webp'
      }
    }
  }

  scriptEl.textContent = JSON.stringify(articleSchema)
}

function removeStructuredData() {
  document.getElementById('ld-blog-post-detail')?.remove()
}

// Generate custom WhatsApp message href based on current post
function getWaHref() {
  if (!post.value) return ''
  const title = post.value.title?.rendered || ''
  const text = `Halo Gunz Travel, saya membaca artikel "${title}" di website Anda dan ingin bertanya mengenai pemesanan travel/rental mobil.`
  return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`
}

// Watch route params slug to fetch details on route changes
watch(
  () => route.params.slug,
  (newSlug) => {
    if (newSlug) {
      fetchPostDetail(newSlug).then(() => {
        if (post.value) {
          fetchRecentPosts(post.value.id)
        }
      })
    }
  },
  { immediate: true }
)

onUnmounted(() => {
  removeStructuredData()
})
</script>

<template>
  <main class="min-h-screen bg-[#fffdf7] pb-16">
    <!-- Inner Container -->
    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-6">
      
      <!-- Back Button -->
      <div class="mb-8">
        <router-link
          to="/blog"
          class="inline-flex items-center gap-2 text-sm font-extrabold text-slate-600 transition hover:text-brand-700"
        >
          <font-awesome-icon :icon={faArrowLeft} />
          Kembali ke Blog
        </router-link>
      </div>

      <!-- Loading State Skeleton -->
      <div v-if="loading" class="mx-auto max-w-4xl">
        <!-- Title Skeleton -->
        <div class="h-4 w-20 animate-pulse rounded bg-slate-200"></div>
        <div class="mt-4 h-12 w-full animate-pulse rounded bg-slate-200"></div>
        <div class="mt-2 h-12 w-2/3 animate-pulse rounded bg-slate-200"></div>
        
        <!-- Metadata Skeleton -->
        <div class="mt-6 flex gap-4">
          <div class="h-4 w-32 animate-pulse rounded bg-slate-200"></div>
          <div class="h-4 w-24 animate-pulse rounded bg-slate-200"></div>
        </div>

        <!-- Featured Image Skeleton -->
        <div class="mt-8 aspect-video w-full animate-pulse rounded-[2.5rem] bg-slate-200"></div>

        <!-- Content Skeleton -->
        <div class="mt-10 space-y-4">
          <div class="h-4 w-full animate-pulse rounded bg-slate-200"></div>
          <div class="h-4 w-full animate-pulse rounded bg-slate-200"></div>
          <div class="h-4 w-5/6 animate-pulse rounded bg-slate-200"></div>
          <div class="h-4 w-11/12 animate-pulse rounded bg-slate-200"></div>
          <div class="h-4 w-2/3 animate-pulse rounded bg-slate-200"></div>
        </div>
      </div>

      <!-- Error / Not Found State -->
      <div v-else-if="error || !post" class="mx-auto max-w-xl rounded-[2rem] border border-slate-200 bg-white p-12 text-center">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-3xl bg-brand-50 text-2xl text-brand-700">
          <font-awesome-icon :icon="faExclamationTriangle" />
        </div>
        <h3 class="mt-6 text-xl font-black text-slate-950">
          {{ error || 'Artikel tidak ditemukan' }}
        </h3>
        <p class="mt-2 text-sm text-slate-600">
          Maaf, artikel yang Anda cari mungkin sudah dihapus atau dipindahkan ke alamat lain.
        </p>
        <router-link
          to="/blog"
          class="mt-6 inline-flex items-center gap-2 rounded-full bg-brand-500 px-6 py-3 text-sm font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white"
        >
          Lihat Artikel Lainnya
        </router-link>
      </div>

      <!-- Post Main Layout -->
      <div v-else class="grid gap-12 lg:grid-cols-[1fr_320px]">
        
        <!-- Article Body -->
        <article class="mx-auto w-full max-w-4xl rounded-[2.5rem] border border-slate-200/50 bg-white p-6 shadow-soft sm:p-10 lg:p-12">
          
          <!-- Category & Reading time -->
          <div class="flex flex-wrap items-center gap-3">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-brand-500 px-3.5 py-1.5 text-xs font-extrabold text-ink-900">
              <font-awesome-icon :icon="faFolderOpen" class="text-[10px]" />
              {{ getCategoryName(post) }}
            </span>
            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500">
              <font-awesome-icon :icon="faClock" />
              Estimasi baca: {{ getReadingTime(post.content?.rendered) }} menit
            </span>
          </div>

          <!-- Title -->
          <h1 class="mt-5 text-3xl font-black leading-tight text-slate-950 sm:text-4xl md:text-5xl" v-html="post.title?.rendered">
          </h1>

          <!-- Meta Info -->
          <div class="mt-6 flex flex-wrap items-center gap-6 border-b border-slate-100 pb-6 text-sm text-slate-500">
            <div class="flex items-center gap-2 font-bold">
              <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-xs text-slate-500 ring-2 ring-slate-200/50">
                <font-awesome-icon :icon="faUser" />
              </div>
              <span>Gunz Travel Team</span>
            </div>
            <div class="flex items-center gap-2 font-bold">
              <font-awesome-icon :icon="faCalendarDays" />
              <span>{{ formatDate(post.date) }}</span>
            </div>
          </div>

          <!-- Featured Image -->
          <div v-if="getFeaturedImage(post)" class="mt-8 overflow-hidden rounded-3xl shadow-sm">
            <img
              :src="getFeaturedImage(post)"
              :alt="post.title?.rendered"
              class="h-full w-full object-cover"
            />
          </div>

          <!-- Raw HTML Blog Content Renderer -->
          <div class="blog-content mt-10" v-html="post.content?.rendered"></div>

        </article>

        <!-- Sidebar Section -->
        <aside class="space-y-8">
          
          <!-- CTA Booking Card -->
          <div class="cta-glow rounded-[2rem] bg-gradient-to-br from-brand-400 via-brand-500 to-brand-600 p-6 text-ink-900 shadow-soft">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-ink-900 text-xl text-white shadow-md">
              <font-awesome-icon :icon="faWhatsapp" />
            </div>
            <h3 class="mt-5 text-xl font-black leading-tight text-ink-900">Butuh Layanan Transportasi?</h3>
            <p class="mt-3 text-xs leading-relaxed text-ink-900/80">
              Gunz Travel melayani Travel Malang Juanda 24 Jam, Travel Malang Surabaya, dan Sewa Mobil Malang dengan driver profesional.
            </p>
            <a
              :href="getWaHref()"
              target="_blank"
              rel="noopener"
              class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-ink-900 py-4 text-sm font-black text-white transition hover:bg-white hover:text-ink-900"
            >
              <span>Hubungi WhatsApp</span>
            </a>
          </div>

          <!-- Recent Articles Widget -->
          <div class="rounded-[2rem] border border-slate-200/60 bg-white p-6 shadow-soft">
            <h3 class="text-lg font-black text-slate-950 border-b border-slate-100 pb-3">Artikel Rekomendasi</h3>
            
            <div v-if="loadingRecent" class="mt-4 space-y-4">
              <div v-for="i in 3" :key="i" class="flex gap-3">
                <div class="h-14 w-20 shrink-0 animate-pulse rounded bg-slate-200"></div>
                <div class="flex-1 space-y-2">
                  <div class="h-4 w-full animate-pulse rounded bg-slate-200"></div>
                  <div class="h-3 w-2/3 animate-pulse rounded bg-slate-200"></div>
                </div>
              </div>
            </div>
            
            <div v-else class="mt-4 divide-y divide-slate-100">
              <router-link
                v-for="recent in recentPosts"
                :key="recent.id"
                :to="'/blog/' + recent.slug"
                class="group flex gap-3 py-4 first:pt-0 last:pb-0"
              >
                <!-- Small thumbnail -->
                <div class="relative h-14 w-20 shrink-0 overflow-hidden rounded-lg bg-slate-100">
                  <img
                    v-if="getFeaturedImage(recent)"
                    :src="getFeaturedImage(recent)"
                    :alt="recent.title?.rendered"
                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                  />
                  <div v-else class="flex h-full w-full items-center justify-center bg-brand-500/10 text-[8px] font-black text-brand-800">
                    Gunz
                  </div>
                </div>
                <!-- Title & Date -->
                <div class="flex-1 min-w-0">
                  <h4
                    class="text-sm font-bold text-slate-900 leading-snug line-clamp-2 transition group-hover:text-brand-700"
                    v-html="recent.title?.rendered"
                  ></h4>
                  <p class="mt-1 text-[11px] font-semibold text-slate-400">{{ formatDate(recent.date) }}</p>
                </div>
              </router-link>
            </div>
          </div>

        </aside>

      </div>

    </div>
  </main>
</template>

<style scoped>
/* Scoped custom styling for parsed WordPress HTML content elements */
:deep(.blog-content) {
  @apply text-slate-600 leading-relaxed text-[15px] sm:text-base;
}

:deep(.blog-content p) {
  @apply mb-6 leading-relaxed text-slate-600;
}

:deep(.blog-content p strong) {
  @apply font-black text-slate-900;
}

:deep(.blog-content h2) {
  @apply font-black text-slate-900 text-2xl sm:text-3xl mt-10 mb-5 pb-2 border-b border-slate-100 leading-snug;
}

:deep(.blog-content h3) {
  @apply font-black text-slate-900 text-xl sm:text-2xl mt-8 mb-4 leading-snug;
}

:deep(.blog-content h4) {
  @apply font-black text-slate-900 text-lg sm:text-xl mt-6 mb-3 leading-snug;
}

:deep(.blog-content blockquote) {
  @apply border-l-4 border-brand-500 bg-brand-50/40 px-6 py-4 my-8 rounded-r-2xl text-slate-700 italic font-medium leading-relaxed;
}

:deep(.blog-content ul) {
  @apply list-disc list-inside space-y-2 mb-6 pl-4 text-slate-600;
}

:deep(.blog-content ol) {
  @apply list-decimal list-inside space-y-2 mb-6 pl-4 text-slate-600;
}

:deep(.blog-content li) {
  @apply leading-relaxed;
}

:deep(.blog-content li strong) {
  @apply font-bold text-slate-900;
}

:deep(.blog-content figure) {
  @apply my-8 mx-auto max-w-full;
}

:deep(.blog-content figcaption) {
  @apply text-xs text-center text-slate-500 mt-2 font-medium;
}

:deep(.blog-content img) {
  @apply rounded-2xl max-w-full h-auto my-6 mx-auto shadow-sm;
}

:deep(.blog-content table) {
  @apply w-full text-sm text-left text-slate-600 my-8 border-collapse border border-slate-200 rounded-2xl overflow-hidden shadow-sm;
}

:deep(.blog-content thead) {
  @apply bg-slate-50 border-b border-slate-200;
}

:deep(.blog-content th) {
  @apply p-4 font-black text-slate-900 text-xs sm:text-sm uppercase tracking-wider;
}

:deep(.blog-content tbody tr) {
  @apply border-b border-slate-200 last:border-0 hover:bg-slate-50/50 transition;
}

:deep(.blog-content td) {
  @apply p-4 leading-relaxed text-slate-600 text-xs sm:text-sm;
}
</style>
