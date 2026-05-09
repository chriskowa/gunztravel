import { faBus, faCarSide, faStar, faTruckMonster, faVanShuttle } from '@fortawesome/free-solid-svg-icons'

export const fleets = [
  {
    icon: faCarSide,
    name: 'Avanza / Mobilio',
    desc: 'Pilihan hemat untuk keluarga kecil, shuttle, dan perjalanan dalam kota.',
    capacity: '4 sampai 6 penumpang',
    url: '/sewa-avanza-malang/',
    images: [
      { src: '/avanza.webp', alt: 'Sewa Avanza Malang Gunz Travel' },
      { src: '/mobilio.webp', alt: 'Sewa Mobilio Malang Gunz Travel' },
    ],
  },
  {
    icon: faCarSide,
    name: 'Innova Reborn',
    desc: 'Nyaman untuk keluarga, tamu kantor, perjalanan luar kota, dan airport transfer.',
    capacity: '5 sampai 7 penumpang',
    url: '/sewa-innova-reborn-malang/',
    images: [
      { src: '/innova.webp', alt: 'Sewa Innova Reborn Malang Gunz Travel' },
    ],
  },
  {
    icon: faStar,
    name: 'Alphard / Vellfire',
    desc: 'Unit premium untuk tamu VIP, wedding, bisnis, dan acara khusus.',
    capacity: '4 sampai 6 penumpang',
    url: '/sewa-alphard-vellfire-malang/',
    images: [
      { src: '/vellfire.webp', alt: 'Sewa Vellfire Malang Gunz Travel' },
    ],
  },
  {
    icon: faTruckMonster,
    name: 'Pajero / Fortuner VRZ',
    desc: 'SUV untuk perjalanan jauh, medan wisata, dan kebutuhan eksekutif.',
    capacity: '5 sampai 7 penumpang',
    url: '/sewa-pajero-fortuner-malang/',
    images: [
      { src: '/pajero.webp', alt: 'Sewa Pajero Malang Gunz Travel' },
      { src: '/fortuner.webp', alt: 'Sewa Fortuner Malang Gunz Travel' },
    ],
  },
  {
    icon: faVanShuttle,
    name: 'Hiace Commuter / Premio',
    desc: 'Cocok untuk rombongan keluarga, kantor, wisata Bromo, Batu, Bali, dan Jogja.',
    capacity: '10 sampai 14 penumpang',
    url: '/sewa-hiace-malang/',
    images: [
      { src: '/hiace-commuter.webp', alt: 'Sewa Hiace Commuter Malang Gunz Travel' },
      { src: '/hiace-premio.webp', alt: 'Sewa Hiace Premio Malang Gunz Travel' },
    ],
  },
  {
    icon: faBus,
    name: 'Elf Long 18 Seat / 14 Seat',
    desc: 'Pilihan rombongan besar untuk ziarah, study tour, outing, dan wisata luar kota.',
    capacity: '14 sampai 18 penumpang',
    url: '/sewa-elf-malang/',
    images: [
      { src: '/elf-18-seat.webp', alt: 'Sewa Elf Long 18 Seat Malang Gunz Travel' },
      { src: '/elf-14-seat.webp', alt: 'Sewa Elf 14 Seat Malang Gunz Travel' },
    ],
  },
]
