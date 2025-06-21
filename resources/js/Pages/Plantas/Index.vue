<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import ProductoCard from '@/Components/ProductoCard.vue'

defineProps({
  plantas: Array
})
</script>

<template>
  <AppLayout title="Todas las Plantas">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Todas nuestras plantas</h1>

        <!-- Mensaje si no hay plantas -->
        <p v-if="plantas.length === 0" class="text-center text-gray-500 mb-6">No hay plantas disponibles aún.</p>

        <!-- Listado de plantas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <ProductoCard
            v-for="planta in plantas"
            :key="planta.id"
            :producto="planta"
            :is-planta="true"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
