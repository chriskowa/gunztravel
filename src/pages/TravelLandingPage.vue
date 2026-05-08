<script setup>
import { computed, ref } from 'vue'
import {
  faBolt,
  faBus,
  faCircleCheck,
  faClock,
  faHeadset,
  faLocationDot,
  faShieldHalved,
  faTicket,
  faUserGroup,
  faVanShuttle,
} from '@fortawesome/free-solid-svg-icons'
import QuickBookingSection from '../sections/QuickBookingSection.vue'

const props = defineProps({
  title: { type: String, required: true },
  subtitle: { type: String, required: true },
  routeLabel: { type: String, required: true },
  priceFrom: { type: String, required: true },
  pickupAreas: { type: Array, required: true },
  dropAreas: { type: Array, required: true },
  schedule: { type: Array, required: true },
  notes: { type: Array, default: () => [] },
  heroImage: { type: String, default: '' },
})

const phone = '6281805093192'
const heroImageOk = ref(true)

const showHeroImage = computed(() => Boolean(props.heroImage) && heroImageOk.value)

const waHref = computed(() => {
  const text = `Halo Gunz Travel, saya ingin booking ${props.routeLabel}.`
  return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`
})

function sendBooking(booking) {
  const message = [
    `Halo Gunz Travel, saya ingin cek harga untuk ${props.routeLabel}.`,
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

const faqs = computed(() => [
  {
    q: 'Apakah ini travel reguler atau private?',
    a: 'Bisa keduanya. Untuk reguler menyesuaikan jadwal dan ketersediaan seat. Untuk private (charter) bisa lebih fleksibel.',
  },
  {
    q: 'Jemputnya di mana?',
    a: 'Jemput bisa di rumah, hotel, stasiun, terminal, atau titik lain sesuai kesepakatan dan rute.',
  },
  {
    q: 'Bagasi boleh bawa berapa?',
    a: 'Menyesuaikan unit dan jumlah penumpang. Chat admin untuk konfirmasi bagasi (koper, box, dll).',
  },
  {
    q: 'Cara booking?',
    a: 'Klik tombol WhatsApp, kirim tanggal, jam, titik jemput, tujuan, dan jumlah penumpang. Admin akan konfirmasi ketersediaan & harga.',
  },
])
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
            {{ title }}
          </h1>

          <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
            {{ subtitle }}
          </p>

          <div class="mt-7 flex flex-wrap gap-3">
            <div class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-extrabold text-slate-800">
              Rute: {{ routeLabel }}
            </div>
            <div class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-extrabold text-slate-800">
              Mulai {{ priceFrom }}
            </div>
            <div class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-extrabold text-slate-800">
              Door to door (sesuai kesepakatan)
            </div>
          </div>

          <div class="mt-9 flex flex-col gap-3 sm:flex-row sm:items-center">
            <a
              :href="waHref"
              target="_blank"
              rel="noopener"
              class="cta-glow inline-flex items-center justify-center rounded-full bg-brand-500 px-7 py-4 text-base font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white"
            >
              Booking via WhatsApp
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
                <font-awesome-icon class="text-brand-700" :icon="faTicket" />
                Harga transparan
              </div>
              <p class="mt-2 text-xs leading-6 text-slate-600">Admin jelaskan biaya sesuai rute & titik jemput.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
              <div class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
                <font-awesome-icon class="text-slate-700" :icon="faUserGroup" />
                Seat tersedia
              </div>
              <p class="mt-2 text-xs leading-6 text-slate-600">Bisa reguler atau private sesuai kebutuhan.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
              <div class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
                <font-awesome-icon class="text-amber-500" :icon="faHeadset" />
                Dibantu admin
              </div>
              <p class="mt-2 text-xs leading-6 text-slate-600">Rekomendasi jam berangkat & titik jemput.</p>
            </div>
          </div>
        </div>

        <div class="relative">
          <div class="absolute -right-12 -top-10 h-56 w-56 rounded-full bg-brand-100 blur-3xl"></div>
          <div class="absolute -bottom-10 -left-10 h-52 w-52 rounded-full bg-amber-100 blur-3xl"></div>
          <div class="relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-4 shadow-soft">
            <div class="overflow-hidden rounded-[1.5rem] bg-slate-50">
              <img
                v-if="showHeroImage"
                :src="heroImage"
                :alt="title"
                class="h-[440px] w-full object-cover"
                loading="eager"
                decoding="async"
                @error="heroImageOk = false"
              />
              <div v-else class="flex h-[440px] items-center justify-center bg-gradient-to-br from-white via-brand-50 to-amber-50">
                <div class="text-center">
                  <div class="mx-auto inline-flex h-16 w-16 items-center justify-center rounded-3xl bg-white text-3xl text-brand-700 ring-1 ring-slate-200">
                    <font-awesome-icon :icon="faVanShuttle" />
                  </div>
                  <p class="mt-3 text-sm font-extrabold text-slate-700">Foto rute/armada bisa ditambahkan</p>
                  <p class="mt-1 text-xs font-semibold text-slate-500">Tanya admin untuk foto terbaru</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <QuickBookingSection @submit="sendBooking" />

    <section class="bg-white px-4 py-20 lg:px-6 lg:py-28">
      <div class="mx-auto max-w-7xl">
        <div class="grid gap-10 lg:grid-cols-[0.95fr_1.05fr] lg:items-start">
          <div>
            <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Info Rute</p>
            <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Jemput–antar jelas, rute aman</h2>
            <p class="mt-4 text-base leading-7 text-slate-600">
              Kamu bisa mulai dari area-area berikut. Jika titik jemputmu tidak ada di list, chat admin untuk cek coverage.
            </p>
          </div>
          <div class="grid gap-4 sm:grid-cols-2">
            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
              <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-50 text-xl text-brand-700">
                <font-awesome-icon :icon="faLocationDot" />
              </div>
              <p class="font-black text-slate-950">Area jemput</p>
              <div class="mt-4 flex flex-wrap gap-2">
                <span v-for="a in pickupAreas" :key="a" class="rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700">
                  {{ a }}
                </span>
              </div>
            </div>
            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
              <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-50 text-xl text-brand-700">
                <font-awesome-icon :icon="faBus" />
              </div>
              <p class="font-black text-slate-950">Area tujuan</p>
              <div class="mt-4 flex flex-wrap gap-2">
                <span v-for="a in dropAreas" :key="a" class="rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700">
                  {{ a }}
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-10 overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-sm">
          <div class="grid grid-cols-3 bg-gradient-to-r from-slate-50 via-white to-brand-50 px-5 py-4 text-sm font-black text-slate-700">
            <p>Jadwal</p>
            <p>Estimasi</p>
            <p>Catatan</p>
          </div>
          <div v-for="row in schedule" :key="row.time" class="grid grid-cols-3 gap-2 border-t border-slate-100 px-5 py-4 text-sm transition hover:bg-slate-50">
            <p class="font-bold text-slate-950">{{ row.time }}</p>
            <p class="font-extrabold text-brand-700">{{ row.eta }}</p>
            <p class="text-slate-600">{{ row.note }}</p>
          </div>
        </div>

        <div v-if="notes.length" class="mt-6 grid gap-3 sm:grid-cols-2">
          <div
            v-for="n in notes"
            :key="n"
            class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-sm font-semibold leading-7 text-slate-700"
          >
            <span class="mr-2 text-brand-700">•</span>{{ n }}
          </div>
        </div>
      </div>
    </section>

    <StepsSection />

    <section class="bg-white px-4 py-20 lg:px-6 lg:py-28">
      <div class="mx-auto max-w-4xl">
        <div class="text-center">
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">FAQ</p>
          <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Pertanyaan yang sering ditanyakan</h2>
          <p class="mt-4 text-base leading-7 text-slate-600">Jika masih ragu, chat admin dan kami bantu.</p>
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
            <h2 class="text-3xl font-black tracking-tight sm:text-4xl">Siap booking {{ routeLabel }}?</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-ink-900/80">
              Kirim data singkat. Admin bantu cek ketersediaan dan rekomendasi jam terbaik.
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
