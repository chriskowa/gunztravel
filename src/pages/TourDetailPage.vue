<script setup>
import { computed, onMounted, onUnmounted } from 'vue'
import { useRoute } from 'vue-router'
import { faWhatsapp } from '@fortawesome/free-brands-svg-icons'
import {
  faCalendarDays,
  faCamera,
  faCircleCheck,
  faClock,
  faHeadset,
  faMapLocationDot,
  faMountainSun,
  faShieldHalved,
  faStar,
  faTicket,
  faUsers,
} from '@fortawesome/free-solid-svg-icons'
import StepsSection from '../sections/StepsSection.vue'

const props = defineProps({
  title: { type: String, required: true },
  subtitle: { type: String, required: true },
  heroImage: { type: String, default: '' },
  packages: { type: Array, required: true },
  destinations: { type: Array, default: () => [] },
  itinerary: { type: Array, default: () => [] },
  includes: { type: Array, default: () => [] },
  notes: { type: Array, default: () => [] },
  faqs: { type: Array, default: () => [] },
})

const phone = '6281805093192'

const waHref = computed(() => {
  const text = `Halo Gunz Travel, saya ingin tanya tentang ${props.title}.`
  return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`
})

function waPackage(pkg) {
  const text = `Halo Gunz Travel, saya tertarik dengan paket ${pkg.name}. Bisa info detail & ketersediaan?`
  return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`
}

/* ── SEO: JSON-LD structured data ── */
const route = useRoute()
const baseUrl = 'https://gunztravel.com'

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
  setJsonLd('ld-breadcrumb-tour', {
    '@context': 'https://schema.org',
    '@type': 'BreadcrumbList',
    itemListElement: [
      { '@type': 'ListItem', position: 1, name: 'Home', item: baseUrl + '/' },
      { '@type': 'ListItem', position: 2, name: props.title, item: baseUrl + route.path },
    ],
  })

  setJsonLd('ld-product-tour', {
    '@context': 'https://schema.org',
    '@type': 'TouristTrip',
    name: props.title,
    description: route.meta?.description || props.subtitle,
    touristType: 'Wisatawan',
    provider: {
      '@type': 'TravelAgency',
      name: 'Gunz Travel',
      url: baseUrl,
      telephone: '+6281805093192',
    },
    offers: props.packages.map(pkg => ({
      '@type': 'Offer',
      name: pkg.name,
      price: pkg.priceNum || '',
      priceCurrency: 'IDR',
      description: pkg.desc,
      availability: 'https://schema.org/InStock',
    })),
  })

  setJsonLd('ld-faq-tour', {
    '@context': 'https://schema.org',
    '@type': 'FAQPage',
    mainEntity: props.faqs.map((f) => ({
      '@type': 'Question',
      name: f.q,
      acceptedAnswer: { '@type': 'Answer', text: f.a },
    })),
  })
})

onUnmounted(() => {
  document.getElementById('ld-breadcrumb-tour')?.remove()
  document.getElementById('ld-product-tour')?.remove()
  document.getElementById('ld-faq-tour')?.remove()
})
</script>

