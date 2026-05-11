<script setup>
import { reactive } from 'vue'
import { faChevronLeft, faChevronRight } from '@fortawesome/free-solid-svg-icons'

const brokenImages = reactive({})
const slideIndex = reactive({})

defineProps({
  fleets: {
    type: Array,
    required: true,
  },
})

function getIndex(carName, total) {
  return ((slideIndex[carName] || 0) % total + total) % total
}

function prev(carName, total) {
  slideIndex[carName] = getIndex(carName, total) - 1
}

function next(carName, total) {
  slideIndex[carName] = getIndex(carName, total) + 1
}
</script>

<template>
  <section id="armada" class="bg-white px-4 py-20 lg:px-6 lg:py-28">
    <div class="mx-auto max-w-7xl">
      <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
        <div class="max-w-2xl">
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Armada Tersedia</p>
          <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">
            Unit lengkap untuk pribadi, keluarga, kantor, dan rombongan
          </h2>
          <p class="mt-4 text-base leading-7 text-slate-600">Pilih unit sesuai jumlah penumpang. Semua dengan driver.</p>
        </div>
        <router-link
          to="/sewa-mobil-malang/"
          class="inline-flex items-center justify-center rounded-full bg-slate-950 px-6 py-3 text-sm font-extrabold text-white shadow-sm transition hover:bg-brand-600"
        >
          Lihat semua armada
        </router-link>
      </div>

      <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
        <article
          v-for="car in fleets"
          :key="car.name"
          class="group relative overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:border-brand-200 hover:shadow-soft"
        >
          <div class="absolute -right-16 -top-16 h-52 w-52 rounded-full bg-brand-100/50 blur-2xl"></div>

          <!-- Image carousel card -->
          <div class="relative border-b border-slate-100">
            <div
              v-if="car.images && car.images.length && !brokenImages[car.name]"
              class="relative h-48 overflow-hidden bg-slate-100"
            >
              <img
                :src="$asset(car.images[getIndex(car.name, car.images.length)]?.src)"
                :alt="car.images[getIndex(car.name, car.images.length)]?.alt || car.name"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                loading="lazy"
                decoding="async"
                @error="brokenImages[car.name] = true"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-slate-950/10 to-transparent"></div>

              <!-- Carousel arrows -->
              <template v-if="car.images.length > 1">
                <button
                  type="button"
                  class="absolute left-2 top-1/2 z-10 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-slate-700 shadow-md backdrop-blur transition hover:bg-white hover:text-brand-700"
                  aria-label="Foto sebelumnya"
                  @click.prevent="prev(car.name, car.images.length)"
                >
                  <font-awesome-icon :icon="faChevronLeft" class="text-xs" />
                </button>
                <button
                  type="button"
                  class="absolute right-2 top-1/2 z-10 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-slate-700 shadow-md backdrop-blur transition hover:bg-white hover:text-brand-700"
                  aria-label="Foto berikutnya"
                  @click.prevent="next(car.name, car.images.length)"
                >
                  <font-awesome-icon :icon="faChevronRight" class="text-xs" />
                </button>

                <!-- Dots indicator -->
                <div class="absolute bottom-2 left-1/2 z-10 flex -translate-x-1/2 gap-1.5">
                  <span
                    v-for="(img, i) in car.images"
                    :key="i"
                    class="h-1.5 rounded-full transition-all duration-300"
                    :class="i === getIndex(car.name, car.images.length) ? 'w-4 bg-white' : 'w-1.5 bg-white/50'"
                  ></span>
                </div>
              </template>

              <div class="absolute left-5 top-5 inline-flex rounded-full bg-white/85 px-3 py-1 text-xs font-extrabold text-slate-900 backdrop-blur">
                {{ car.capacity }}
              </div>
            </div>

            <!-- Fallback when no images -->
            <div v-else class="flex items-center justify-between gap-3 bg-gradient-to-br from-slate-50 via-white to-brand-50 p-6">
              <div>
                <p class="text-xs font-extrabold uppercase tracking-wide text-slate-500">Rekomendasi</p>
                <p class="mt-2 text-lg font-black text-slate-950">{{ car.name }}</p>
                <p class="mt-1 text-xs font-bold text-slate-600">{{ car.capacity }}</p>
              </div>
              <div class="inline-flex h-14 w-14 items-center justify-center rounded-3xl bg-white text-2xl text-brand-700 ring-1 ring-slate-200">
                <font-awesome-icon :icon="car.icon" />
              </div>
            </div>
          </div>

          <div class="relative p-6">
            <p class="text-lg font-black text-slate-950" v-if="car.images && car.images.length">{{ car.name }}</p>
            <p class="text-sm leading-7 text-slate-600">{{ car.desc }}</p>
            <div class="mt-5 flex flex-wrap items-center gap-2">
              <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-extrabold text-slate-700">Dengan driver</span>
              <span class="rounded-full bg-brand-50 px-3 py-1 text-xs font-extrabold text-brand-800">Door to door</span>
            </div>
            <router-link
              :to="car.url"
              class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-brand-500 px-5 py-4 text-sm font-black text-ink-900 transition hover:bg-ink-900 hover:text-white"
            >
              Lihat detail & pesan
            </router-link>
            <p v-if="!car.images || !car.images.length || brokenImages[car.name]" class="mt-3 text-center text-xs font-semibold text-slate-500">
              Foto armada bisa ditambahkan di sini agar lebih meyakinkan.
            </p>
          </div>
        </article>
      </div>
    </div>
  </section>
</template>
