<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue'

defineProps({
  areas: {
    type: Array,
    required: true,
  },
})

const sectionEl = ref(null)
const bgEl = ref(null)

function updateParallax() {
  if (!sectionEl.value || !bgEl.value) return

  const rect = sectionEl.value.getBoundingClientRect()
  const vh = window.innerHeight || 0

  const total = vh + rect.height
  const progress = total > 0 ? Math.min(1, Math.max(0, 1 - (rect.top + rect.height) / total)) : 0

  const scale = 1.06 + progress * 0.16
  const translateY = (progress - 0.5) * 24

  bgEl.value.style.transform = `translate3d(0, ${translateY}px, 0) scale(${scale})`
}

onMounted(() => {
  updateParallax()
  window.addEventListener('scroll', updateParallax, { passive: true })
  window.addEventListener('resize', updateParallax)
})

onBeforeUnmount(() => {
  window.removeEventListener('scroll', updateParallax)
  window.removeEventListener('resize', updateParallax)
})
</script>

<template>
  <section id="area" ref="sectionEl" class="relative overflow-hidden px-4 py-20 lg:px-6 lg:py-28">
    <div class="pointer-events-none absolute inset-0">
      <div
        ref="bgEl"
        class="absolute inset-0 bg-slate-900 bg-cover bg-center will-change-transform"
        :style="{ backgroundImage: `url('${$asset('bromo.webp')}')` }"
      ></div>
      <div class="absolute inset-0 bg-gradient-to-b from-slate-950/70 via-slate-950/45 to-slate-950/80"></div>
      <div class="absolute inset-0 bg-gradient-to-r from-brand-700/20 via-transparent to-amber-400/15"></div>
    </div>

    <div class="relative mx-auto max-w-7xl">
      <div class="mx-auto max-w-3xl text-center">
        <p class="text-sm font-extrabold uppercase tracking-wide text-brand-200">Area Layanan</p>
        <h2 class="mt-3 text-3xl font-black tracking-tight text-white sm:text-4xl">
          Melayani Malang, Batu, Juanda, Bromo, Bali, Jogja, dan sekitarnya
        </h2>
        <p class="mt-4 text-base leading-7 text-white/80">
          Bisa jemput di rumah, hotel, stasiun, terminal, atau titik lain sesuai kesepakatan.
        </p>
      </div>

      <div class="mt-10 flex flex-wrap justify-center gap-3">
        <div
          v-for="area in areas"
          :key="area"
          class="rounded-full border border-white/15 bg-white/10 px-5 py-3 text-center text-sm font-extrabold text-white backdrop-blur transition hover:border-white/25 hover:bg-white/15"
        >
          {{ area }}
        </div>
      </div>
    </div>
  </section>
</template>
