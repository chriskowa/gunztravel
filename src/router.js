import { createRouter, createWebHistory } from 'vue-router'
import HomePage from './pages/HomePage.vue'
import SewaMobilLandingPage from './pages/SewaMobilLandingPage.vue'
import TravelLandingPage from './pages/TravelLandingPage.vue'
import VehicleDetailPage from './pages/VehicleDetailPage.vue'
import TourDetailPage from './pages/TourDetailPage.vue'
import BlogLanding from './pages/BlogLanding.vue'
import BlogPost from './pages/BlogPost.vue'
import NotFoundPage from './pages/NotFoundPage.vue'
import ContactPage from './pages/ContactPage.vue'

const siteName = 'Gunz Travel'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomePage,
    meta: { title: 'Travel Malang Juanda 24 Jam, Travel Malang Surabaya & Sewa Mobil Malang', description: 'Gunz Travel melayani travel Malang Juanda 24 jam, travel Malang Surabaya door to door mulai Rp150.000/orang. Sewa mobil Malang dengan driver untuk bandara, dinas, keluarga, dan rombongan. Booking mudah via WhatsApp.' },
  },
  {
    path: '/sewa-mobil-malang/',
    name: 'sewa-mobil',
    component: SewaMobilLandingPage,
    meta: { title: 'Sewa Mobil Malang dengan Driver - Harian & Luar Kota', description: 'Sewa mobil Malang dengan driver untuk dinas, keluarga, luar kota, dan bandara. Avanza, Innova, Alphard, Hiace, Elf. Booking via WhatsApp.' },
  },
  {
    path: '/travel-malang-surabaya/',
    name: 'travel-malang-surabaya',
    component: TravelLandingPage,
    meta: { title: 'Travel Malang Surabaya Door to Door - Mulai Rp150rb', description: 'Travel Malang Surabaya door to door mulai Rp150.000/orang. Jemput rumah, hotel, stasiun. Driver berpengalaman, jadwal fleksibel. Booking via WhatsApp.', ogImage: '/travel/malang-surabaya.webp' },
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
      heroImage: '/malang-surabaya.jpeg',
      faqs: [
        { q: 'Berapa harga travel Malang Surabaya?', a: 'Harga travel Malang Surabaya mulai dari Rp150.000 per orang untuk layanan reguler. Untuk carter drop menyesuaikan jenis mobil.' },
        { q: 'Apakah travel Malang Surabaya melayani door to door?', a: 'Ya, Gunz Travel melayani antar jemput door to door dari alamat di Malang ke alamat tujuan di Surabaya.' },
        { q: 'Bagaimana jadwal keberangkatan travel Malang Surabaya?', a: 'Jadwal travel sangat fleksibel. Tersedia keberangkatan pagi, siang, dan malam menyesuaikan kebutuhan penumpang.' },
        { q: 'Mobil apa yang digunakan untuk travel Malang Surabaya?', a: 'Kami menggunakan armada terawat dan nyaman seperti Avanza, Innova Reborn, Hiace, dan unit lainnya sesuai dengan paket yang dipilih.' }
      ]
    },
  },
  {
    path: '/travel-malang-juanda/',
    name: 'travel-malang-juanda',
    component: TravelLandingPage,
    meta: { title: 'Travel Malang Juanda 24 Jam - Antar Jemput Bandara', description: 'Travel Malang Juanda 24 jam, antar jemput bandara mulai Rp150.000/orang. Jemput di rumah, hotel, stasiun. Booking cepat via WhatsApp.', ogImage: '/travel/malang-juanda.webp' },
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
      heroImage: '/malang-juanda.jpeg',
      faqs: [
        { q: 'Berapa tarif travel Malang Juanda?', a: 'Tarif travel Malang Juanda mulai dari Rp150.000 per orang. Kami memberikan harga terbaik dengan layanan antar jemput langsung ke bandara.' },
        { q: 'Apakah melayani travel Malang Juanda 24 jam?', a: 'Ya, Gunz Travel melayani rute travel Malang Juanda 24 jam dengan sistem by reservation (pemesanan sebelumnya).' },
        { q: 'Berapa lama perjalanan dari Malang ke Bandara Juanda?', a: 'Estimasi perjalanan dari Malang ke Bandara Juanda adalah sekitar 2.5 hingga 3.5 jam, menyesuaikan kondisi lalu lintas dan titik penjemputan.' },
        { q: 'Apakah bisa dijemput di Batu untuk ke Juanda?', a: 'Tentu bisa. Kami melayani penjemputan dari area Batu, Malang Kota, Kepanjen, dan sekitarnya langsung menuju Bandara Juanda.' }
      ]
    },
  },
  {
    path: '/travel-juanda-malang/',
    name: 'travel-juanda-malang',
    component: TravelLandingPage,
    meta: { title: 'Travel Juanda Malang Door to Door - Jemput Bandara', description: 'Travel Juanda Malang door to door. Jemput dari Bandara Juanda ke Malang/Batu mulai Rp150.000/orang. Booking mudah via WhatsApp.', ogImage: '/travel/juanda-malang.webp' },
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
    meta: { title: 'Travel Batu Juanda - Antar Jemput Bandara', description: 'Travel Batu ke Bandara Juanda mulai Rp150.000/orang. Jemput di hotel, Selecta, Songgoriti. Driver berpengalaman, booking via WhatsApp.', ogImage: '/travel/batu-juanda.webp' },
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
    meta: { title: 'Sewa Avanza Malang - Rental Mobil Avanza Murah dengan Driver', description: 'Sewa Avanza Malang dan Mobilio dengan driver berpengalaman. Cocok untuk keluarga kecil, shuttle bandara Juanda, perjalanan dalam kota Malang, dan luar kota. Harga terjangkau, booking via WhatsApp.', ogImage: '/armada/avanza.webp' },
    props: {
      title: 'Sewa Avanza / Mobilio Malang',
      subtitle: 'Hemat untuk keluarga kecil, shuttle, dan perjalanan dalam kota. Dengan driver.',
      capacity: '4–6 penumpang',
      highlights: ['Antar jemput fleksibel', 'Driver berpengalaman', 'Cocok untuk bandara & city tour', 'Proses booking cepat via WhatsApp'],
      images: [
        { src: '/avanza.webp', alt: 'Sewa Avanza Malang Gunz Travel' },
        { src: '/mobilio.webp', alt: 'Sewa Mobilio Malang Gunz Travel' },
      ],
      fallbackIcon: 'car',
    },
  },
  {
    path: '/sewa-innova-reborn-malang/',
    name: 'sewa-innova-reborn',
    component: VehicleDetailPage,
    meta: { title: 'Sewa Innova Malang - Rental Innova Reborn dengan Driver Profesional', description: 'Sewa Innova Malang (Innova Reborn) dengan driver profesional. Nyaman untuk keluarga, tamu kantor, perjalanan luar kota, airport transfer Juanda, dan wisata Bromo. Booking cepat via WhatsApp.', ogImage: '/armada/innova-reborn.webp' },
    props: {
      title: 'Sewa Innova Reborn Malang',
      subtitle: 'Nyaman untuk keluarga, tamu kantor, perjalanan luar kota, dan airport transfer. Dengan driver.',
      capacity: '5–7 penumpang',
      highlights: ['Kabin lega & nyaman', 'Cocok perjalanan jauh', 'Driver paham rute', 'Bisa jemput hotel/stasiun/bandara'],
      images: [
        { src: '/innova.webp', alt: 'Sewa Innova Reborn Malang Gunz Travel' },
      ],
      fallbackIcon: 'car',
    },
  },
  {
    path: '/sewa-alphard-vellfire-malang/',
    name: 'sewa-alphard-vellfire',
    component: VehicleDetailPage,
    meta: { title: 'Sewa Alphard Malang - Rental Alphard Vellfire Premium dengan Driver', description: 'Sewa Alphard Malang dan Vellfire dengan driver profesional. Unit premium untuk tamu VIP, wedding car, perjalanan bisnis, dan acara khusus di Malang. Booking mudah via WhatsApp.', ogImage: '/armada/alphard.webp' },
    props: {
      title: 'Sewa Alphard / Vellfire Malang',
      subtitle: 'Unit premium untuk tamu VIP, wedding, bisnis, dan acara khusus. Dengan driver.',
      capacity: '4–6 penumpang',
      highlights: ['Premium experience', 'Cocok untuk VIP & event', 'Driver profesional', 'Booking mudah via WhatsApp'],
      images: [
        { src: '/vellfire.webp', alt: 'Sewa Vellfire Malang Gunz Travel' },
      ],
      fallbackIcon: 'star',
    },
  },
  {
    path: '/sewa-pajero-fortuner-malang/',
    name: 'sewa-pajero-fortuner',
    component: VehicleDetailPage,
    meta: { title: 'Sewa Pajero Malang - Rental Pajero Fortuner SUV dengan Driver', description: 'Sewa Pajero Malang dan Fortuner VRZ dengan driver berpengalaman. SUV premium untuk perjalanan jauh, wisata Bromo, kebutuhan eksekutif, dan luar kota. Booking via WhatsApp.', ogImage: '/armada/pajero-fortuner.webp' },
    props: {
      title: 'Sewa Pajero / Fortuner Malang',
      subtitle: 'SUV untuk perjalanan jauh, medan wisata, dan kebutuhan eksekutif. Dengan driver.',
      capacity: '5–7 penumpang',
      highlights: ['SUV nyaman & gagah', 'Cocok wisata & luar kota', 'Driver berpengalaman', 'Fleksibel titik jemput'],
      images: [
        { src: '/pajero.webp', alt: 'Sewa Pajero Malang Gunz Travel' },
        { src: '/fortuner.webp', alt: 'Sewa Fortuner Malang Gunz Travel' },
      ],
      fallbackIcon: 'truck',
    },
  },
  {
    path: '/sewa-hiace-malang/',
    name: 'sewa-hiace',
    component: VehicleDetailPage,
    meta: { title: 'Sewa Hiace Malang - Rental Hiace Commuter & Premio untuk Rombongan', description: 'Sewa Hiace Malang (Commuter & Premio) dengan driver berpengalaman. Cocok untuk rombongan keluarga, outing kantor, wisata Bromo, Batu, Bali, dan Jogja. 10-14 seat, booking via WhatsApp.', ogImage: '/armada/hiace.webp' },
    props: {
      title: 'Sewa Hiace Malang (Commuter / Premio)',
      subtitle: 'Cocok untuk rombongan keluarga, kantor, wisata Bromo, Batu, Bali, dan Jogja. Dengan driver.',
      capacity: '10–14 penumpang',
      highlights: ['Nyaman untuk rombongan', 'Cocok trip wisata', 'Bagasi lebih lega', 'Booking cepat via WhatsApp'],
      images: [
        { src: '/hiace-commuter.webp', alt: 'Sewa Hiace Commuter Malang Gunz Travel' },
        { src: '/hiace-premio.webp', alt: 'Sewa Hiace Premio Malang Gunz Travel' },
      ],
      fallbackIcon: 'van',
    },
  },
  {
    path: '/sewa-elf-malang/',
    name: 'sewa-elf',
    component: VehicleDetailPage,
    meta: { title: 'Sewa Elf Malang - Rental Elf Long 14-18 Seat dengan Driver', description: 'Sewa Elf Malang (Elf Long 14-18 seat) dengan driver profesional. Pilihan terbaik untuk ziarah, study tour, outing kantor, dan wisata luar kota dari Malang. Booking via WhatsApp.', ogImage: '/armada/elf.webp' },
    props: {
      title: 'Sewa Elf Long Malang',
      subtitle: 'Pilihan rombongan besar untuk ziarah, study tour, outing, dan wisata luar kota. Dengan driver.',
      capacity: '14–18 penumpang',
      highlights: ['Kapasitas besar', 'Cocok outing & ziarah', 'Driver paham rute', 'Harga & jadwal bisa disesuaikan'],
      images: [
        { src: '/elf-18-seat.webp', alt: 'Sewa Elf Long 18 Seat Malang Gunz Travel' },
        { src: '/elf-14-seat.webp', alt: 'Sewa Elf 14 Seat Malang Gunz Travel' },
      ],
      fallbackIcon: 'bus',
    },
  },
  {
    path: '/paket-wisata-bromo/',
    name: 'paket-wisata-bromo',
    component: TourDetailPage,
    meta: { title: 'Paket Wisata Bromo dari Malang - Open Trip & Private Trip', description: 'Paket wisata Bromo dari Malang mulai Rp250.000/orang. Open trip Bromo sunrise, private trip 2D1N, camping Bromo. Termasuk jeep, tiket masuk, driver berpengalaman. Booking via WhatsApp.' },
    props: {
      title: 'Paket Wisata Bromo dari Malang',
      subtitle: 'Open trip dan private trip Gunung Bromo dari Malang. Nikmati sunrise, kawah Bromo, padang savana, dan Bukit Teletubbies dengan armada nyaman dan driver berpengalaman.',
      heroImage: '/bromo.webp',
      packages: [
        {
          name: 'Open Trip Bromo Sunrise',
          desc: 'Paket open trip berbagi jeep dengan wisatawan lain. Berangkat malam, sunrise pagi, kembali siang.',
          price: 'Rp250.000–300.000/orang',
          priceNum: '250000',
          tag: 'Paling Populer',
          facilities: ['Mobil + Sopir + BBM dari Malang', 'Jeep Bromo (1 jeep 6 orang)', 'Tiket masuk kawasan Bromo'],
        },
        {
          name: 'Paket Bromo 1 Day Trip',
          desc: 'Private trip satu hari penuh. Lebih fleksibel, bisa request destinasi tambahan.',
          price: 'Rp500.000–750.000/orang',
          priceNum: '500000',
          tag: 'Private',
          facilities: ['Transportasi PP dari Malang', 'Jeep Bromo', 'Tiket masuk', 'Wisata sunrise + kawah', 'Sarapan'],
        },
        {
          name: 'Paket Bromo 2D1N',
          desc: 'Paket lengkap 2 hari 1 malam dengan penginapan di area Bromo. Cocok untuk pengalaman lebih lengkap.',
          price: 'Rp1.200.000–1.500.000/orang',
          priceNum: '1200000',
          tag: '2 Hari 1 Malam',
          facilities: ['Transportasi PP dari Malang', 'Penginapan 1 malam', 'Jeep Bromo', 'Tiket masuk', 'Makan (sarapan + makan malam)'],
        },
        {
          name: 'Paket Camping Bromo',
          desc: 'Pengalaman camping di area Bromo dengan perlengkapan lengkap. Cocok untuk adventure lovers.',
          price: 'Rp1.000.000–1.300.000/orang',
          priceNum: '1000000',
          tag: 'Adventure',
          facilities: ['Transportasi PP dari Malang', 'Camping gear lengkap', 'Makan selama camping', 'Tiket masuk kawasan'],
        },
        {
          name: 'Private Trip Bromo',
          desc: 'Trip eksklusif untuk keluarga atau grup kecil. Jadwal dan rute bisa disesuaikan sepenuhnya.',
          price: 'Rp2.000.000–3.500.000/grup',
          priceNum: '2000000',
          tag: 'Eksklusif',
          facilities: ['Transportasi pribadi dari Malang', 'Jeep pribadi', 'Tiket masuk', 'Makan', 'Penjadwalan fleksibel'],
        },
      ],
      itinerary: [
        { time: '23.30', activity: 'Penjemputan di Kota Malang (rumah/hotel/stasiun)' },
        { time: '00.30', activity: 'Perjalanan menuju rest area Bromo' },
        { time: '01.30', activity: 'Transit dan pindah ke Jeep di rest area Bromo' },
        { time: '02.00', activity: 'Perjalanan menuju Sunrise Point (Puncak Penanjakan)' },
        { time: '04.00', activity: 'Menikmati Sunrise View Gunung Bromo' },
        { time: '06.00', activity: 'Mendaki ke Kawah Bromo dan Pura Luhur Poten' },
        { time: '08.00', activity: 'Explore Lautan Pasir (Pasir Berbisik)' },
        { time: '09.00', activity: 'Explore Padang Savana dan Bukit Teletubbies' },
        { time: '10.00', activity: 'Perjalanan kembali ke rest area Bromo' },
        { time: '11.00', activity: 'Perjalanan kembali ke Kota Malang' },
        { time: '12.00', activity: 'Pengantaran di Kota Malang – trip selesai' },
      ],
      destinations: [
        { name: 'Sunrise Point (Puncak Penanjakan)', desc: 'Spot terbaik untuk menikmati matahari terbit dengan latar Gunung Bromo, Batok, dan Semeru.' },
        { name: 'Kawah Bromo', desc: 'Kawah aktif yang dapat dijelajahi. Naik tangga 250 anak tangga menuju bibir kawah.' },
        { name: 'Pura Luhur Poten', desc: 'Pura Hindu yang terletak di kaki Gunung Bromo, di tengah Lautan Pasir.' },
        { name: 'Lautan Pasir (Pasir Berbisik)', desc: 'Area luas yang dikelilingi pasir vulkanik. Spot foto ikonik Bromo.' },
        { name: 'Padang Savana', desc: 'Padang rumput hijau yang luas dan indah, cocok untuk foto landscape.' },
        { name: 'Bukit Teletubbies', desc: 'Bukit-bukit kecil hijau dengan pemandangan menakjubkan di area Bromo.' },
      ],
      includes: [
        'Shuttle dari hotel ke meeting point jeep',
        'Jeep Bromo (1 jeep muat 6 orang)',
        'Tiket masuk kawasan Bromo',
        'Driver berpengalaman dari Malang',
        'BBM dan tol',
        'Dokumentasi perjalanan',
      ],
      notes: [
        'Harga dapat berubah tergantung musim dan permintaan (high season / long weekend).',
        'Bawa jaket tebal – suhu di Bromo bisa mencapai 3°C saat malam dan dini hari.',
        'Penjemputan bisa di rumah, hotel, atau stasiun di area Malang dan Batu.',
        'Pastikan untuk menanyakan fasilitas tambahan atau request khusus ke admin.',
      ],
      faqs: [
        { q: 'Berapa harga open trip Bromo dari Malang?', a: 'Harga open trip Bromo mulai dari Rp250.000 per orang. Harga sudah termasuk mobil, sopir, dan BBM dari Malang ke Bromo.' },
        { q: 'Apa bedanya open trip dan private trip Bromo?', a: 'Open trip berbagi jeep dengan wisatawan lain (1 jeep 6 orang). Private trip menggunakan jeep pribadi, jadwal dan rute lebih fleksibel.' },
        { q: 'Jam berapa berangkat ke Bromo?', a: 'Penjemputan biasanya jam 23.30 malam dari Kota Malang. Ini agar tiba di sunrise point sebelum matahari terbit sekitar jam 04.00–05.00.' },
        { q: 'Apakah bisa dijemput di hotel atau stasiun?', a: 'Bisa. Penjemputan di rumah, hotel, stasiun, atau titik lain di area Malang dan Batu sesuai kesepakatan.' },
        { q: 'Apakah anak kecil dihitung 1 orang?', a: 'Anak usia 3 tahun ke atas dihitung 1 kursi/seat.' },
        { q: 'Bagaimana jika cuaca buruk saat di Bromo?', a: 'Trip tetap berjalan. Namun jika kondisi sangat ekstrem, admin akan koordinasi dengan peserta untuk penjadwalan ulang.' },
      ],
    },
  },
  {
    path: '/city-tour-malang-batu/',
    name: 'city-tour-malang-batu',
    component: TourDetailPage,
    meta: { title: 'City Tour Malang Batu - Paket Wisata Harian Malang', description: 'Paket city tour Malang Batu dengan driver. Kunjungi Jatim Park, Museum Angkut, Batu Night Spectacular, Coban Rondo, dan destinasi populer lainnya. Booking via WhatsApp.' },
    props: {
      title: 'City Tour Malang Batu',
      subtitle: 'Paket wisata harian untuk keluarga, kantor, dan tamu luar kota. Kunjungi destinasi populer di Malang dan Batu dengan armada nyaman dan driver yang paham rute wisata.',
      heroImage: 'wisata-malang-batu.jpg',
      packages: [
        {
          name: 'City Tour Malang 1 Hari',
          desc: 'Kunjungan destinasi populer di Kota Malang. Cocok untuk tamu luar kota yang ingin explore Malang dalam sehari.',
          price: 'Mulai Rp500.000/mobil',
          priceNum: '500000',
          tag: 'Malang Kota',
          facilities: ['Mobil + Sopir + BBM (12 jam)', 'Jemput dan antar hotel/stasiun', 'Rute fleksibel sesuai request'],
        },
        {
          name: 'City Tour Batu 1 Hari',
          desc: 'Explore wahana dan destinasi populer di Kota Batu. Ideal untuk keluarga dan anak-anak.',
          price: 'Mulai Rp500.000/mobil',
          priceNum: '500000',
          tag: 'Kota Batu',
          facilities: ['Mobil + Sopir + BBM (12 jam)', 'Jemput dan antar di Malang/Batu', 'Rute bisa disesuaikan'],
        },
        {
          name: 'Paket Malang – Batu Full Day',
          desc: 'Kombinasi city tour Malang dan Batu dalam satu hari penuh. Destinasi lebih lengkap.',
          price: 'Mulai Rp700.000/mobil',
          priceNum: '700000',
          tag: 'Rekomendasi',
          facilities: ['Mobil + Sopir + BBM (12 jam)', 'Jemput dan antar fleksibel', 'Kunjungi Malang & Batu'],
        },
      ],
      destinations: [
        { name: 'Jatim Park 1, 2 & 3', desc: 'Taman hiburan edukasi terbesar di Jawa Timur. Cocok untuk keluarga dan anak-anak.' },
        { name: 'Museum Angkut', desc: 'Museum transportasi terbesar di Asia Tenggara dengan koleksi kendaraan dari berbagai era.' },
        { name: 'Batu Night Spectacular (BNS)', desc: 'Taman hiburan malam dengan wahana seru dan lampion warna-warni.' },
        { name: 'Coban Rondo', desc: 'Air terjun alami yang sejuk di kawasan Pujon, Batu. Cocok untuk piknik keluarga.' },
        { name: 'Alun-Alun Kota Malang', desc: 'Pusat kota Malang dengan taman hijau, kuliner, dan landmark bersejarah.' },
        { name: 'Kampung Warna-Warni Jodipan', desc: 'Kampung ikonik dengan rumah-rumah berwarna cerah di tepi Sungai Brantas.' },
        { name: 'Selecta', desc: 'Taman rekreasi dan pemandian air panas di lereng Gunung Arjuno.' },
        { name: 'Omah Kayu', desc: 'Rumah pohon dengan pemandangan Kota Batu dari ketinggian. Spot foto populer.' },
        { name: 'Paralayang Batu', desc: 'Spot paralayang dan viewpoint dengan pemandangan Kota Batu dari atas bukit.' },
      ],
      includes: [
        'Mobil dengan driver berpengalaman',
        'BBM dan tol selama perjalanan',
        'Jemput dan antar di area Malang/Batu',
        'Durasi 12 jam (overtime bisa diatur)',
        'Konsultasi rute wisata dari admin',
      ],
      notes: [
        'Harga di atas belum termasuk tiket masuk wahana/destinasi dan parkir.',
        'Tiket wahana bisa dibeli langsung di lokasi atau request dibelikan oleh driver.',
        'Overtime dikenakan biaya tambahan (ditentukan oleh admin).',
        'Rute wisata bisa di-custom sesuai keinginan – konsultasi ke admin.',
      ],
      faqs: [
        { q: 'Berapa harga city tour Malang Batu?', a: 'Harga city tour mulai dari Rp500.000 per mobil (12 jam). Harga sudah termasuk mobil, sopir, dan BBM. Belum termasuk tiket masuk wahana.' },
        { q: 'Apakah bisa request destinasi sendiri?', a: 'Bisa. Rute wisata fleksibel dan bisa disesuaikan dengan keinginan. Chat admin untuk konsultasi rute terbaik.' },
        { q: 'Berapa lama durasi city tour?', a: 'Durasi standar 12 jam. Jika butuh lebih lama, bisa request overtime dengan biaya tambahan.' },
        { q: 'Apakah bisa dijemput di stasiun atau bandara?', a: 'Bisa. Penjemputan di stasiun Malang, hotel, rumah, atau bandara Juanda.' },
        { q: 'Armada apa saja yang tersedia?', a: 'Tersedia Avanza, Innova, Hiace, dan Elf sesuai jumlah peserta. Chat admin untuk rekomendasi.' },
      ],
    },
  },
  {
    path: '/wisata-religi-malang/',
    name: 'wisata-religi-malang',
    component: TourDetailPage,
    meta: { title: 'Wisata Religi Malang - Paket Ziarah & Transportasi Rombongan', description: 'Paket wisata religi dan ziarah dari Malang dengan armada keluarga atau rombongan. Kunjungi masjid, pesantren, makam wali, dan tempat bersejarah. Booking via WhatsApp.' },
    props: {
      title: 'Wisata Religi Malang',
      subtitle: 'Transportasi untuk ziarah dan wisata religi dari Malang. Cocok untuk rombongan keluarga, jamaah masjid, dan pengajian. Tersedia armada keluarga hingga bus mini.',
      heroImage: 'wisata-religi.webp',
      packages: [
        {
          name: 'Wisata Religi Malang Raya',
          desc: 'Kunjungan ziarah ke masjid dan makam bersejarah di area Malang dan Batu.',
          price: 'Mulai Rp500.000/mobil',
          priceNum: '500000',
          tag: 'Malang & Batu',
          facilities: ['Mobil + Sopir + BBM (12 jam)', 'Jemput dan antar area Malang', 'Rute bisa disesuaikan'],
        },
        {
          name: 'Ziarah Wali Jawa Timur',
          desc: 'Rombongan ziarah ke makam wali di Jawa Timur (Sunan Ampel, Sunan Giri, Sunan Drajat, dll).',
          price: 'Hubungi admin',
          priceNum: '',
          tag: 'Wali Songo',
          facilities: ['Hiace/Elf + Sopir + BBM', 'Rute ziarah disesuaikan', 'Bisa multi-day'],
        },
        {
          name: 'Wisata Religi Rombongan',
          desc: 'Paket transportasi untuk rombongan besar (jamaah, pengajian, sekolah). Armada Hiace atau Elf.',
          price: 'Hubungi admin',
          priceNum: '',
          tag: 'Rombongan',
          facilities: ['Hiace (10–14 seat) atau Elf (14–18 seat)', 'Sopir berpengalaman', 'Rute & durasi fleksibel'],
        },
      ],
      destinations: [
        { name: 'Masjid Agung Jami Malang', desc: 'Masjid bersejarah di pusat Kota Malang, dibangun sejak era kolonial Belanda.' },
        { name: 'Masjid Tiban Turen', desc: 'Masjid unik di Turen, Malang, yang terkenal karena cerita pembangunannya yang misterius.' },
        { name: 'Makam Sunan Ampel Surabaya', desc: 'Makam Sunan Ampel, salah satu Wali Songo, di Surabaya. Destinasi ziarah utama Jawa Timur.' },
        { name: 'Makam Sunan Giri Gresik', desc: 'Makam Sunan Giri di Gresik, salah satu penyebar Islam di Jawa.' },
        { name: 'Pesantren & Pondok Malang', desc: 'Kunjungan ke pesantren dan pondok di area Malang dan sekitarnya.' },
        { name: 'Masjid Agung Batu', desc: 'Masjid besar di Kota Batu dengan arsitektur modern dan pemandangan pegunungan.' },
      ],
      includes: [
        'Armada sesuai jumlah rombongan',
        'Driver berpengalaman dan paham rute ziarah',
        'BBM dan tol selama perjalanan',
        'Jemput dan antar di area Malang/Batu',
        'Jadwal fleksibel sesuai kebutuhan jamaah',
      ],
      notes: [
        'Harga menyesuaikan jumlah rombongan, tujuan, dan durasi perjalanan.',
        'Untuk ziarah Wali Songo multi-day, hubungi admin untuk penawaran khusus.',
        'Bisa digabung dengan wisata kuliner atau destinasi lain sesuai request.',
        'Tersedia armada dari Avanza hingga Elf Long untuk berbagai ukuran rombongan.',
      ],
      faqs: [
        { q: 'Apakah tersedia armada untuk rombongan ziarah?', a: 'Ya. Tersedia Hiace Commuter (10–14 seat), Hiace Premio, dan Elf Long (14–18 seat) untuk rombongan besar.' },
        { q: 'Apakah bisa ziarah ke makam wali di luar Malang?', a: 'Bisa. Kami melayani rute ziarah ke Sunan Ampel (Surabaya), Sunan Giri (Gresik), Sunan Drajat (Lamongan), dan tujuan lainnya.' },
        { q: 'Berapa harga wisata religi untuk rombongan?', a: 'Harga menyesuaikan jumlah peserta, tujuan, dan durasi. Chat admin untuk penawaran khusus rombongan.' },
        { q: 'Apakah bisa multi-day (lebih dari 1 hari)?', a: 'Bisa. Paket multi-day tersedia untuk ziarah Wali Songo atau rute jauh. Admin bantu susun itinerary.' },
        { q: 'Bagaimana cara booking untuk rombongan?', a: 'Hubungi admin via WhatsApp, kirim jumlah peserta, tujuan ziarah, tanggal keberangkatan, dan titik jemput.' },
      ],
    },
  },
  {
    path: '/blog',
    name: 'blog-landing',
    component: BlogLanding,
    meta: {
      title: 'Blog & Tips Perjalanan',
      description: 'Temukan informasi rute travel, tips perjalanan sewa mobil, dan destinasi wisata terbaru dari Gunz Travel.'
    }
  },
  {
    path: '/blog/:slug',
    name: 'blog-post',
    component: BlogPost,
    meta: {
      title: 'Artikel',
      description: 'Baca selengkapnya di Blog Gunz Travel.'
    }
  },
  {
    path: '/contact/',
    name: 'contact',
    component: ContactPage,
    meta: {
      title: 'Hubungi Kami',
      description: 'Hubungi Gunz Travel untuk pemesanan travel, sewa mobil, dan paket wisata. Layanan pelanggan 24 jam via WhatsApp.'
    }
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'not-found',
    component: NotFoundPage,
    meta: { title: '404 - Halaman Tidak Ditemukan', description: 'Maaf, halaman yang Anda cari tidak ditemukan di Gunz Travel.' },
  },
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) return savedPosition
    if (to.hash) return { el: to.hash, behavior: 'smooth' }
    if (to.path !== from.path) return { top: 0 }
    return undefined
  },
})

