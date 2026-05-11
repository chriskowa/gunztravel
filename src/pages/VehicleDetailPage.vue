<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import { faWhatsapp } from '@fortawesome/free-brands-svg-icons'
import {
  faBus,
  faCarSide,
  faChevronLeft,
  faChevronRight,
  faCircleCheck,
  faClock,
  faHeadset,
  faShieldHalved,
  faStar,
  faTruckMonster,
  faVanShuttle,
} from '@fortawesome/free-solid-svg-icons'

const props = defineProps({
  title: { type: String, required: true },
  subtitle: { type: String, required: true },
  capacity: { type: String, required: true },
  highlights: { type: Array, required: true },
  images: { type: Array, default: () => [] },
  fallbackIcon: { type: String, default: 'car' },
})

const phone = '6281805093192'
const carouselIdx = ref(0)
const brokenImages = ref({})
let autoplayTimer = null

function startAutoplay() {
  stopAutoplay()
  if (props.images.length > 1) {
    autoplayTimer = setInterval(() => {
      carouselIdx.value++
    }, 5000)
  }
}

function stopAutoplay() {
  if (autoplayTimer) {
    clearInterval(autoplayTimer)
    autoplayTimer = null
  }
}

const waHref = computed(() => {
  const text = `Halo Gunz Travel, saya ingin tanya ${props.title}.`
  return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`
})

const fallbackFaIcon = computed(() => {
  if (props.fallbackIcon === 'bus') return faBus
  if (props.fallbackIcon === 'van') return faVanShuttle
  if (props.fallbackIcon === 'truck') return faTruckMonster
  if (props.fallbackIcon === 'star') return faStar
  return faCarSide
})

const pricing = computed(() => [
  {
    name: 'Dalam kota (drop)',
    desc: 'Cocok untuk antar jemput singkat, hotel, stasiun, atau meeting.',
    price: 'Hubungi admin',
    tag: 'Paling sering',
  },
  {
    name: 'Airport transfer',
    desc: 'Antar jemput Bandara Juanda dan area sekitarnya.',
    price: 'Hubungi admin',
    tag: 'Bandara',
  },
  {
    name: 'Full day',
    desc: 'Cocok untuk dinas, wisata, atau kebutuhan seharian.',
    price: 'Hubungi admin',
    tag: 'Fleksibel',
  },
])

const hasImages = computed(() => props.images.length > 0 && !props.images.every((_, i) => brokenImages.value[i]))
const currentSlide = computed(() => {
  const total = props.images.length
  if (!total) return 0
  return ((carouselIdx.value % total) + total) % total
})

function prevSlide() {
  carouselIdx.value--
  startAutoplay()
}
function nextSlide() {
  carouselIdx.value++
  startAutoplay()
}

const faqs = computed(() => [
  {
    q: 'Apakah harga sudah termasuk driver?',
    a: 'Ya. Paket sudah termasuk driver. Untuk detail biaya (bbm, tol, parkir, overtime) akan dijelaskan admin sesuai rute.',
  },
  {
    q: 'Bisa jemput di rumah atau hotel?',
    a: 'Bisa. Titik jemput bisa di rumah, hotel, stasiun, bandara, atau lokasi lain sesuai kesepakatan.',
  },
  {
    q: 'Bagaimana cara booking?',
    a: 'Klik tombol WhatsApp, kirim tanggal, jam, titik jemput, tujuan, dan jumlah penumpang. Admin akan konfirmasi ketersediaan & harga.',
  },
  {
    q: 'Apakah bisa untuk luar kota?',
    a: 'Bisa. Rute luar kota menyesuaikan durasi, rute, dan kebutuhan armada.',
  },
])

/* ── SEO: JSON-LD structured data ── */
const route = useRoute()

function setJsonLd(id, data) {
  let el = document.getElementById(id)
  if (!el) {
    el = document.createElement('script')
    el.id = id
    el.type = 'application/ld+json'
    document.head.appendChild(el)
  }
  el.textContent = JSON.stringify(data)
}

onMounted(() => {
  startAutoplay()

  const baseUrl = 'https://gunztravel.com'

  setJsonLd('ld-breadcrumb-vehicle', {
    '@context': 'https://schema.org',
    '@type': 'BreadcrumbList',
    itemListElement: [
      { '@type': 'ListItem', position: 1, name: 'Home', item: baseUrl + '/' },
      { '@type': 'ListItem', position: 2, name: props.title, item: baseUrl + route.path },
    ],
  })

  setJsonLd('ld-faq-vehicle', {
    '@context': 'https://schema.org',
    '@type': 'FAQPage',
    mainEntity: faqs.value.map((f) => ({
      '@type': 'Question',
      name: f.q,
      acceptedAnswer: { '@type': 'Answer', text: f.a },
    })),
  })
})

onUnmounted(() => {
  stopAutoplay()
  document.getElementById('ld-breadcrumb-vehicle')?.remove()
  document.getElementById('ld-faq-vehicle')?.remove()
})
</script>

<template>
  <main class="pb-10">
    <section class="hero-grid overflow-hidden bg-white">
      <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 lg:grid-cols-[1.05fr_0.95fr] lg:px-6 lg:py-20">
        <div class="flex flex-col justify-center">
          <div class="mb-6 flex flex-wrap items-center gap-2">
            <span class="inline-flex items-center gap-2 rounded-full bg-brand-50 px-4 py-2 text-xs font-extrabold text-brand-800">
              <font-awesome-icon :icon="faCircleCheck" />
              Dengan driver
            </span>
            <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-4 py-2 text-xs font-extrabold text-amber-800">
              <font-awesome-icon :icon="faClock" />
              24 jam by reservation
            </span>
            <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700">
              <font-awesome-icon :icon="faHeadset" />
              Konsultasi rute
            </span>
          </div>

          <h1 class="text-4xl font-black leading-tight tracking-tight text-slate-950 sm:text-5xl">
            {{ title }}
          </h1>

          <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
            {{ subtitle }}
          </p>

          <div class="mt-7 flex flex-wrap gap-3">
            <div class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-extrabold text-slate-800">
              Kapasitas: {{ capacity }}
            </div>
            <div class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-extrabold text-slate-800">
              Jemput–antar fleksibel
            </div>
            <div class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-extrabold text-slate-800">
              Area: Malang · Batu · Juanda
            </div>
          </div>

          <div class="mt-9 flex flex-col gap-3 sm:flex-row sm:items-center">
            <a
              :href="waHref"
              target="_blank"
              rel="noopener"
              class="cta-glow inline-flex items-center justify-center rounded-full bg-brand-500 px-7 py-4 text-base font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white"
            >
              Cek harga & jadwal via WhatsApp
            </a>
            <a
              href="#harga-detail"
              class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-7 py-4 text-base font-extrabold text-slate-800 transition hover:border-brand-700 hover:bg-brand-50 hover:text-brand-800"
            >
              Lihat paket harga
            </a>
          </div>

          <div class="mt-10 grid gap-3 sm:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
              <div class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
                <font-awesome-icon class="text-brand-700" :icon="faShieldHalved" />
                Aman & nyaman
              </div>
              <p class="mt-2 text-xs leading-6 text-slate-600">Driver berpengalaman dan paham rute.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
              <div class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
                <font-awesome-icon class="text-amber-500" :icon="faStar" />
                Cocok untuk event
              </div>
              <p class="mt-2 text-xs leading-6 text-slate-600">Dinas, keluarga, wisata, dan kebutuhan khusus.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
              <div class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
                <font-awesome-icon class="text-slate-700" :icon="faClock" />
                Fleksibel
              </div>
              <p class="mt-2 text-xs leading-6 text-slate-600">Bisa drop, charter, dan luar kota.</p>
            </div>
          </div>
        </div>

        <div class="relative flex items-center justify-center">
          <!-- Carousel images -->
          <template v-if="hasImages">
            <div class="relative w-full max-w-lg">
              <img
                :key="currentSlide"
                :src="images[currentSlide]?.src ? $asset(images[currentSlide].src) : ''"
                :alt="images[currentSlide]?.alt || `${title} - Gunz Travel Malang`"
                class="mx-auto h-auto max-h-[400px] w-full object-contain transition-opacity duration-500"
                loading="eager"
                decoding="async"
                @error="brokenImages[currentSlide] = true"
              />

              <!-- Carousel arrows -->
              <template v-if="images.length > 1">
                <button
                  type="button"
                  class="absolute left-0 top-1/2 z-10 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/80 text-slate-600 shadow-md backdrop-blur transition hover:bg-white hover:text-brand-700"
                  aria-label="Foto sebelumnya"
                  @click="prevSlide"
                >
                  <font-awesome-icon :icon="faChevronLeft" class="text-sm" />
                </button>
                <button
                  type="button"
                  class="absolute right-0 top-1/2 z-10 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/80 text-slate-600 shadow-md backdrop-blur transition hover:bg-white hover:text-brand-700"
                  aria-label="Foto berikutnya"
                  @click="nextSlide"
                >
                  <font-awesome-icon :icon="faChevronRight" class="text-sm" />
                </button>

                <!-- Dots indicator -->
                <div class="mt-4 flex items-center justify-center gap-2">
                  <button
                    v-for="(img, i) in images"
                    :key="i"
                    type="button"
                    class="h-2 rounded-full transition-all duration-300"
                    :class="i === currentSlide ? 'w-6 bg-brand-500' : 'w-2 bg-slate-300 hover:bg-slate-400'"
                    :aria-label="`Lihat foto ${i + 1}`"
                    @click="carouselIdx = i; startAutoplay()"
                  ></button>
                </div>
              </template>
            </div>
          </template>

          <!-- Fallback -->
          <div v-else class="flex h-[340px] w-full items-center justify-center">
            <div class="text-center">
              <div class="mx-auto inline-flex h-16 w-16 items-center justify-center rounded-3xl bg-white text-3xl text-brand-700 ring-1 ring-slate-200">
                <font-awesome-icon :icon="fallbackFaIcon" />
              </div>
              <p class="mt-3 text-sm font-extrabold text-slate-700">Foto unit segera ditambahkan</p>
              <p class="mt-1 text-xs font-semibold text-slate-500">Tanya admin untuk foto terbaru</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="px-4 py-16 lg:px-6 lg:py-24">
      <div class="mx-auto max-w-7xl">
        <div class="grid gap-10 lg:grid-cols-[0.95fr_1.05fr] lg:items-start">
          <div>
            <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Kenapa pilih unit ini</p>
            <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Nyaman, jelas, dan mudah dibooking</h2>
            <p class="mt-4 text-base leading-7 text-slate-600">
              Halaman ini dibuat supaya calon customer cepat paham: kapasitas, kegunaan, opsi paket, dan cara booking. Admin tinggal
              konfirmasi ketersediaan & harga.
            </p>
          </div>
          <div class="grid gap-4 sm:grid-cols-2">
            <div
              v-for="item in highlights"
              :key="item"
              class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-soft"
            >
              <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-50 text-xl text-brand-700">
                <font-awesome-icon :icon="faCircleCheck" />
              </div>
              <p class="font-black text-slate-950">{{ item }}</p>
              <p class="mt-2 text-sm leading-6 text-slate-600">Tanyakan kebutuhanmu, admin bantu rekomendasi rute & armada.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="harga-detail" class="bg-white px-4 py-16 lg:px-6 lg:py-24">
      <div class="mx-auto max-w-7xl">
        <div class="mx-auto max-w-3xl text-center">
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Paket & Harga</p>
          <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Pilih paket sesuai kebutuhan</h2>
          <p class="mt-4 text-base leading-7 text-slate-600">Harga final menyesuaikan tanggal, rute, durasi, dan titik jemput.</p>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-3">
          <div
            v-for="plan in pricing"
            :key="plan.name"
            class="relative overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-brand-200 hover:shadow-soft"
          >
            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-brand-100/50 blur-2xl"></div>
            <div class="relative">
              <div class="inline-flex rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700">{{ plan.tag }}</div>
              <h3 class="mt-4 text-xl font-black text-slate-950">{{ plan.name }}</h3>
              <p class="mt-2 text-sm leading-6 text-slate-600">{{ plan.desc }}</p>
              <p class="mt-5 text-2xl font-black text-brand-700">{{ plan.price }}</p>
              <a
                :href="waHref"
                target="_blank"
                rel="noopener"
                class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-brand-500 px-5 py-4 text-sm font-black text-ink-900 transition hover:bg-ink-900 hover:text-white"
              >
                Tanya harga paket ini
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <StepsSection />

    <section class="bg-white px-4 py-16 lg:px-6 lg:py-24">
      <div class="mx-auto max-w-4xl">
        <div class="text-center">
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">FAQ</p>
          <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Pertanyaan yang sering ditanyakan</h2>
        </div>
        <div class="mt-10 divide-y divide-slate-200 rounded-[1.75rem] border border-slate-200 bg-white shadow-sm">
          <details v-for="faq in faqs" :key="faq.q" class="group p-6 open:bg-slate-50">
            <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-base font-black text-slate-950">
              {{ faq.q }}
              <span class="text-brand-700 transition group-open:rotate-45">+</span>
            </summary>
            <p class="mt-3 text-sm leading-7 text-slate-600">{{ faq.a }}</p>
          </details>
        </div>
      </div>
    </section>

    <section class="px-4 py-16 lg:px-6 lg:py-24">
      <div class="mx-auto max-w-7xl rounded-[2rem] bg-gradient-to-br from-brand-400 via-brand-500 to-brand-600 p-8 text-ink-900 shadow-soft lg:p-12">
        <div class="grid gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
          <div>
            <h2 class="text-3xl font-black tracking-tight sm:text-4xl">Siap booking {{ title }}?</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-ink-900/80">
              Kirim data singkat. Admin bantu cek ketersediaan dan rekomendasi paket terbaik untuk rute kamu.
            </p>
          </div>
          <a
            :href="waHref"
            target="_blank"
            rel="noopener"
            class="inline-flex items-center justify-center gap-2 rounded-full bg-ink-900 px-8 py-4 text-sm font-black text-white transition hover:bg-white hover:text-ink-900"
          >
            <font-awesome-icon :icon="faWhatsapp" class="text-xl" />
            Chat WhatsApp Sekarang
          </a>
        </div>
      </div>
    </section>
  </main>
</template>
