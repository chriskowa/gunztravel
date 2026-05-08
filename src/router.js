import { createRouter, createWebHistory } from 'vue-router'
import HomePage from './pages/HomePage.vue'
import SewaMobilLandingPage from './pages/SewaMobilLandingPage.vue'
import TravelLandingPage from './pages/TravelLandingPage.vue'
import VehicleDetailPage from './pages/VehicleDetailPage.vue'

const siteName = 'Gunz Travel'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomePage,
    meta: { title: 'Travel & Sewa Mobil Malang' },
  },
  {
    path: '/sewa-mobil-malang/',
    name: 'sewa-mobil',
    component: SewaMobilLandingPage,
    meta: { title: 'Sewa Mobil Malang (Dengan Driver)' },
  },
  {
    path: '/travel-malang-surabaya/',
    name: 'travel-malang-surabaya',
    component: TravelLandingPage,
    meta: { title: 'Travel Malang Surabaya (Door to Door)' },
    props: {
      title: 'Travel Malang – Surabaya (Door to Door)',
      subtitle: 'Antar jemput Malang, Batu, dan sekitarnya menuju Surabaya. Cocok untuk dinas, keluarga, dan kebutuhan harian.',
      routeLabel: 'Malang ↔ Surabaya',
      priceFrom: 'Rp150.000/orang',
      pickupAreas: ['Malang Kota', 'Batu', 'Klojen', 'Lowokwaru', 'Sukun'],
      dropAreas: ['Surabaya Kota', 'Gubeng', 'Pasar Turi', 'Terminal Bungurasih', 'Area sesuai kesepakatan'],
      schedule: [
        { time: 'Pagi', eta: '2–3 jam', note: 'Estimasi tergantung titik jemput & kondisi jalan.' },
        { time: 'Siang', eta: '2–3 jam', note: 'Bisa menyesuaikan jadwal by reservation.' },
        { time: 'Malam', eta: '2–3 jam', note: 'Tersedia jika unit & driver tersedia.' },
      ],
      notes: ['Harga dan jadwal menyesuaikan tanggal, titik jemput, dan tujuan akhir.', 'Kirim detail lokasi jemput agar admin bisa estimasi lebih akurat.'],
      heroImage: '/travel/malang-surabaya.webp',
    },
  },
  {
    path: '/travel-malang-juanda/',
    name: 'travel-malang-juanda',
    component: TravelLandingPage,
    meta: { title: 'Travel Malang Juanda 24 Jam' },
    props: {
      title: 'Travel Malang – Bandara Juanda 24 Jam',
      subtitle: 'Antar jemput Malang/Batu menuju Bandara Juanda. Cocok untuk penerbangan pagi, siang, atau malam.',
      routeLabel: 'Malang → Juanda',
      priceFrom: 'Rp150.000/orang',
      pickupAreas: ['Malang Kota', 'Batu', 'Kepanjen', 'Hotel', 'Stasiun'],
      dropAreas: ['Bandara Juanda (T1/T2)', 'Area sekitar Juanda sesuai kesepakatan'],
      schedule: [
        { time: 'Pagi', eta: '2.5–3.5 jam', note: 'Berangkat lebih awal untuk menghindari macet.' },
        { time: 'Siang', eta: '2.5–3.5 jam', note: 'Waktu tempuh tergantung kondisi tol & kota.' },
        { time: 'Malam', eta: '2.5–3.5 jam', note: 'By reservation, cek ketersediaan.' },
      ],
      notes: ['Mohon kirim jam landing/takeoff agar admin bisa rekomendasikan jam jemput.', 'Bisa jemput hotel/rumah/stasiun sesuai kesepakatan.'],
      heroImage: '/travel/malang-juanda.webp',
    },
  },
  {
    path: '/travel-juanda-malang/',
    name: 'travel-juanda-malang',
    component: TravelLandingPage,
    meta: { title: 'Travel Juanda Malang (Door to Door)' },
    props: {
      title: 'Travel Bandara Juanda – Malang (Door to Door)',
      subtitle: 'Jemput dari Bandara Juanda menuju Malang/Batu. Cocok untuk pulang perjalanan dinas atau liburan.',
      routeLabel: 'Juanda → Malang',
      priceFrom: 'Rp150.000/orang',
      pickupAreas: ['Bandara Juanda (T1/T2)', 'Area sekitar Juanda sesuai kesepakatan'],
      dropAreas: ['Malang Kota', 'Batu', 'Hotel', 'Stasiun', 'Kepanjen'],
      schedule: [
        { time: 'Pagi', eta: '2.5–3.5 jam', note: 'Tergantung jam landing & kondisi jalan.' },
        { time: 'Siang', eta: '2.5–3.5 jam', note: 'Bisa menyesuaikan by reservation.' },
        { time: 'Malam', eta: '2.5–3.5 jam', note: 'By reservation, cek unit tersedia.' },
      ],
      notes: ['Kirim nomor penerbangan/jam landing untuk estimasi penjemputan.', 'Tersedia layanan jemput rombongan sesuai ketersediaan unit.'],
      heroImage: '/travel/juanda-malang.webp',
    },
  },
  {
    path: '/travel-batu-juanda/',
    name: 'travel-batu-juanda',
    component: TravelLandingPage,
    meta: { title: 'Travel Batu Juanda' },
    props: {
      title: 'Travel Batu – Bandara Juanda',
      subtitle: 'Antar jemput dari Batu menuju Bandara Juanda. Cocok untuk wisata keluarga, rombongan, dan kebutuhan bandara.',
      routeLabel: 'Batu → Juanda',
      priceFrom: 'Rp150.000/orang',
      pickupAreas: ['Batu', 'Songgoriti', 'Selecta', 'Hotel Batu', 'Alun-alun Batu'],
      dropAreas: ['Bandara Juanda (T1/T2)', 'Area sekitar Juanda sesuai kesepakatan'],
      schedule: [
        { time: 'Pagi', eta: '3–4 jam', note: 'Perhitungkan macet Malang & akses tol.' },
        { time: 'Siang', eta: '3–4 jam', note: 'Cek jam penerbangan agar tidak mepet.' },
        { time: 'Malam', eta: '3–4 jam', note: 'By reservation, cek ketersediaan.' },
      ],
      notes: ['Kirim lokasi hotel/rumah di Batu untuk estimasi penjemputan.', 'Bisa request unit sesuai jumlah penumpang.'],
      heroImage: '/travel/batu-juanda.webp',
    },
  },
  {
    path: '/sewa-avanza-malang/',
    name: 'sewa-avanza',
    component: VehicleDetailPage,
    meta: { title: 'Sewa Avanza / Mobilio Malang' },
    props: {
      title: 'Sewa Avanza / Mobilio Malang',
      subtitle: 'Hemat untuk keluarga kecil, shuttle, dan perjalanan dalam kota. Dengan driver.',
      capacity: '4–6 penumpang',
      highlights: ['Antar jemput fleksibel', 'Driver berpengalaman', 'Cocok untuk bandara & city tour', 'Proses booking cepat via WhatsApp'],
      heroImage: '/armada/avanza.webp',
      fallbackIcon: 'car',
    },
  },
  {
    path: '/sewa-innova-reborn-malang/',
    name: 'sewa-innova-reborn',
    component: VehicleDetailPage,
    meta: { title: 'Sewa Innova Reborn Malang' },
    props: {
      title: 'Sewa Innova Reborn Malang',
      subtitle: 'Nyaman untuk keluarga, tamu kantor, perjalanan luar kota, dan airport transfer. Dengan driver.',
      capacity: '5–7 penumpang',
      highlights: ['Kabin lega & nyaman', 'Cocok perjalanan jauh', 'Driver paham rute', 'Bisa jemput hotel/stasiun/bandara'],
      heroImage: '/armada/innova-reborn.webp',
      fallbackIcon: 'car',
    },
  },
  {
    path: '/sewa-alphard-vellfire-malang/',
    name: 'sewa-alphard-vellfire',
    component: VehicleDetailPage,
    meta: { title: 'Sewa Alphard / Vellfire Malang' },
    props: {
      title: 'Sewa Alphard / Vellfire Malang',
      subtitle: 'Unit premium untuk tamu VIP, wedding, bisnis, dan acara khusus. Dengan driver.',
      capacity: '4–6 penumpang',
      highlights: ['Premium experience', 'Cocok untuk VIP & event', 'Driver profesional', 'Booking mudah via WhatsApp'],
      heroImage: '/armada/alphard.webp',
      fallbackIcon: 'star',
    },
  },
  {
    path: '/sewa-pajero-fortuner-malang/',
    name: 'sewa-pajero-fortuner',
    component: VehicleDetailPage,
    meta: { title: 'Sewa Pajero / Fortuner Malang' },
    props: {
      title: 'Sewa Pajero / Fortuner Malang',
      subtitle: 'SUV untuk perjalanan jauh, medan wisata, dan kebutuhan eksekutif. Dengan driver.',
      capacity: '5–7 penumpang',
      highlights: ['SUV nyaman & gagah', 'Cocok wisata & luar kota', 'Driver berpengalaman', 'Fleksibel titik jemput'],
      heroImage: '/armada/pajero-fortuner.webp',
      fallbackIcon: 'truck',
    },
  },
  {
    path: '/sewa-hiace-malang/',
    name: 'sewa-hiace',
    component: VehicleDetailPage,
    meta: { title: 'Sewa Hiace Malang' },
    props: {
      title: 'Sewa Hiace Malang (Commuter / Premio)',
      subtitle: 'Cocok untuk rombongan keluarga, kantor, wisata Bromo, Batu, Bali, dan Jogja. Dengan driver.',
      capacity: '10–14 penumpang',
      highlights: ['Nyaman untuk rombongan', 'Cocok trip wisata', 'Bagasi lebih lega', 'Booking cepat via WhatsApp'],
      heroImage: '/armada/hiace.webp',
      fallbackIcon: 'van',
    },
  },
  {
    path: '/sewa-elf-malang/',
    name: 'sewa-elf',
    component: VehicleDetailPage,
    meta: { title: 'Sewa Elf Long Malang' },
    props: {
      title: 'Sewa Elf Long Malang',
      subtitle: 'Pilihan rombongan besar untuk ziarah, study tour, outing, dan wisata luar kota. Dengan driver.',
      capacity: '14–18 penumpang',
      highlights: ['Kapasitas besar', 'Cocok outing & ziarah', 'Driver paham rute', 'Harga & jadwal bisa disesuaikan'],
      heroImage: '/armada/elf.webp',
      fallbackIcon: 'bus',
    },
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) return savedPosition
    if (to.hash) return { el: to.hash, behavior: 'smooth' }
    if (to.path !== from.path) return { top: 0 }
    return undefined
  },
})

router.afterEach((to) => {
  const rawTitle = typeof to.meta?.title === 'string' ? to.meta.title.trim() : ''
  document.title = rawTitle ? `${rawTitle} | ${siteName}` : siteName
})

export default router
