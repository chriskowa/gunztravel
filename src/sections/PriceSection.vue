<script setup>
defineProps({
  prices: {
    type: Array,
    required: true,
  },
  waHref: {
    type: String,
    required: true,
  },
})
</script>

<template>
  <section id="harga" class="px-4 py-20 lg:px-6 lg:py-28">
    <div class="mx-auto max-w-7xl">
      <div class="grid gap-8 lg:grid-cols-[0.85fr_1.15fr] lg:items-start">
        <div>
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Harga Ringkas</p>
          <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">
            Harga awal mudah dilihat, detailnya cek ke admin
          </h2>
          <p class="mt-4 text-base leading-7 text-slate-600">
            Harga dapat berubah sesuai tanggal, durasi, rute, titik jemput, dan pilihan armada. Gunakan tombol WhatsApp untuk
            cek harga paling akurat.
          </p>
          <a
            :href="waHref"
            target="_blank"
            rel="noopener"
            class="cta-glow mt-7 inline-flex rounded-full bg-brand-500 px-7 py-4 text-sm font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white"
          >
            Cek Harga Sekarang
          </a>
        </div>

        <div class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-sm">
          <div class="grid min-w-0 grid-cols-3 bg-gradient-to-r from-slate-50 via-white to-brand-50 px-5 py-4 text-sm font-black text-slate-700">
            <p class="min-w-0 break-words">Layanan</p>
            <p class="min-w-0 break-words">Mulai dari</p>
            <p class="min-w-0 break-words">Cocok untuk</p>
          </div>
          <div
            v-for="price in prices"
            :key="price.name"
            class="grid min-w-0 grid-cols-3 gap-2 border-t border-slate-100 px-5 py-4 text-sm transition hover:bg-slate-50"
          >
            <p class="min-w-0 break-words font-bold text-slate-950">{{ price.name }}</p>
            <p class="min-w-0 break-words font-extrabold text-brand-700">{{ price.price }}</p>
            <p class="min-w-0 break-words text-slate-600">{{ price.best }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
