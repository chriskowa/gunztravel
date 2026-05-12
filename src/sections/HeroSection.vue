<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { faBolt, faClock, faHeadset, faShieldHalved, faStar } from '@fortawesome/free-solid-svg-icons'

defineProps({
  waHref: {
    type: String,
    required: true,
  },
})

const slides = [
  {
    id: 1,
    image: '/images/hero/malang-city.jpg',
    alt: 'Travel Malang Juanda - Pemandangan Kota Malang Gunz Travel'
  },
  {
    id: 2,
    image: '/images/hero/bromo-mountain.png',
    alt: 'Sewa Mobil Malang untuk Wisata Bromo - Gunz Travel'
  },
  {
    id: 3,
    image: '/images/hero/juanda-airport.jpg',
    alt: 'Travel Malang Juanda 24 Jam - Antar Jemput Bandara Juanda Surabaya'
  }
]

const currentSlide = ref(0)
const isTransitioning = ref(false)
let slideInterval = null

const goToSlide = (index) => {
  if (isTransitioning.value || index === currentSlide.value) return
  isTransitioning.value = true
  currentSlide.value = index
  setTimeout(() => {
    isTransitioning.value = false
  }, 700)
}

const nextSlide = () => {
  const next = (currentSlide.value + 1) % slides.length
  goToSlide(next)
}

const startSlideshow = () => {
  slideInterval = setInterval(nextSlide, 5000)
}

const stopSlideshow = () => {
  if (slideInterval) {
    clearInterval(slideInterval)
    slideInterval = null
  }
}

onMounted(() => {
  startSlideshow()
})

onUnmounted(() => {
  stopSlideshow()
})
</script>

<template>
  <section class="relative min-h-[100vh] overflow-hidden">
    <!-- Background Slider -->
    <div class="absolute inset-0">
      <div
        v-for="(slide, index) in slides"
        :key="slide.id"
        class="absolute inset-0 transition-opacity duration-700 ease-in-out"
        :class="{ 'opacity-100': currentSlide === index, 'opacity-0': currentSlide !== index }"
      >
        <img
          :src="$asset(slide.image)"
          :alt="slide.alt"
          class="h-full w-full object-cover"
        />
        <!-- Dark overlay for better text readability -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/30"></div>
      </div>
    </div>

    <!-- Content -->
    <div class="relative z-10 mx-auto grid max-w-7xl min-h-[100vh] gap-10 px-4 py-24 lg:grid-cols-[1.05fr_0.95fr] lg:px-6 lg:py-32">
      <div class="flex flex-col justify-center">
        <div class="mb-6 flex flex-wrap items-center gap-2">
          <span class="inline-flex items-center gap-2 rounded-full bg-white/20 backdrop-blur-sm px-4 py-2 text-xs font-extrabold text-white">
            <font-awesome-icon :icon="faBolt" />
            Respon cepat
          </span>
          <span class="inline-flex items-center gap-2 rounded-full bg-white/20 backdrop-blur-sm px-4 py-2 text-xs font-extrabold text-white">
            <font-awesome-icon :icon="faClock" />
            24 jam by reservation
          </span>
          <span class="inline-flex items-center gap-2 rounded-full bg-white/20 backdrop-blur-sm px-4 py-2 text-xs font-extrabold text-white">
            <font-awesome-icon :icon="faShieldHalved" />
            Driver berpengalaman
          </span>
        </div>

        <h1 class="max-w-3xl text-4xl font-black leading-tight tracking-tight text-white sm:text-5xl lg:text-6xl drop-shadow-lg">
          Travel Malang – Juanda 24 Jam & Sewa Mobil Malang dengan Driver
        </h1>

        <p class="mt-5 max-w-2xl text-base leading-8 text-white/90 sm:text-lg drop-shadow">
          Layanan <strong>travel Malang Juanda 24 jam</strong>, <strong>travel Malang Surabaya</strong>, dan <strong>sewa mobil Malang</strong> dengan driver berpengalaman.
          Jemput–antar door to door untuk bandara, dinas, keluarga, dan rombongan. Chat admin untuk cek jadwal &amp; harga.
        </p>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
          <a
            :href="waHref"
            target="_blank"
            rel="noopener"
            class="cta-glow inline-flex items-center justify-center rounded-full bg-brand-500 px-7 py-4 text-base font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white"
          >
            Pesan via WhatsApp
          </a>
          <a
            href="#cek-harga"
            class="inline-flex items-center justify-center rounded-full border border-white/40 bg-white/10 backdrop-blur-sm px-7 py-4 text-base font-extrabold text-white transition hover:bg-white/20"
          >
            Cek harga cepat
          </a>
        </div>

        <div class="mt-10 grid gap-3 sm:grid-cols-3">
          <div class="rounded-2xl border border-white/20 bg-white/10 backdrop-blur-sm p-4">
            <div class="flex items-center gap-2 text-sm font-extrabold text-white">
              <font-awesome-icon class="text-amber-300" :icon="faStar" />
              Rating pelanggan
            </div>
            <p class="mt-2 text-xs leading-6 text-white/80">Tambahkan Google Review untuk menaikkan trust.</p>
          </div>
          <div class="rounded-2xl border border-white/20 bg-white/10 backdrop-blur-sm p-4">
            <div class="flex items-center gap-2 text-sm font-extrabold text-white">
              <font-awesome-icon class="text-brand-300" :icon="faHeadset" />
              Konsultasi rute
            </div>
            <p class="mt-2 text-xs leading-6 text-white/80">Bantu pilih armada & rute sesuai kebutuhan.</p>
          </div>
          <div class="rounded-2xl border border-white/20 bg-white/10 backdrop-blur-sm p-4">
            <div class="flex items-center gap-2 text-sm font-extrabold text-white">
              <font-awesome-icon class="text-white/70" :icon="faClock" />
              Jadwal fleksibel
            </div>
            <p class="mt-2 text-xs leading-6 text-white/80">Bisa antar jemput, drop, charter, dan tour.</p>
          </div>
        </div>
      </div>

      <!-- Slider Indicators -->
      <div class="hidden lg:flex flex-col justify-end items-end pb-8">
        <div class="flex gap-2">
          <button
            v-for="(slide, index) in slides"
            :key="slide.id"
            @click="goToSlide(index)"
            class="h-2 rounded-full transition-all duration-300"
            :class="currentSlide === index ? 'w-8 bg-white' : 'w-2 bg-white/40 hover:bg-white/60'"
            :aria-label="`Go to slide ${index + 1}`"
          />
        </div>
      </div>
    </div>

    <!-- Mobile Slider Indicators -->
    <div class="absolute bottom-6 left-1/2 z-20 flex -translate-x-1/2 gap-2 lg:hidden">
      <button
        v-for="(slide, index) in slides"
        :key="slide.id"
        @click="goToSlide(index)"
        class="h-2 rounded-full transition-all duration-300"
        :class="currentSlide === index ? 'w-8 bg-white' : 'w-2 bg-white/40'"
        :aria-label="`Go to slide ${index + 1}`"
      />
    </div>
  </section>
</template>
