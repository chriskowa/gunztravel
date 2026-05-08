<script setup>
defineProps({
  waHref: {
    type: String,
    required: true,
  },
})
</script>

<template>
  <section class="px-4 py-20 lg:px-6 lg:py-28">
    <div class="mx-auto max-w-7xl rounded-[2rem] bg-gradient-to-br from-brand-400 via-brand-500 to-brand-600 p-8 text-ink-900 shadow-soft lg:p-12">
      <div class="grid gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <h2 class="text-3xl font-black tracking-tight sm:text-4xl">Butuh travel atau sewa mobil dari Malang?</h2>
          <p class="mt-3 max-w-2xl text-base leading-7 text-ink-900/80">
            Hubungi admin Gunz Travel sekarang untuk cek jadwal, harga, dan ketersediaan armada.
          </p>
        </div>
        <a
          :href="waHref"
          target="_blank"
          rel="noopener"
          class="inline-flex justify-center rounded-full bg-ink-900 px-8 py-4 text-sm font-black text-white transition hover:bg-white hover:text-ink-900"
        >
          Chat WhatsApp Sekarang
        </a>
      </div>
    </div>
  </section>
</template>
