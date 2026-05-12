<script setup>
import { computed, onMounted, onUnmounted } from 'vue'
import { useRoute } from 'vue-router'
import {
  faCarSide,
  faCity,
  faComments,
  faLocationDot,
  faMountain,
  faMosque,
  faPlaneDeparture,
  faUserTie,
  faVanShuttle,
} from '@fortawesome/free-solid-svg-icons'
import { fleets } from '../data/fleets'
import AreaSection from '../sections/AreaSection.vue'
import BenefitsSection from '../sections/BenefitsSection.vue'
import FaqSection from '../sections/FaqSection.vue'
import FinalCtaSection from '../sections/FinalCtaSection.vue'
import FleetSection from '../sections/FleetSection.vue'
import HeroSection from '../sections/HeroSection.vue'
import PriceSection from '../sections/PriceSection.vue'
import QuickBookingSection from '../sections/QuickBookingSection.vue'
import ReviewsSection from '../sections/ReviewsSection.vue'
import ServicesSection from '../sections/ServicesSection.vue'
import StepsSection from '../sections/StepsSection.vue'
import ToursSection from '../sections/ToursSection.vue'

const phone = '6281805093192'

const waHref = computed(() => {
  const text = 'Halo Gunz Travel, saya ingin bertanya tentang layanan travel atau sewa mobil.'
  return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`
})

function sendBooking(booking) {
  const message = [
    'Halo Gunz Travel, saya ingin cek harga.',
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

const services = [
  {
    icon: faPlaneDeparture,
    title: 'Travel Malang Juanda 24 Jam',
    desc: 'Antar jemput Malang, Batu, dan sekitar menuju Bandara Juanda Surabaya. Layanan 24 jam door to door.',
    url: '/travel-malang-juanda/',
  },
  {
    icon: faCity,
    title: 'Travel Malang Surabaya',
    desc: 'Travel Malang Surabaya door to door mulai Rp150.000/orang. Jemput rumah, hotel, stasiun.',
    url: '/travel-malang-surabaya/',
  },
  {
    icon: faCarSide,
    title: 'Sewa Mobil Malang',
    desc: 'Sewa mobil Malang dengan driver untuk dinas, keluarga, luar kota, hotel, dan stasiun.',
    url: '/sewa-mobil-malang/',
  },
  {
    icon: faVanShuttle,
    title: 'Hiace dan Elf Rombongan',
    desc: 'Sewa Hiace Commuter, Hiace Premio, dan Elf Long untuk rombongan 14 sampai 18 seat.',
    url: '/sewa-hiace-malang/',
  },
]

const prices = [
  { name: 'Travel Malang Juanda', price: 'Rp150.000/orang', best: 'Penumpang bandara' },
  { name: 'Travel Malang Surabaya', price: 'Rp150.000/orang', best: 'Perjalanan reguler' },
  { name: 'Sewa Avanza / Mobilio', price: 'Hubungi admin', best: 'Keluarga kecil' },
  { name: 'Sewa Innova Reborn', price: 'Hubungi admin', best: 'Keluarga dan bisnis' },
  { name: 'Sewa Hiace', price: 'Hubungi admin', best: 'Rombongan' },
  { name: 'Sewa Elf Long', price: 'Hubungi admin', best: 'Rombongan besar' },
  { name: 'Open Trip Bromo', price: 'Mulai Rp250.000/orang', best: 'Wisata Bromo' },
]

const areas = [
  'Malang Kota',
  'Batu',
  'Kepanjen',
  'Juanda',
  'Surabaya',
  'Bromo',
  'Pantai Selatan',
  'Bali',
  'Jogja',
  'Hotel',
  'Stasiun',
  'Terminal',
]

const benefits = [
  { icon: faLocationDot, title: 'Jemput Antar Fleksibel', desc: 'Titik jemput bisa disesuaikan dengan kebutuhan customer.' },
  { icon: faVanShuttle, title: 'Armada Lengkap', desc: 'Tersedia city car, MPV, SUV, unit premium, Hiace, dan Elf.' },
  { icon: faUserTie, title: 'Driver Berpengalaman', desc: 'Driver memahami rute Malang, Juanda, Bromo, Batu, Bali, dan Jogja.' },
  { icon: faComments, title: 'Booking via WhatsApp', desc: 'Cukup kirim tanggal, tujuan, jumlah penumpang, dan titik jemput.' },
]

const tours = [
  {
    icon: faMountain,
    title: 'Paket Wisata Bromo',
    desc: 'Open trip dan private trip Bromo dari Malang dengan pilihan armada sesuai kebutuhan.',
    url: '/paket-wisata-bromo/',
  },
  {
    icon: faCity,
    title: 'City Tour Malang Batu',
    desc: 'Kunjungan destinasi populer Malang dan Batu untuk keluarga, kantor, dan tamu luar kota.',
    url: '/city-tour-malang-batu/',
  },
  {
    icon: faMosque,
    title: 'Wisata Religi',
    desc: 'Transportasi untuk ziarah dan wisata religi dengan armada keluarga atau rombongan.',
    url: '/wisata-religi-malang/',
  },
]

const reviews = [
  { name: 'Pelanggan Gunz Travel', service: 'Travel Malang Juanda', text: 'Admin cepat merespons, driver tepat waktu, dan perjalanan terasa nyaman.' },
  { name: 'Pelanggan Gunz Travel', service: 'Sewa Hiace Malang', text: 'Armada cocok untuk rombongan keluarga. Proses booking mudah melalui WhatsApp.' },
  { name: 'Pelanggan Gunz Travel', service: 'Wisata Bromo', text: 'Perjalanan ke Bromo lancar. Driver paham rute dan komunikatif.' },
]

const faqs = [
  {
    q: 'Apakah travel Malang Juanda tersedia 24 jam?',
    a: 'Ya. Gunz Travel melayani travel Malang Juanda 24 jam, termasuk untuk penerbangan dini hari dan malam. Layanan by reservation, hubungi admin untuk konfirmasi jadwal.',
  },
  {
    q: 'Berapa harga travel Malang Surabaya?',
    a: 'Harga travel Malang Surabaya mulai dari Rp150.000 per orang dengan sistem door to door. Harga final menyesuaikan titik jemput dan tujuan akhir.',
  },
  {
    q: 'Apakah Gunz Travel melayani jemput ke rumah?',
    a: 'Ya. Penjemputan bisa dilakukan di rumah, hotel, stasiun, bandara, atau titik lain sesuai kesepakatan. Layanan door to door tersedia untuk semua rute.',
  },
  { q: 'Apakah bisa pesan travel mendadak?', a: 'Bisa, selama armada masih tersedia. Namun, pemesanan H-1 lebih disarankan agar jadwal lebih aman, terutama untuk travel Malang Juanda dan travel Malang Surabaya.' },
  { q: 'Apakah tersedia layanan antar jemput Bandara Juanda?', a: 'Ya. Gunz Travel melayani travel Malang Juanda dan Juanda Malang 24 jam dengan armada nyaman dan driver berpengalaman.' },
  { q: 'Apakah bisa sewa mobil Malang untuk luar kota?', a: 'Bisa. Sewa mobil Malang dengan driver untuk tujuan Surabaya, Bromo, Bali, Jogja, dan kota lain. Tersedia Avanza, Innova, Alphard, Pajero, Hiace, dan Elf.' },
  { q: 'Apakah tersedia armada rombongan?', a: 'Ya. Tersedia sewa Hiace Commuter, Hiace Premio, dan Elf Long 14 sampai 18 seat untuk rombongan keluarga, kantor, dan wisata.' },
  { q: 'Bagaimana cara booking Gunz Travel?', a: 'Customer cukup menghubungi admin melalui WhatsApp dan mengirim data perjalanan: tanggal, jam, titik jemput, tujuan, dan jumlah penumpang.' },
]

/* ── SEO: FAQ + BreadcrumbList + Service JSON-LD ── */
const route = useRoute()
const baseUrl = 'https://gunztravel.com'

function setJsonLd(id, data) {
  let el = document.getElementById(id)
  if (!el) {
    el = document.createElement('script')
    el.id = id
    el.type = 'application/ld+json'
    document.head.appendChild(el)
  }
  el.textContent = JSON.stringify(data)
}

onMounted(() => {
  setJsonLd('ld-faq-home', {
    '@context': 'https://schema.org',
    '@type': 'FAQPage',
    mainEntity: faqs.map((f) => ({
      '@type': 'Question',
      name: f.q,
      acceptedAnswer: { '@type': 'Answer', text: f.a },
    })),
  })

  setJsonLd('ld-breadcrumb-home', {
    '@context': 'https://schema.org',
    '@type': 'BreadcrumbList',
    itemListElement: [
      { '@type': 'ListItem', position: 1, name: 'Home', item: baseUrl + '/' },
    ],
  })

  setJsonLd('ld-service-home', {
    '@context': 'https://schema.org',
    '@type': 'Service',
    serviceType: 'Travel dan Rental Mobil',
    provider: {
      '@type': 'TravelAgency',
      name: 'Gunz Travel',
      url: baseUrl,
    },
    areaServed: [
      { '@type': 'City', name: 'Malang' },
      { '@type': 'City', name: 'Surabaya' },
      { '@type': 'Place', name: 'Bandara Juanda' },
    ],
    hasOfferCatalog: {
      '@type': 'OfferCatalog',
      name: 'Travel & Sewa Mobil Malang',
      itemListElement: [
        { '@type': 'OfferCatalog', name: 'Travel Malang Juanda 24 Jam', itemListElement: [{ '@type': 'Offer', itemOffered: { '@type': 'Service', name: 'Travel Malang Juanda', description: 'Antar jemput Malang ke Bandara Juanda 24 jam door to door' } }] },
        { '@type': 'OfferCatalog', name: 'Travel Malang Surabaya', itemListElement: [{ '@type': 'Offer', itemOffered: { '@type': 'Service', name: 'Travel Malang Surabaya', description: 'Travel Malang Surabaya door to door mulai Rp150.000' } }] },
        { '@type': 'OfferCatalog', name: 'Sewa Mobil Malang', itemListElement: [{ '@type': 'Offer', itemOffered: { '@type': 'Service', name: 'Sewa Mobil Malang dengan Driver', description: 'Rental mobil Malang lengkap: Avanza, Innova, Alphard, Pajero, Hiace, Elf' } }] },
      ],
    },
  })
})

onUnmounted(() => {
  document.getElementById('ld-faq-home')?.remove()
  document.getElementById('ld-breadcrumb-home')?.remove()
  document.getElementById('ld-service-home')?.remove()
})
</script>

<template>
  <main id="home">
    <HeroSection :wa-href="waHref" />
    <QuickBookingSection @submit="sendBooking" />
    <ServicesSection :services="services" />
    <FleetSection :fleets="fleets" />
    <PriceSection :prices="prices" :wa-href="waHref" />
    <AreaSection :areas="areas" />
    <BenefitsSection :benefits="benefits" />
    <StepsSection />
    <ToursSection :tours="tours" />
    <ReviewsSection :reviews="reviews" />

    <!-- SEO Content Section -->
    <section class="px-4 py-16 lg:px-6 lg:py-24">
      <div class="mx-auto max-w-4xl">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm lg:p-12">
          <h2 class="text-2xl font-black tracking-tight text-slate-950 sm:text-3xl">
            Travel Malang Juanda &amp; Travel Malang Surabaya – Layanan 24 Jam Door to Door
          </h2>
          <div class="mt-6 space-y-4 text-sm leading-7 text-slate-600">
            <p>
              <strong>Gunz Travel</strong> adalah penyedia jasa <strong>travel Malang Juanda</strong> dan <strong>travel Malang Surabaya</strong> yang beroperasi
              <strong>24 jam</strong>. Kami melayani rute <strong>travel Malang – Juanda</strong> dengan sistem door to door, termasuk penjemputan di rumah, hotel,
              stasiun, dan terminal di area Malang, Batu, dan sekitarnya menuju Bandara Juanda Surabaya.
            </p>
            <p>
              Layanan <strong>travel Malang Juanda 24 jam</strong> kami dirancang untuk penumpang dengan jadwal penerbangan pagi, siang, maupun malam.
              Anda tidak perlu khawatir dengan jadwal yang kaku – kami menyesuaikan waktu keberangkatan dengan jam penerbangan Anda.
              Driver berpengalaman dan paham rute Malang–Juanda via tol maupun jalur alternatif.
            </p>
            <p>
              Selain rute bandara, Gunz Travel juga menyediakan layanan <strong>travel Malang Surabaya</strong> untuk perjalanan reguler antar kota.
              Dengan armada terawat dan driver berpengalaman, perjalanan Malang – Surabaya menjadi lebih nyaman dan terjangkau mulai dari Rp150.000 per orang.
            </p>
            <p>
              Kami juga menyediakan <strong>sewa mobil Malang</strong> dengan driver untuk berbagai kebutuhan: <strong>sewa Innova Malang</strong>,
              <strong>sewa Alphard Malang</strong>, <strong>sewa Hiace Malang</strong>, <strong>sewa Pajero Malang</strong>, dan <strong>sewa Elf Malang</strong>.
              Semua unit dilengkapi driver profesional dan bisa dijemput di titik manapun di Malang dan Batu.
            </p>
          </div>
          <div class="mt-6 flex flex-wrap gap-2">
            <router-link to="/travel-malang-juanda/" class="rounded-full bg-brand-50 px-4 py-2 text-xs font-extrabold text-brand-800 transition hover:bg-brand-100">Travel Malang Juanda</router-link>
            <router-link to="/travel-malang-surabaya/" class="rounded-full bg-brand-50 px-4 py-2 text-xs font-extrabold text-brand-800 transition hover:bg-brand-100">Travel Malang Surabaya</router-link>
            <router-link to="/sewa-mobil-malang/" class="rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700 transition hover:bg-slate-200">Sewa Mobil Malang</router-link>
            <router-link to="/sewa-innova-reborn-malang/" class="rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700 transition hover:bg-slate-200">Sewa Innova Malang</router-link>
            <router-link to="/sewa-hiace-malang/" class="rounded-full bg-slate-100 px-4 py-2 text-xs font-extrabold text-slate-700 transition hover:bg-slate-200">Sewa Hiace Malang</router-link>
          </div>
        </div>
      </div>
    </section>

    <FaqSection :faqs="faqs" />
    <FinalCtaSection :wa-href="waHref" />
  </main>
</template>
