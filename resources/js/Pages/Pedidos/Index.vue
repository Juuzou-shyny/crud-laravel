<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  pedidos: Object // Laravel pasa datos paginados desde PedidoController@index
})
</script>

<template>
  <AppLayout title="Mis Pedidos">
    <!-- Mostrar mensaje si no hay pedidos -->
    <div v-if="!pedidos.data || pedidos.data.length === 0" class="bg-white shadow rounded-lg p-6 text-center">
      <p class="text-gray-500">No has realizado ningún pedido aún.</p>
    </div>

    <!-- Listado de pedidos -->
    <div v-for="pedido in pedidos.data" :key="pedido.id" class="bg-white shadow rounded-lg p-6 mb-4">
      <h2 class="text-xl font-semibold text-gray-800">Pedido #{{ pedido.id }}</h2>
      <p><strong>Fecha:</strong> {{ pedido.fecha_pedido }}</p>
      <p><strong>Estado:</strong> {{ pedido.estado }}</p>
      <p><strong>Total:</strong> {{ pedido.total }} €</p>

      <Link :href="route('pedidos.show', pedido.id)" class="text-green-600 underline mt-4 inline-block">
        Ver detalles
      </Link>
    </div>

    <!-- Paginación (opcional) -->
    <div v-if="pedidos.links" class="mt-6 flex justify-center space-x-1">
      <div v-for="link in pedidos.links" :key="link.label" v-html="link.label" />
    </div>
  </AppLayout>
</template>
