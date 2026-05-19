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
    <header class="sticky top-0 z-50 w-full border-b border-slate-200/70 bg-white/80 glass">
      <div class="mx-auto max-w-7xl px-3 sm:px-4 lg:px-6">
        <div class="hidden py-2 lg:block">
          <div class="flex items-center justify-between text-sm text-slate-600">
            <p class="truncate">Gunz Travel & Tourism, Jl. Cokroaminoto No.43, Klojen, Kota Malang</p>
            <div class="flex items-center gap-5">
              <a class="font-semibold text-slate-700 hover:text-brand-700" href="tel:+6281805093192">0818-0509-3192</a>
              <span class="hidden xl:inline">24 Jam by Reservation</span>
            </div>
          </div>
        </div>

        <nav class="flex items-center justify-between py-3 lg:py-4" aria-label="Navigasi utama">
          <router-link to="/" class="flex items-center gap-3" aria-label="Gunz Travel beranda" @click="closeMobileMenu">
            <div class="logo-mark-shadow flex h-11 w-11 items-center justify-center overflow-hidden rounded-2xl bg-white ring-2 ring-brand-300 shadow-sm">
              <img
                :src="$asset('logo-gunz-travel.webp')"
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
            <router-link class="rounded-full px-4 py-2 transition hover:bg-brand-50 hover:text-brand-800" to="/blog">Blog</router-link>
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
              class="cta-glow hidden items-center justify-center gap-2 rounded-full bg-brand-500 px-5 py-3 text-sm font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white sm:inline-flex"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
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
    </header>

    <div v-show="mobileMenu" class="fixed inset-0 z-[60] lg:hidden" role="dialog" aria-modal="true">
      <div class="absolute inset-0 bg-slate-950/40" @click="closeMobileMenu"></div>
      <div class="absolute right-0 top-0 h-full w-[86%] max-w-sm bg-white shadow-2xl">
        <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
          <div class="flex items-center gap-3">
            <div class="logo-mark-shadow flex h-10 w-10 items-center justify-center overflow-hidden rounded-2xl bg-white ring-2 ring-brand-300">
              <img
                :src="$asset('logo-gunz-travel.webp')"
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
            <router-link to="/blog" class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3" @click="closeMobileMenu">Blog</router-link>
          </div>

          <div class="mt-5 rounded-3xl border border-slate-200 bg-white p-4">
            <p class="text-xs font-extrabold uppercase tracking-wide text-brand-700">Kontak cepat</p>
            <p class="mt-2 text-sm font-semibold text-slate-700">Respon cepat via WhatsApp, bisa booking 24 jam</p>
            <div class="mt-4 grid gap-2">
              <a
                :href="waHref"
                target="_blank"
                rel="noopener"
                class="cta-glow inline-flex items-center justify-center gap-2 rounded-2xl bg-brand-500 px-5 py-4 text-sm font-black text-ink-900 hover:bg-ink-900 hover:text-white"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
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
