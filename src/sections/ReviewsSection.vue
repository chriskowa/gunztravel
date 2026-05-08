<script setup>
defineProps({
  reviews: {
    type: Array,
    required: true,
  },
})
</script>

<template>
  <section class="px-4 py-20 lg:px-6 lg:py-28">
    <div class="mx-auto max-w-7xl">
      <div class="mx-auto max-w-3xl text-center">
        <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Testimoni</p>
        <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Dengar pengalaman pelanggan</h2>
        <p class="mt-4 text-base leading-7 text-slate-600">Tambahkan review asli agar trust naik dan conversion lebih tinggi.</p>
      </div>
      <div class="mt-10 grid gap-5 md:grid-cols-3">
        <blockquote
          v-for="review in reviews"
          :key="review.name"
          class="group relative overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-brand-200 hover:shadow-soft"
        >
          <div class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-amber-100/70 blur-2xl"></div>
          <div class="relative inline-flex rounded-full bg-amber-50 px-4 py-2 text-xs font-extrabold text-amber-800">★★★★★</div>
          <p class="mt-4 text-sm leading-7 text-slate-600">“{{ review.text }}”</p>
          <footer class="mt-5">
            <p class="font-black text-slate-950">{{ review.name }}</p>
            <p class="text-xs font-medium text-slate-500">{{ review.service }}</p>
          </footer>
        </blockquote>
      </div>
    </div>
  </section>
</template>
