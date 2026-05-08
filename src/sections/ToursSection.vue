<script setup>
defineProps({
  tours: {
    type: Array,
    required: true,
  },
})
</script>

<template>
  <section class="bg-white px-4 py-20 lg:px-6 lg:py-28">
    <div class="mx-auto max-w-7xl">
      <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
        <div class="max-w-2xl">
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Paket Populer</p>
          <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Rute wisata yang sering dipesan</h2>
          <p class="mt-4 text-base leading-7 text-slate-600">Open trip atau private trip, tinggal pilih.</p>
        </div>
      </div>
      <div class="mt-10 grid gap-5 md:grid-cols-3">
        <a
          v-for="tour in tours"
          :key="tour.title"
          :href="tour.url"
          class="group rounded-[1.75rem] border border-slate-200 bg-slate-50 p-6 transition hover:-translate-y-1 hover:border-brand-200 hover:bg-white hover:shadow-soft"
        >
          <div class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-xl text-brand-700 shadow-sm">
            <font-awesome-icon :icon="tour.icon" />
          </div>
          <h3 class="text-xl font-black text-slate-950">{{ tour.title }}</h3>
          <p class="mt-3 text-sm leading-6 text-slate-600">{{ tour.desc }}</p>
          <p class="mt-6 text-sm font-extrabold text-brand-700 transition group-hover:translate-x-0.5">Lihat paket →</p>
        </a>
      </div>
    </div>
  </section>
</template>
