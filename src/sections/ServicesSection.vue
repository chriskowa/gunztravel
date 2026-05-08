<script setup>
import { faArrowRight } from '@fortawesome/free-solid-svg-icons'

defineProps({
  services: {
    type: Array,
    required: true,
  },
})
</script>

<template>
  <section id="layanan" class="px-4 py-20 lg:px-6 lg:py-28">
    <div class="mx-auto max-w-7xl">
      <div class="mx-auto max-w-3xl text-center">
        <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Layanan Utama</p>
        <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">
          Pilih layanan sesuai kebutuhan perjalanan Anda
        </h2>
        <p class="mt-4 text-base leading-7 text-slate-600">Klik layanan untuk melihat detail rute, armada, harga, dan cara booking.</p>
      </div>

      <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
        <a
          v-for="service in services"
          :key="service.title"
          :href="service.url"
          class="group relative overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-brand-200 hover:shadow-soft"
        >
          <div class="absolute -right-12 -top-12 h-24 w-24 rounded-full bg-brand-100/60 blur-2xl"></div>
          <div class="relative mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-50 text-xl text-brand-700 ring-1 ring-brand-100">
            <font-awesome-icon :icon="service.icon" />
          </div>
          <h3 class="relative text-lg font-black text-slate-950 group-hover:text-brand-700">{{ service.title }}</h3>
          <p class="relative mt-3 text-sm leading-6 text-slate-600">{{ service.desc }}</p>
          <div class="relative mt-6 inline-flex items-center gap-2 text-sm font-extrabold text-brand-700">
            Lihat detail
            <font-awesome-icon class="transition group-hover:translate-x-0.5" :icon="faArrowRight" />
          </div>
        </a>
      </div>
    </div>
  </section>
</template>
