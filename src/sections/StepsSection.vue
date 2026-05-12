<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faCalendarCheck, faComments, faCircleCheck, faCarSide } from '@fortawesome/free-solid-svg-icons'

const props = defineProps({
  steps: {
    type: Array,
    default: () => [
      {
        title: 'Pilih Jadwal',
        desc: 'Tentukan tanggal, jam, dan titik jemput.',
        icon: faCalendarCheck,
      },
      {
        title: 'Hubungi Admin',
        desc: 'Kirim format singkat via WhatsApp.',
        icon: faComments,
      },
      {
        title: 'Konfirmasi',
        desc: 'Admin konfirmasi harga dan unit.',
        icon: faCircleCheck,
      },
      {
        title: 'Berangkat',
        desc: 'Driver jemput dan siap melayani.',
        icon: faCarSide,
      },
    ],
  },
})
</script>

<template>
  <section class="bg-gradient-to-br from-orange-50 via-white to-amber-50 px-4 py-24 text-slate-900 lg:px-6 lg:py-32">
    <div class="mx-auto max-w-7xl">
      <div class="mb-16 max-w-2xl">
        <p class="mb-4 text-sm font-extrabold uppercase tracking-widest text-brand-700">Proses Mudah</p>
        <h2 class="text-3xl font-black leading-tight tracking-tight text-slate-950 sm:text-4xl lg:text-5xl lg:leading-tight">
          Cepat, jelas, tanpa ribet.
        </h2>
        <p class="mt-6 text-base leading-relaxed text-slate-600 sm:text-lg">
          Hanya butuh beberapa menit. Kirim rincian perjalanan, dapatkan konfirmasi instan, dan kendaraan premium siap menjemput Anda tepat waktu.
        </p>
      </div>

      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div
          v-for="(step, index) in steps"
          :key="step.title"
          class="relative overflow-hidden rounded-[2.5rem] border border-white bg-white p-8 shadow-soft transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl"
        >
          <!-- Number watermark -->
          <div class="absolute -right-4 -top-6 text-8xl font-black text-slate-100 select-none">
            {{ index + 1 }}
          </div>
          
          <div class="relative z-10">
            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-3xl bg-brand-50 text-xl text-brand-700 shadow-inner ring-1 ring-brand-100">
              <font-awesome-icon :icon="step.icon" />
            </div>
            <h3 class="mb-3 text-xl font-black text-slate-950">{{ step.title }}</h3>
            <p class="text-sm leading-relaxed text-slate-600">{{ step.desc }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
