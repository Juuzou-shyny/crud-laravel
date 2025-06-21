<!-- resources/js/Layouts/AppLayout.vue -->
<template>
  <div class="min-h-screen bg-[#F6F1EB] text-[#585858] flex flex-col">
    <Navbar />
    <main class="container mx-auto px-4 py-6 flex-grow">
      <slot />
    </main>
    <Footer />
  </div>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
</script>
