<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import ProductoCard from '@/Components/ProductoCard.vue' // 👈 Importamos el componente

defineProps({
  productos: {
    type: Array,
    required: true
  }
})
</script>

<template>
  <AppLayout title="Todos los Productos">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Nuestros productos</h1>

        <!-- Mensaje si no hay productos -->
        <p v-if="productos.length === 0" class="text-center text-gray-500 mb-6">
          No hay productos disponibles aún.
        </p>

        <!-- Listado de productos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <ProductoCard
            v-for="producto in productos"
            :key="producto.id"
            :producto="producto"
            :is-planta="false"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
