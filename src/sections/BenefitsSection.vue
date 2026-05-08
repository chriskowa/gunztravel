<script setup>
defineProps({
  benefits: {
    type: Array,
    required: true,
  },
})
</script>

<template>
  <section class="px-4 py-20 lg:px-6 lg:py-28">
    <div class="mx-auto grid max-w-7xl gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
      <div>
        <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Kenapa Pilih Kami</p>
        <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Lebih mudah dipesan, lebih jelas layanannya</h2>
        <p class="mt-4 text-base leading-7 text-slate-600">
          Homepage ini dibuat agar customer tidak bingung. Semua informasi penting tampil cepat: layanan, armada, harga awal, area,
          dan tombol booking.
        </p>
      </div>
      <div class="grid gap-4 sm:grid-cols-2">
        <div
          v-for="item in benefits"
          :key="item.title"
          class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-soft"
        >
          <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-50 text-xl text-brand-700">
            <font-awesome-icon :icon="item.icon" />
          </div>
          <h3 class="font-black text-slate-950">{{ item.title }}</h3>
          <p class="mt-2 text-sm leading-6 text-slate-600">{{ item.desc }}</p>
        </div>
      </div>
    </div>
  </section>
</template>
