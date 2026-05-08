<script setup>
defineProps({
  faqs: {
    type: Array,
    required: true,
  },
})
</script>

<template>
  <section id="faq" class="bg-white px-4 py-20 lg:px-6 lg:py-28">
    <div class="mx-auto max-w-4xl">
      <div class="text-center">
        <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">FAQ</p>
        <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Pertanyaan yang sering ditanyakan</h2>
        <p class="mt-4 text-base leading-7 text-slate-600">Jika masih ragu, chat admin dan kami bantu pilih rute & armada.</p>
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
</template>
