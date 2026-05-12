<script setup>
import { faArrowLeft, faHouse, faVanShuttle } from '@fortawesome/free-solid-svg-icons'

const siteName = 'Gunz Travel'
</script>

<template>
  <main class="relative flex min-h-[80vh] items-center justify-center overflow-hidden bg-white px-4 py-24 lg:px-6">
    <!-- Decorative backgrounds -->
    <div class="absolute -left-20 -top-20 h-96 w-96 rounded-full bg-brand-50 blur-3xl"></div>
    <div class="absolute -right-20 -bottom-20 h-96 w-96 rounded-full bg-amber-50 blur-3xl"></div>

    <div class="relative z-10 mx-auto max-w-2xl text-center">
      <div class="mb-8 inline-flex h-24 w-24 items-center justify-center rounded-[2.5rem] bg-brand-50 text-4xl text-brand-700 shadow-inner ring-1 ring-brand-100">
        <font-awesome-icon :icon="faVanShuttle" />
      </div>
      
      <h1 class="text-8xl font-black tracking-tighter text-slate-200 sm:text-9xl">404</h1>
      
      <div class="-mt-8 sm:-mt-12">
        <h2 class="text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Halaman Tidak Ditemukan</h2>
        <p class="mt-6 text-base leading-8 text-slate-600 sm:text-lg">
          Maaf, rute perjalanan yang Anda cari tidak tersedia atau telah dipindahkan. 
          Kembali ke beranda untuk memesan travel atau sewa mobil terbaik di Malang.
        </p>
      </div>

      <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
        <router-link
          to="/"
          class="cta-glow inline-flex items-center justify-center gap-2 rounded-full bg-brand-500 px-8 py-4 text-base font-black text-ink-900 transition hover:bg-ink-900 hover:text-white"
        >
          <font-awesome-icon :icon="faHouse" />
          Kembali ke Beranda
        </router-link>
        <button
          @click="$router.back()"
          class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-300 bg-white px-8 py-4 text-base font-black text-slate-800 transition hover:border-brand-700 hover:bg-brand-50 hover:text-brand-800"
        >
          <font-awesome-icon :icon="faArrowLeft" />
          Halaman Sebelumnya
        </button>
      </div>

      <div class="mt-16 grid gap-4 sm:grid-cols-3">
        <router-link to="/travel-malang-juanda/" class="rounded-3xl border border-slate-100 bg-slate-50/50 p-4 text-sm font-bold text-slate-700 transition hover:bg-white hover:shadow-soft">
          Travel Juanda
        </router-link>
        <router-link to="/travel-malang-surabaya/" class="rounded-3xl border border-slate-100 bg-slate-50/50 p-4 text-sm font-bold text-slate-700 transition hover:bg-white hover:shadow-soft">
          Travel Surabaya
        </router-link>
        <router-link to="/sewa-mobil-malang/" class="rounded-3xl border border-slate-100 bg-slate-50/50 p-4 text-sm font-bold text-slate-700 transition hover:bg-white hover:shadow-soft">
          Sewa Mobil
        </router-link>
      </div>
    </div>
  </main>
</template>

<style scoped>
.cta-glow {
  box-shadow: 0 14px 32px rgba(255, 159, 28, 0.28);
}
</style>
