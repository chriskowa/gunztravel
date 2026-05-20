<script setup>
import { computed } from 'vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faWhatsapp } from '@fortawesome/free-brands-svg-icons'
import { faMapMarkerAlt, faPhone } from '@fortawesome/free-solid-svg-icons'

const phone = '6281805093192'
const waHref = computed(() => {
  const text = 'Halo Gunz Travel, saya ingin bertanya tentang layanan travel atau sewa mobil.'
  return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`
})
</script>

<template>
  <main id="contact">
    <section class="px-4 py-16 lg:px-6 lg:py-24 bg-slate-50 min-h-[60vh] flex flex-col justify-center">
      <div class="mx-auto max-w-4xl text-center">
        <h1 class="text-4xl font-black tracking-tight text-slate-950 sm:text-5xl">
          Hubungi Kami
        </h1>
        <p class="mt-4 text-lg text-slate-600">
          Punya pertanyaan seputar layanan Gunz Travel? Jangan ragu untuk menghubungi kami melalui kontak di bawah ini.
        </p>
      </div>

      <div class="mx-auto max-w-4xl mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 w-full">
        <div class="rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-sm">
          <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-brand-100 text-brand-600">
            <font-awesome-icon :icon="faPhone" class="text-2xl" />
          </div>
          <h3 class="mt-6 text-xl font-bold text-slate-950">Telepon</h3>
          <p class="mt-2 text-slate-600">+62 818-0509-3192</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-sm">
          <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#25D366]/10 text-[#25D366]">
            <font-awesome-icon :icon="faWhatsapp" class="text-2xl" />
          </div>
          <h3 class="mt-6 text-xl font-bold text-slate-950">WhatsApp</h3>
          <p class="mt-2 text-slate-600">Layanan 24 Jam</p>
          <a :href="waHref" target="_blank" rel="noopener" class="mt-4 inline-block rounded-full bg-[#25D366] px-6 py-2 text-sm font-bold text-white transition hover:bg-[#20bd5a]">
            Chat Sekarang
          </a>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-sm sm:col-span-2 lg:col-span-1">
          <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-brand-100 text-brand-600">
            <font-awesome-icon :icon="faMapMarkerAlt" class="text-2xl" />
          </div>
          <h3 class="mt-6 text-xl font-bold text-slate-950">Lokasi</h3>
          <p class="mt-2 text-slate-600">Malang, Jawa Timur, Indonesia</p>
        </div>
      </div>
    </section>
  </main>
</template>
