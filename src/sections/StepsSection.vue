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
        <p class="mb-4 text-sm font-extrabold uppercase tracking-widest text-amber-600">Proses Mudah</p>
        <h2 class="font-serif text-4xl font-bold leading-tight tracking-tight text-slate-900 sm:text-5xl lg:leading-tight">
          Cepat, jelas, tanpa ribet.
        </h2>
        <p class="mt-6 text-lg leading-relaxed text-slate-600">
          Hanya butuh beberapa menit. Kirim rincian perjalanan, dapatkan konfirmasi instan, dan kendaraan premium siap menjemput Anda tepat waktu.
        </p>
      </div>

      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div
          v-for="(step, index) in steps"
          :key="step.title"
          class="relative overflow-hidden rounded-[2rem] border border-white/60 bg-white/60 p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] backdrop-blur-md transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)]"
        >
          <!-- Number watermark -->
          <div class="absolute -right-4 -top-6 text-8xl font-black text-amber-500/5 select-none">
            {{ index + 1 }}
          </div>
          
          <div class="relative z-10">
            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-100 to-amber-200 text-xl text-amber-700 shadow-inner">
              <font-awesome-icon :icon="step.icon" />
            </div>
            <h3 class="mb-3 font-serif text-xl font-bold text-slate-900">{{ step.title }}</h3>
            <p class="text-sm leading-relaxed text-slate-600">{{ step.desc }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
