<script setup>
import { reactive } from 'vue'
import { faWhatsapp } from '@fortawesome/free-brands-svg-icons'

const emit = defineEmits(['submit'])

const booking = reactive({
  service: 'Travel Malang Juanda',
  car: 'Belum memilih',
  date: '',
  passengers: '',
  destination: '',
})

function submit() {
  emit('submit', { ...booking })
}
</script>

<template>
  <section id="cek-harga" class="relative z-10 -mt-6 px-4 lg:-mt-12 lg:px-6">
    <div class="mx-auto max-w-7xl rounded-[2rem] border border-slate-200 bg-white p-5 shadow-soft lg:p-7">
      <div class="grid gap-5 lg:grid-cols-[0.7fr_1.3fr] lg:items-center">
        <div>
          <p class="text-sm font-extrabold uppercase tracking-wide text-brand-700">Cek Harga Cepat</p>
          <h2 class="mt-2 text-2xl font-black tracking-tight text-slate-950">Booking lebih cepat via WhatsApp</h2>
          <p class="mt-2 text-sm leading-6 text-slate-600">Isi data singkat. Tombol akan membuat pesan otomatis ke admin Gunz Travel.</p>
        </div>

        <form class="grid gap-3 md:grid-cols-2 lg:grid-cols-12 lg:gap-4" @submit.prevent="submit">
          <label class="grid min-w-0 gap-1 lg:col-span-4">
            <span class="text-xs font-bold text-slate-600">Layanan</span>
            <select
              v-model="booking.service"
              class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-brand-600"
            >
              <option>Travel Malang Juanda</option>
              <option>Travel Juanda Malang</option>
              <option>Travel Malang Surabaya</option>
              <option>Sewa Mobil Malang</option>
              <option>Sewa Hiace Malang</option>
              <option>Sewa Elf Malang</option>
              <option>Paket Wisata Bromo</option>
              <option>City Tour Malang Batu</option>
            </select>
          </label>

          <label class="grid min-w-0 gap-1 lg:col-span-4">
            <span class="text-xs font-bold text-slate-600">Armada</span>
            <select
              v-model="booking.car"
              class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-brand-600"
            >
              <option>Belum memilih</option>
              <option>Avanza / Mobilio</option>
              <option>Innova Reborn</option>
              <option>Alphard / Vellfire</option>
              <option>Pajero / Fortuner VRZ</option>
              <option>Hiace Commuter / Premio</option>
              <option>Elf Long 18 Seat / 14 Seat</option>
            </select>
          </label>

          <label class="grid min-w-0 gap-1 lg:col-span-4">
            <span class="text-xs font-bold text-slate-600">Tanggal</span>
            <input
              v-model="booking.date"
              type="date"
              class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-brand-600"
            />
          </label>

          <label class="grid min-w-0 gap-1 lg:col-span-3">
            <span class="text-xs font-bold text-slate-600">Penumpang</span>
            <input
              v-model="booking.passengers"
              type="number"
              min="1"
              placeholder="Jumlah"
              class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-brand-600"
            />
          </label>

          <label class="grid min-w-0 gap-1 lg:col-span-5">
            <span class="text-xs font-bold text-slate-600">Tujuan</span>
            <input
              v-model="booking.destination"
              type="text"
              placeholder="Juanda / Bromo"
              class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-brand-600"
            />
          </label>

          <button
            class="cta-glow self-end flex h-12 items-center justify-center gap-2 rounded-2xl bg-brand-500 px-6 py-3 text-sm font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white md:col-span-2 lg:col-span-4"
            type="submit"
          >
            <font-awesome-icon :icon="faWhatsapp" class="text-lg" />
            Cek via WA
          </button>
        </form>
      </div>
    </div>
  </section>
</template>
