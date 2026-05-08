<script setup>
import SiteFooter from './components/SiteFooter.vue'
import SiteHeader from './components/SiteHeader.vue'
</script>

<template>
  <div class="min-h-screen bg-[#fffdf7] pb-20 text-slate-900 antialiased sm:pb-0">
    <SiteHeader />
    <router-view />
    <SiteFooter />
  </div>
</template>
