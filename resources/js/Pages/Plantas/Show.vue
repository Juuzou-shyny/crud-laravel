<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'
defineProps({
  planta: Object
})
</script>

<template>
  <AppLayout :title="planta.nombre">
    <div class="py-12">
      <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
          <div class="flex flex-col md:flex-row">
            <!-- Imagen -->
            <div class="md:w-1/2 p-6">
              <img :src="planta.imagen_url" :alt="planta.nombre" class="w-full h-auto rounded">
            </div>

            <!-- Detalles -->
            <div class="md:w-1/2 p-6">
              <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ planta.nombre }}</h1>
              <p class="text-gray-700 mb-6">{{ planta.descripcion }}</p>

              <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Detalles del cuidado:</h2>
                <ul class="space-y-2">
                  <li><strong>Tipo:</strong> {{ planta.detallesPlanta.tipo }}</li>
                  <li><strong>Riego:</strong> {{ planta.detallesPlanta.riego }}</li>
                  <li><strong>Luz:</strong> {{ planta.detallesPlanta.luz }}</li>
                  <li><strong>Dificultad:</strong> {{ planta.detallesPlanta.dificultad }}</li>
                  <li><strong>Fertilización:</strong> {{ planta.detallesPlanta.fertilizacion }}</li>
                  <li><strong>Tolerancia al frío:</strong> {{ planta.detallesPlanta.tolerancia_invierno ? 'Sí' : 'No' }}</li>
                </ul>
              </div>

              <p class="text-2xl font-bold text-green-600">{{ planta.precio }} €</p>

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
