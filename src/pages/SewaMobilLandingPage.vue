<script setup>
import { computed } from 'vue'
import { faBolt, faCarSide, faCircleCheck, faClock, faHeadset, faShieldHalved } from '@fortawesome/free-solid-svg-icons'
import FleetSection from '../sections/FleetSection.vue'
import QuickBookingSection from '../sections/QuickBookingSection.vue'
import { fleets } from '../data/fleets'

const phone = '6281805093192'

const waHref = computed(() => {
  const text = 'Halo Gunz Travel, saya ingin tanya sewa mobil di Malang.'
  return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`
})

function sendBooking(booking) {
  const message = [
    'Halo Gunz Travel, saya ingin cek harga sewa mobil.',
    `Layanan: ${booking.service}`,
    `Armada: ${booking.car}`,
    `Tanggal: ${booking.date || '-'}`,
    `Jumlah penumpang: ${booking.passengers || '-'}`,
    `Tujuan: ${booking.destination || '-'}`,
    'Titik jemput: ',
    'Jam jemput: ',
  ].join('\n')

  window.open(`https://wa.me/${phone}?text=${encodeURIComponent(message)}`, '_blank', 'noopener')
}

const pricing = [
  {
    name: 'Dalam kota (drop)',
    desc: 'Antar jemput singkat untuk hotel, stasiun, meeting, dan kebutuhan harian.',
    tag: 'Paling sering',
  },
  {
    name: 'Airport transfer',
    desc: 'Antar jemput Bandara Juanda dan area sekitarnya.',
    tag: 'Bandara',
  },
  {
    name: 'Full day',
    desc: 'Cocok untuk dinas, wisata, keluarga, atau event seharian.',
    tag: 'Fleksibel',
  },
]

const faqs = [
  {
    q: 'Apakah harga sudah termasuk driver?',
    a: 'Ya. Paket sudah termasuk driver. Detail biaya (bbm, tol, parkir, overtime) dijelaskan admin sesuai rute.',
  },
  { q: 'Bisa jemput di rumah atau hotel?', a: 'Bisa. Titik jemput fleksibel sesuai kesepakatan.' },
  { q: 'Bisa untuk luar kota?', a: 'Bisa. Rute luar kota menyesuaikan durasi dan kebutuhan armada.' },
  { q: 'Cara booking?', a: 'Klik WhatsApp, kirim tanggal, jam, jemput, tujuan, dan jumlah penumpang. Admin konfirmasi unit & harga.' },
]
</script>

<template>
  <main id="home">
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
            Sewa Mobil Malang dengan Driver
          </h1>
          <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
            Pilih unit sesuai kebutuhan: city car, MPV, SUV, premium, hingga rombongan. Cocok untuk bandara, dinas, keluarga, wisata,
            dan acara.
          </p>

          <div class="mt-9 flex flex-col gap-3 sm:flex-row sm:items-center">
            <a
              :href="waHref"
              target="_blank"
              rel="noopener"
              class="cta-glow inline-flex items-center justify-center rounded-full bg-brand-500 px-7 py-4 text-base font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white"
            >
              Konsultasi & booking via WhatsApp
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
                <font-awesome-icon class="text-brand-700" :icon="faCircleCheck" />
                Dengan driver
              </div>
              <p class="mt-2 text-xs leading-6 text-slate-600">Driver paham rute Malang, Batu, Juanda, dan wisata.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
              <div class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
                <font-awesome-icon class="text-slate-700" :icon="faHeadset" />
                Dibantu admin
              </div>
              <p class="mt-2 text-xs leading-6 text-slate-600">Rekomendasi unit sesuai penumpang & rute.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
              <div class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
                <font-awesome-icon class="text-amber-500" :icon="faCarSide" />
                Unit lengkap
              </div>
              <p class="mt-2 text-xs leading-6 text-slate-600">Mulai unit hemat sampai premium & rombongan.</p>
            </div>
          </div>
        </div>

        <div class="relative">
          <div class="absolute -right-12 -top-10 h-56 w-56 rounded-full bg-brand-100 blur-3xl"></div>
          <div class="absolute -bottom-10 -left-10 h-52 w-52 rounded-full bg-amber-100 blur-3xl"></div>
          <div class="relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-4 shadow-soft">
            <div class="flex min-h-[460px] flex-col justify-between rounded-[1.5rem] bg-gradient-to-br from-white via-brand-50 to-amber-50 p-6 text-slate-950">
              <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-white/80 px-4 py-2 text-sm font-extrabold text-slate-900 ring-1 ring-slate-200">
                  Unit favorit customer
                </div>
                <h2 class="mt-6 text-3xl font-black leading-tight">Innova Reborn, Alphard, Pajero, Hiace, Elf</h2>
                <p class="mt-3 max-w-sm text-sm leading-6 text-slate-600">Chat admin untuk foto terbaru, jadwal, dan harga.</p>
              </div>
              <div class="grid gap-3 sm:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
                  <p class="text-xs font-extrabold uppercase tracking-wide text-slate-500">Area</p>
                  <p class="mt-2 text-sm font-black text-slate-950">Malang · Batu · Juanda</p>
                  <p class="mt-1 text-xs text-slate-600">Bisa hotel · stasiun · rumah</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
                  <p class="text-xs font-extrabold uppercase tracking-wide text-slate-500">Kebutuhan</p>
                  <p class="mt-2 text-sm font-black text-slate-950">Dinas · Wisata · Keluarga</p>
                  <p class="mt-1 text-xs text-slate-600">Drop · Charter · Tour</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <QuickBookingSection @submit="sendBooking" />
    <FleetSection :fleets="fleets" />


    <StepsSection />

    <section class="bg-white px-4 py-20 lg:px-6 lg:py-28">
      <div class="mx-auto max-w-7xl">
        <div class="mx-auto max-w-3xl text-center">
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Paket Populer</p>
          <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Pilih paket sesuai kebutuhan</h2>
          <p class="mt-4 text-base leading-7 text-slate-600">Harga final menyesuaikan tanggal, rute, durasi, dan titik jemput.</p>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-3">
          <div
            v-for="plan in pricing"
            :key="plan.name"
            class="relative overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-brand-200 hover:shadow-soft"
          >
            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-brand-100/50 blur-2xl"></div>
            <div class="relative">
              <div class="inline-flex rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700">{{ plan.tag }}</div>
              <h3 class="mt-4 text-xl font-black text-slate-950">{{ plan.name }}</h3>
              <p class="mt-2 text-sm leading-6 text-slate-600">{{ plan.desc }}</p>
              <a
                :href="waHref"
                target="_blank"
                rel="noopener"
                class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-brand-500 px-5 py-4 text-sm font-black text-ink-900 transition hover:bg-ink-900 hover:text-white"
              >
                Tanya harga paket ini
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="px-4 py-20 lg:px-6 lg:py-28">
      <div class="mx-auto max-w-4xl">
        <div class="text-center">
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">FAQ</p>
          <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Pertanyaan yang sering ditanyakan</h2>
          <p class="mt-4 text-base leading-7 text-slate-600">Jika masih ragu, chat admin dan kami bantu pilih unit.</p>
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

    <section class="px-4 py-20 lg:px-6 lg:py-28">
      <div class="mx-auto max-w-7xl rounded-[2rem] bg-gradient-to-br from-brand-400 via-brand-500 to-brand-600 p-8 text-ink-900 shadow-soft lg:p-12">
        <div class="grid gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
          <div>
            <h2 class="text-3xl font-black tracking-tight sm:text-4xl">Butuh sewa mobil di Malang?</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-ink-900/80">
              Kirim data singkat. Admin bantu cek ketersediaan dan rekomendasi paket terbaik untuk rute kamu.
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
  </main>
</template>
