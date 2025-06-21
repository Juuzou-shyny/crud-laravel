<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  producto: Object
});
</script>

<template>
  <AppLayout :title="producto.nombre">
    <div class="py-12">
      <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
          <div class="flex flex-col md:flex-row">
            <!-- Imagen -->
            <div class="md:w-1/2 p-6">
              <img :src="producto.imagen_url" :alt="producto.nombre" class="w-full h-auto rounded">
            </div>

            <!-- Detalles -->
            <div class="md:w-1/2 p-6">
              <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ producto.nombre }}</h1>
              <p class="text-gray-700 mb-6">{{ producto.descripcion }}</p>

              <p class="text-2xl font-bold text-green-600">{{ producto.precio }} €</p>

              <div class="mt-6">
                <Link href="/carrito" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                  Añadir al carrito
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
