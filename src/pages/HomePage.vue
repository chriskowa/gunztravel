<script setup>
import { computed } from 'vue'
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
    title: 'Travel Malang Juanda',
    desc: 'Antar jemput Malang, Batu, dan sekitar menuju Bandara Juanda Surabaya.',
    url: '/travel-malang-juanda/',
  },
  {
    icon: faCarSide,
    title: 'Sewa Mobil Malang',
    desc: 'Sewa mobil dengan driver untuk dinas, keluarga, luar kota, hotel, dan stasiun.',
    url: '/sewa-mobil-malang/',
  },
  {
    icon: faVanShuttle,
    title: 'Hiace dan Elf Rombongan',
    desc: 'Hiace Commuter, Hiace Premio, dan Elf Long untuk rombongan 14 sampai 18 seat.',
    url: '/sewa-hiace-malang/',
  },
  {
    icon: faMountain,
    title: 'Paket Wisata',
    desc: 'Paket Bromo, city tour Malang Batu, wisata religi, Pantai Selatan, Bali, dan Jogja.',
    url: '/paket-wisata-bromo/',
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
    q: 'Apakah Gunz Travel melayani jemput ke rumah?',
    a: 'Ya. Penjemputan bisa dilakukan di rumah, hotel, stasiun, bandara, atau titik lain sesuai kesepakatan.',
  },
  { q: 'Apakah bisa pesan mendadak?', a: 'Bisa, selama armada masih tersedia. Namun, pemesanan H-1 lebih disarankan agar jadwal lebih aman.' },
  { q: 'Apakah tersedia layanan ke Bandara Juanda?', a: 'Ya. Gunz Travel melayani travel Malang Juanda dan Juanda Malang.' },
  { q: 'Apakah bisa sewa mobil untuk luar kota?', a: 'Bisa. Tujuan dapat disesuaikan, termasuk Surabaya, Bromo, Bali, Jogja, dan kota lain.' },
  { q: 'Apakah tersedia armada rombongan?', a: 'Ya. Tersedia Hiace Commuter, Hiace Premio, dan Elf Long 14 sampai 18 seat.' },
  { q: 'Bagaimana cara booking?', a: 'Customer cukup menghubungi admin melalui WhatsApp dan mengirim data perjalanan.' },
]
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
    <FaqSection :faqs="faqs" />
    <FinalCtaSection :wa-href="waHref" />
  </main>
</template>