router.afterEach((to) => {
  const baseUrl = 'https://gunztravel.com'
  const rawTitle = typeof to.meta?.title === 'string' ? to.meta.title.trim() : ''
  const fullTitle = rawTitle ? `${rawTitle} | ${siteName}` : siteName
  const desc = typeof to.meta?.description === 'string' ? to.meta.description.trim() : ''
  const ogImage = to.meta?.ogImage || '/logo-gunz-travel.webp'

  document.title = fullTitle

  function setMeta(attr, key, content) {
    let el = document.querySelector(`meta[${attr}="${key}"]`)
    if (!el) {
      el = document.createElement('meta')
      el.setAttribute(attr, key)
      document.head.appendChild(el)
    }
    el.setAttribute('content', content)
  }

  setMeta('name', 'description', desc)
  setMeta('property', 'og:title', fullTitle)
  setMeta('property', 'og:description', desc)
  setMeta('property', 'og:type', 'website')
  setMeta('property', 'og:url', baseUrl + to.path)
  setMeta('property', 'og:image', baseUrl + ogImage)
  setMeta('property', 'og:site_name', siteName)
  setMeta('property', 'og:locale', 'id_ID')
  setMeta('name', 'twitter:card', 'summary_large_image')
  setMeta('name', 'twitter:title', fullTitle)
  setMeta('name', 'twitter:description', desc)
  setMeta('name', 'twitter:image', baseUrl + ogImage)

  let canonical = document.querySelector('link[rel="canonical"]')
  if (!canonical) {
    canonical = document.createElement('link')
    canonical.setAttribute('rel', 'canonical')
    document.head.appendChild(canonical)
  }
  canonical.setAttribute('href', baseUrl + to.path)

  // Track virtual pageview on SPA transitions
  if (typeof window.gtag === 'function') {
    window.gtag('config', 'AW-16762703567', {
      page_path: to.path,
      page_title: document.title,
    })
  }
})

export default router
