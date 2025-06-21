<!-- resources/js/Pages/Carrito/Gracias.vue -->
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <AppLayout>
    <Head title="Gracias por tu compra" />

    <div class="container mx-auto px-4 py-8 text-center">
      <h1 class="text-3xl font-bold mb-4">¡Gracias por tu compra!</h1>
      <p class="mb-6">Tu pedido ha sido procesado correctamente.</p>
      <Link href="/" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Volver a la tienda
      </Link>
    </div>
  </AppLayout>
</template>