<template>
  <main class="pb-10">
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-white">
      <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 lg:grid-cols-[1.05fr_0.95fr] lg:px-6 lg:py-20">
        <div class="flex flex-col justify-center">
          <div class="mb-6 flex flex-wrap items-center gap-2">
            <span class="inline-flex items-center gap-2 rounded-full bg-brand-50 px-4 py-2 text-xs font-extrabold text-brand-800">
              <font-awesome-icon :icon="faMountainSun" />
              Wisata
            </span>
            <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-4 py-2 text-xs font-extrabold text-amber-800">
              <font-awesome-icon :icon="faUsers" />
              Open & Private Trip
            </span>
            <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700">
              <font-awesome-icon :icon="faShieldHalved" />
              Driver berpengalaman
            </span>
          </div>

          <h1 class="max-w-3xl text-4xl font-black leading-tight tracking-tight text-slate-950 sm:text-5xl">
            {{ title }}
          </h1>

          <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
            {{ subtitle }}
          </p>

          <div class="mt-9 flex flex-col gap-3 sm:flex-row sm:items-center">
            <a
              :href="waHref"
              target="_blank"
              rel="noopener"
              class="cta-glow inline-flex items-center justify-center gap-2 rounded-full bg-brand-500 px-7 py-4 text-base font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white"
            >
              <font-awesome-icon :icon="faWhatsapp" />
              Booking via WhatsApp
            </a>
            <a
              href="#paket"
              class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-7 py-4 text-base font-extrabold text-slate-800 transition hover:border-brand-700 hover:bg-brand-50 hover:text-brand-800"
            >
              Lihat paket & harga
            </a>
          </div>

          <div class="mt-10 grid gap-3 sm:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
              <div class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
                <font-awesome-icon class="text-brand-700" :icon="faTicket" />
                Harga terjangkau
              </div>
              <p class="mt-2 text-xs leading-6 text-slate-600">Paket lengkap sesuai budget Anda.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
              <div class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
                <font-awesome-icon class="text-amber-500" :icon="faCamera" />
                Destinasi lengkap
              </div>
              <p class="mt-2 text-xs leading-6 text-slate-600">Kunjungi spot-spot terbaik dalam satu perjalanan.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
              <div class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
                <font-awesome-icon class="text-slate-700" :icon="faHeadset" />
                Dibantu admin
              </div>
              <p class="mt-2 text-xs leading-6 text-slate-600">Konsultasi rute & jadwal via WhatsApp.</p>
            </div>
          </div>
        </div>

        <div class="relative flex items-center">
          <div class="absolute -right-12 -top-10 h-56 w-56 rounded-full bg-brand-100 blur-3xl"></div>
          <div class="absolute -bottom-10 -left-10 h-52 w-52 rounded-full bg-amber-100 blur-3xl"></div>
          <img
            v-if="heroImage"
            :src="$asset(heroImage)"
            :alt="`${title} - Gunz Travel Malang`"
            class="relative h-[440px] w-full rounded-[2rem] object-cover"
            width="640"
            height="440"
            loading="eager"
            decoding="async"
          />
          <div v-else class="relative flex h-[440px] w-full items-center justify-center rounded-[2rem] bg-gradient-to-br from-white via-brand-50 to-amber-50">
            <div class="text-center">
              <div class="mx-auto inline-flex h-16 w-16 items-center justify-center rounded-3xl bg-white text-3xl text-brand-700 ring-1 ring-slate-200">
                <font-awesome-icon :icon="faMountainSun" />
              </div>
              <p class="mt-3 text-sm font-extrabold text-slate-700">Foto wisata akan ditambahkan</p>
              <p class="mt-1 text-xs font-semibold text-slate-500">Tanya admin untuk info lebih detail</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Packages Section -->
    <section id="paket" class="bg-white px-4 py-16 lg:px-6 lg:py-24">
      <div class="mx-auto max-w-7xl">
        <div class="mx-auto max-w-3xl text-center">
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Paket & Harga</p>
          <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Pilih paket sesuai kebutuhan</h2>
          <p class="mt-4 text-base leading-7 text-slate-600">Harga menyesuaikan jumlah peserta, musim, dan fasilitas tambahan.</p>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
          <div
            v-for="(pkg, i) in packages"
            :key="pkg.name"
            class="relative overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-brand-200 hover:shadow-soft"
          >
            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-brand-100/50 blur-2xl"></div>
            <div class="relative">
              <div v-if="pkg.tag" class="inline-flex rounded-full bg-brand-50 px-4 py-2 text-xs font-extrabold text-brand-800">
                {{ pkg.tag }}
              </div>
              <div v-else class="inline-flex rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700">
                Paket {{ i + 1 }}
              </div>
              <h3 class="mt-4 text-xl font-black text-slate-950">{{ pkg.name }}</h3>
              <p class="mt-2 text-sm leading-6 text-slate-600">{{ pkg.desc }}</p>
              <p class="mt-5 text-2xl font-black text-brand-700">{{ pkg.price }}</p>
              <ul v-if="pkg.facilities" class="mt-4 space-y-2">
                <li v-for="f in pkg.facilities" :key="f" class="flex items-start gap-2 text-sm text-slate-600">
                  <font-awesome-icon :icon="faCircleCheck" class="mt-0.5 text-brand-700" />
                  {{ f }}
                </li>
              </ul>
              <a
                :href="waPackage(pkg)"
                target="_blank"
                rel="noopener"
                class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-brand-500 px-5 py-4 text-sm font-black text-ink-900 transition hover:bg-ink-900 hover:text-white"
              >
                Tanya paket ini
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Itinerary Section -->
    <section v-if="itinerary.length" class="px-4 py-16 lg:px-6 lg:py-24">
      <div class="mx-auto max-w-4xl">
        <div class="text-center">
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Itinerary</p>
          <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Jadwal Perjalanan</h2>
        </div>
        <div class="mt-10 space-y-0">
          <div
            v-for="(item, i) in itinerary"
            :key="i"
            class="relative flex gap-4 pb-8 last:pb-0"
          >
            <div class="flex flex-col items-center">
              <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-500 text-sm font-black text-ink-900">
                {{ i + 1 }}
              </div>
              <div v-if="i < itinerary.length - 1" class="mt-2 h-full w-0.5 bg-brand-200"></div>
            </div>
            <div class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm flex-1">
              <p class="text-xs font-extrabold text-brand-700">{{ item.time }}</p>
              <p class="mt-1 font-black text-slate-950">{{ item.activity }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Destinations Section -->
    <section v-if="destinations.length" class="bg-white px-4 py-16 lg:px-6 lg:py-24">
      <div class="mx-auto max-w-7xl">
        <div class="mx-auto max-w-3xl text-center">
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Destinasi</p>
          <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Spot-spot yang dikunjungi</h2>
        </div>
        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
          <div
            v-for="dest in destinations"
            :key="dest.name"
            class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-soft"
          >
            <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-50 text-xl text-brand-700">
              <font-awesome-icon :icon="faMapLocationDot" />
            </div>
            <h3 class="font-black text-slate-950">{{ dest.name }}</h3>
            <p class="mt-2 text-sm leading-6 text-slate-600">{{ dest.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Includes Section -->
    <section v-if="includes.length" class="px-4 py-16 lg:px-6 lg:py-24">
      <div class="mx-auto max-w-4xl">
        <div class="text-center">
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Fasilitas</p>
          <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Sudah termasuk dalam paket</h2>
        </div>
        <div class="mt-10 grid gap-3 sm:grid-cols-2">
          <div
            v-for="item in includes"
            :key="item"
            class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm"
          >
            <font-awesome-icon :icon="faCircleCheck" class="text-brand-700" />
            <p class="text-sm font-bold text-slate-800">{{ item }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Notes Section -->
    <div v-if="notes.length" class="px-4 lg:px-6">
      <div class="mx-auto max-w-4xl">
        <div class="rounded-[1.75rem] border border-amber-200 bg-amber-50 p-6">
          <p class="text-sm font-extrabold text-amber-800">Catatan Penting</p>
          <ul class="mt-3 space-y-2">
            <li v-for="n in notes" :key="n" class="text-sm leading-7 text-amber-900">
              <span class="mr-2 font-bold">•</span>{{ n }}
            </li>
          </ul>
        </div>
      </div>
    </div>

    <section class="px-4 py-16 lg:px-6 lg:py-24">
      <div class="mx-auto max-w-4xl">
        <article class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm lg:p-12">
          <h2 class="text-2xl font-black tracking-tight text-slate-950 sm:text-3xl">
            {{ title }} dengan Gunz Travel
          </h2>
          <div class="mt-6 space-y-4 text-sm leading-7 text-slate-600">
            <p>
              Merencanakan liburan yang tak terlupakan? <strong>Gunz Travel</strong> menyediakan paket wisata <strong>{{ title }}</strong> yang dirancang khusus untuk kenyamanan dan pengalaman liburan terbaik Anda. Kami siap menemani Anda menjelajahi berbagai destinasi unggulan dengan fasilitas transportasi yang aman dan nyaman.
            </p>
            <p>
              Selain paket wisata, Gunz Travel juga menyediakan layanan <strong>Travel Malang Juanda</strong> dan <strong>Travel Malang Surabaya</strong> untuk kemudahan akses perjalanan Anda dari dan menuju bandara atau luar kota. Jangan ragu untuk mendiskusikan rencana perjalanan Anda bersama kami!
            </p>
          </div>
        </article>
      </div>
    </section>

    <section class="px-4 py-6 lg:px-6">
      <div class="mx-auto max-w-4xl">
        <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Layanan Tour & Travel Gunz Travel</p>
        <div class="mt-4 flex flex-wrap gap-2">
          <router-link to="/paket-wisata-bromo/" class="rounded-full bg-brand-50 px-4 py-2 text-xs font-extrabold text-brand-800 transition hover:bg-brand-100">
            Paket Wisata Bromo
          </router-link>
          <router-link to="/city-tour-malang-batu/" class="rounded-full bg-brand-50 px-4 py-2 text-xs font-extrabold text-brand-800 transition hover:bg-brand-100">
            City Tour Malang Batu
          </router-link>
          <router-link to="/wisata-religi-malang/" class="rounded-full bg-brand-50 px-4 py-2 text-xs font-extrabold text-brand-800 transition hover:bg-brand-100">
            Wisata Religi Malang
          </router-link>
          <router-link to="/travel-malang-juanda/" class="rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700 transition hover:bg-slate-200">
            Travel Malang Juanda
          </router-link>
          <router-link to="/travel-malang-surabaya/" class="rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700 transition hover:bg-slate-200">
            Travel Malang Surabaya
          </router-link>
          <router-link to="/sewa-mobil-malang/" class="rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700 transition hover:bg-slate-200">
            Sewa Mobil Malang
          </router-link>
        </div>
      </div>
    </section>

    <StepsSection />

    <!-- FAQ Section -->
    <section v-if="faqs.length" class="bg-white px-4 py-20 lg:px-6 lg:py-28">
      <div class="mx-auto max-w-4xl">
        <div class="text-center">
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">FAQ</p>
          <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Pertanyaan yang sering ditanyakan</h2>
          <p class="mt-4 text-base leading-7 text-slate-600">Jika masih ragu, chat admin dan kami bantu.</p>
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

    <!-- Final CTA -->
    <section class="px-4 py-20 lg:px-6 lg:py-28">
      <div class="mx-auto max-w-7xl rounded-[2rem] bg-gradient-to-br from-brand-400 via-brand-500 to-brand-600 p-8 text-ink-900 shadow-soft lg:p-12">
        <div class="grid gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
          <div>
            <h2 class="text-3xl font-black tracking-tight sm:text-4xl">Siap booking {{ title }}?</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-ink-900/80">
              Kirim data singkat via WhatsApp. Admin bantu pilih paket terbaik sesuai kebutuhan dan budget Anda.
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
