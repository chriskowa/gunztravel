<script setup>
import { faBolt, faClock, faHeadset, faShieldHalved, faStar } from '@fortawesome/free-solid-svg-icons'

defineProps({
  waHref: {
    type: String,
    required: true,
  },
})
</script>

<template>
  <section class="hero-grid overflow-hidden bg-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 lg:grid-cols-[1.05fr_0.95fr] lg:px-6 lg:py-20">
      <div class="flex flex-col justify-center">
        <div class="mb-6 flex flex-wrap items-center gap-2">
          <span class="inline-flex items-center gap-2 rounded-full bg-brand-50 px-4 py-2 text-xs font-extrabold text-brand-800">
            <font-awesome-icon :icon="faBolt" />
            Respon cepat
          </span>
          <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-4 py-2 text-xs font-extrabold text-amber-800">
            <font-awesome-icon :icon="faClock" />
            24 jam by reservation
          </span>
          <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700">
            <font-awesome-icon :icon="faShieldHalved" />
            Driver berpengalaman
          </span>
        </div>

        <h1 class="max-w-3xl text-4xl font-black leading-tight tracking-tight text-slate-950 sm:text-5xl lg:text-6xl">
          Travel Malang – Juanda 24 Jam & Sewa Mobil Malang dengan Driver
        </h1>

        <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
          Jemput–antar lebih nyaman untuk bandara, dinas, keluarga, dan rombongan. Chat admin untuk cek jadwal & harga paling akurat.
        </p>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
          <a
            :href="waHref"
            target="_blank"
            rel="noopener"
            class="cta-glow inline-flex items-center justify-center rounded-full bg-brand-500 px-7 py-4 text-base font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white"
          >
            Pesan via WhatsApp
          </a>
          <a
            href="#cek-harga"
            class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-7 py-4 text-base font-extrabold text-slate-800 transition hover:border-brand-700 hover:bg-brand-50 hover:text-brand-800"
          >
            Cek harga cepat
          </a>
        </div>

        <div class="mt-10 grid gap-3 sm:grid-cols-3">
          <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
              <font-awesome-icon class="text-amber-500" :icon="faStar" />
              Rating pelanggan
            </div>
            <p class="mt-2 text-xs leading-6 text-slate-600">Tambahkan Google Review untuk menaikkan trust.</p>
          </div>
          <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
              <font-awesome-icon class="text-brand-700" :icon="faHeadset" />
              Konsultasi rute
            </div>
            <p class="mt-2 text-xs leading-6 text-slate-600">Bantu pilih armada & rute sesuai kebutuhan.</p>
          </div>
          <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
              <font-awesome-icon class="text-slate-700" :icon="faClock" />
              Jadwal fleksibel
            </div>
            <p class="mt-2 text-xs leading-6 text-slate-600">Bisa antar jemput, drop, charter, dan tour.</p>
          </div>
        </div>
      </div>

      <div class="relative">
        <div class="absolute -right-12 -top-10 h-56 w-56 rounded-full bg-brand-100 blur-3xl"></div>
        <div class="absolute -bottom-10 -left-10 h-52 w-52 rounded-full bg-amber-100 blur-3xl"></div>
        <div class="relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-4 shadow-soft">
          <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-brand-200/40 blur-2xl"></div>
          <div class="flex min-h-[460px] flex-col justify-between rounded-[1.5rem] bg-gradient-to-br from-white via-brand-50 to-amber-50 p-6 text-slate-950">
            <div>
              <div class="inline-flex items-center gap-2 rounded-full bg-white/80 px-4 py-2 text-sm font-extrabold text-slate-900 ring-1 ring-slate-200">
                Armada siap jalan
              </div>
              <h2 class="mt-6 text-3xl font-black leading-tight">Pilihan unit lengkap untuk semua kebutuhan</h2>
              <p class="mt-3 max-w-sm text-sm leading-6 text-slate-600">Bandara, dinas, wedding, wisata, sampai rombongan besar.</p>
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
              <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-wide text-slate-500">Rute populer</p>
                <p class="mt-2 text-sm font-black text-slate-950">Malang ↔ Juanda</p>
                <p class="mt-1 text-xs text-slate-600">Surabaya · Batu · Bromo</p>
              </div>
              <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-wide text-slate-500">Layanan</p>
                <p class="mt-2 text-sm font-black text-slate-950">Door to door</p>
                <p class="mt-1 text-xs text-slate-600">Drop · Charter · Tour</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
