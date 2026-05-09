<script setup>
import { computed } from 'vue'

const year = new Date().getFullYear()
const phone = '6281805093192'

const waHref = computed(() => {
  const text = 'Halo Gunz Travel, saya ingin bertanya tentang layanan travel atau sewa mobil.'
  return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`
})
</script>

<template>
  <div>
    <footer class="border-t border-slate-200 bg-white px-4 py-12 lg:px-6">
      <div class="mx-auto grid max-w-7xl gap-8 md:grid-cols-4">
        <div class="md:col-span-2">
          <div class="flex items-center gap-3">
            <div
              class="logo-mark-shadow flex h-10 w-10 items-center justify-center overflow-hidden rounded-2xl bg-white ring-2 ring-brand-300"
            >
              <img
                src="/logo%20gunz%20travel.webp"
                alt="Logo Gunz Travel"
                class="h-full w-full object-contain p-1"
                width="40"
                height="40"
                loading="lazy"
                decoding="async"
              />
            </div>
            <div>
              <p class="font-black text-slate-950">Gunz Travel</p>
              <p class="text-xs text-slate-500">Travel, Rental, Tour</p>
            </div>
          </div>
          <p class="mt-5 max-w-md text-sm leading-7 text-slate-600">
            Melayani travel Malang Juanda, travel Malang Surabaya, sewa mobil Malang, Hiace, Elf, shuttle bandara, perjalanan
            dinas, wisata religi, Bromo, Bali, Jogja, dan city tour Malang Batu.
          </p>
        </div>

        <div>
          <p class="font-black text-slate-950">Kontak</p>
          <div class="mt-4 grid gap-2 text-sm text-slate-600">
            <a href="tel:+6281805093192">0818-0509-3192</a>
            <a :href="waHref" target="_blank" rel="noopener">WhatsApp Admin</a>
            <p>Jl. Cokroaminoto No.43, Klojen, Kota Malang</p>
          </div>
        </div>

        <div>
          <p class="font-black text-slate-950">Halaman</p>
          <div class="mt-4 grid gap-2 text-sm text-slate-600">
            <a href="/travel-malang-juanda/">Travel Malang Juanda</a>
            <a href="/travel-malang-surabaya/">Travel Malang Surabaya</a>
            <a href="/travel-juanda-malang/">Travel Juanda Malang</a>
            <a href="/sewa-mobil-malang/">Sewa Mobil Malang</a>
            <a href="/sewa-hiace-malang/">Sewa Hiace Malang</a>
            <a href="/paket-wisata-bromo/">Paket Wisata Bromo</a>
          </div>
        </div>
      </div>

      <div class="mx-auto mt-10 max-w-7xl border-t border-slate-200 pt-6 text-sm text-slate-500">
        <p>© <span>{{ year }}</span> Gunz Travel. All rights reserved.</p>
      </div>
    </footer>

    <div class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-200 bg-white p-3 shadow-2xl sm:hidden">
      <a
        :href="waHref"
        target="_blank"
        rel="noopener"
        class="cta-glow flex w-full items-center justify-center rounded-full bg-brand-500 px-5 py-4 text-sm font-black text-ink-900 hover:bg-ink-900 hover:text-white"
      >
        Pesan via WhatsApp
      </a>
    </div>
  </div>
</template>
