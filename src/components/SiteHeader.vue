<script setup>
import { computed, onBeforeUnmount, ref, watch } from 'vue'

const phone = '6281805093192'
const mobileMenu = ref(false)

const links = [
  { label: 'Layanan', to: { path: '/', hash: '#layanan' } },
  { label: 'Armada', to: { path: '/', hash: '#armada' } },
  { label: 'Harga', to: { path: '/', hash: '#harga' } },
  { label: 'Area', to: { path: '/', hash: '#area' } },
  { label: 'FAQ', to: { path: '/', hash: '#faq' } },
]

const waHref = computed(() => {
  const text = 'Halo Gunz Travel, saya ingin bertanya tentang layanan travel atau sewa mobil.'
  return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`
})

function closeMobileMenu() {
  mobileMenu.value = false
}

watch(mobileMenu, (open) => {
  document.body.style.overflow = open ? 'hidden' : ''
})

onBeforeUnmount(() => {
  document.body.style.overflow = ''
})
</script>

<template>
  <div>
    <header class="z-50 px-3 pt-3 sm:px-4 lg:sticky lg:top-0">
      <div class="mx-auto max-w-7xl">
        <div class="rounded-[1.75rem] border border-slate-200/70 bg-white/80 shadow-soft ring-1 ring-white/40 glass">
          <div class="hidden px-6 pb-2 pt-3 lg:block">
            <div class="flex items-center justify-between text-sm text-slate-600">
              <p class="truncate">Gunz Travel & Tourism, Jl. Cokroaminoto No.43, Klojen, Kota Malang</p>
              <div class="flex items-center gap-5">
                <a class="font-semibold text-slate-700 hover:text-brand-700" href="tel:+6281805093192">0818-0509-3192</a>
                <span class="hidden xl:inline">24 Jam by Reservation</span>
              </div>
            </div>
          </div>

          <nav class="flex items-center justify-between px-4 py-3 lg:px-6 lg:py-4" aria-label="Navigasi utama">
            <router-link to="/" class="flex items-center gap-3" aria-label="Gunz Travel beranda" @click="closeMobileMenu">
              <div
                class="logo-mark-shadow flex h-11 w-11 items-center justify-center overflow-hidden rounded-2xl bg-white ring-2 ring-brand-300 shadow-sm"
              >
                <img
                  src="/logo%20gunz%20travel.webp"
                  alt="Logo Gunz Travel"
                  class="h-full w-full object-contain p-1"
                  width="44"
                  height="44"
                  loading="eager"
                  decoding="async"
                />
              </div>
              <div class="leading-tight">
                <p class="text-base font-extrabold tracking-tight text-slate-950">Gunz Travel</p>
                <p class="text-xs font-semibold text-slate-500">Travel · Rental · Tour</p>
              </div>
            </router-link>

            <div class="hidden items-center gap-1 rounded-full border border-slate-200 bg-white/70 p-1 text-sm font-semibold text-slate-700 lg:flex">
              <router-link
                v-for="link in links"
                :key="link.label"
                class="rounded-full px-4 py-2 transition hover:bg-brand-50 hover:text-brand-800"
                :to="link.to"
              >
                {{ link.label }}
              </router-link>
              <a class="rounded-full px-4 py-2 transition hover:bg-brand-50 hover:text-brand-800" href="/blog/">Blog</a>
            </div>

            <div class="flex items-center gap-2">
              <a
                href="tel:+6281805093192"
                class="hidden items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-3 text-sm font-extrabold text-slate-800 transition hover:border-brand-300 hover:bg-brand-50 lg:inline-flex"
              >
                Telepon
              </a>
              <a
                :href="waHref"
                target="_blank"
                rel="noopener"
                class="cta-glow hidden items-center justify-center rounded-full bg-brand-500 px-5 py-3 text-sm font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white sm:inline-flex"
              >
                Pesan via WhatsApp
              </a>
              <button
                class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-700 lg:hidden"
                type="button"
                aria-label="Buka menu"
                @click="mobileMenu = true"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
              </button>
            </div>
          </nav>
        </div>
      </div>
    </header>

    <div v-show="mobileMenu" class="fixed inset-0 z-[60] lg:hidden" role="dialog" aria-modal="true">
      <div class="absolute inset-0 bg-slate-950/40" @click="closeMobileMenu"></div>
      <div class="absolute right-0 top-0 h-full w-[86%] max-w-sm bg-white shadow-2xl">
        <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
          <div class="flex items-center gap-3">
            <div class="logo-mark-shadow flex h-10 w-10 items-center justify-center overflow-hidden rounded-2xl bg-white ring-2 ring-brand-300">
              <img
                src="/logo%20gunz%20travel.webp"
                alt="Logo Gunz Travel"
                class="h-full w-full object-contain p-1"
                width="40"
                height="40"
                loading="eager"
                decoding="async"
              />
            </div>
            <div class="leading-tight">
              <p class="text-sm font-black text-slate-950">Gunz Travel</p>
              <p class="text-xs font-semibold text-slate-500">Travel · Rental · Tour</p>
            </div>
          </div>
          <button
            class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white"
            type="button"
            aria-label="Tutup menu"
            @click="closeMobileMenu"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <div class="px-5 py-5">
          <div class="grid gap-2 text-sm font-extrabold text-slate-800">
            <router-link
              v-for="link in links"
              :key="link.label"
              :to="link.to"
              class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3"
              @click="closeMobileMenu"
            >
              {{ link.label }}
            </router-link>
            <a href="/blog/" class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3" @click="closeMobileMenu">Blog</a>
          </div>

          <div class="mt-5 rounded-3xl border border-slate-200 bg-white p-4">
            <p class="text-xs font-extrabold uppercase tracking-wide text-brand-700">Kontak cepat</p>
            <p class="mt-2 text-sm font-semibold text-slate-700">Respon cepat via WhatsApp, bisa booking 24 jam</p>
            <div class="mt-4 grid gap-2">
              <a
                :href="waHref"
                target="_blank"
                rel="noopener"
                class="cta-glow inline-flex justify-center rounded-2xl bg-brand-500 px-5 py-4 text-sm font-black text-ink-900 hover:bg-ink-900 hover:text-white"
              >
                Chat WhatsApp
              </a>
              <a
                href="tel:+6281805093192"
                class="inline-flex justify-center rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm font-black text-slate-800 hover:border-brand-300 hover:bg-brand-50"
              >
                Telepon
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
