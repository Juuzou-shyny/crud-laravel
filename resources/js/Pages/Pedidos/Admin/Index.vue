<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
  pedidos: Object
});
</script>

<template>
  <AppLayout title="Panel de Administración - Pedidos">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Todos los Pedidos</h1>

        <!-- Mensaje si no hay pedidos -->
        <div v-if="pedidos.data.length === 0" class="bg-white shadow rounded-lg p-6 text-center">
          <p class="text-gray-500">No hay pedidos aún.</p>
        </div>

        <!-- Listado de pedidos -->
        <div v-for="pedido in pedidos.data" :key="pedido.id" class="bg-white shadow rounded-lg p-6 mb-4">
          <h2 class="text-xl font-semibold text-gray-800">Pedido #{{ pedido.id }}</h2>
          <p><strong>Usuario:</strong> {{ pedido.user.name }} ({{ pedido.user.email }})</p>
          <p><strong>Fecha:</strong> {{ pedido.fecha_pedido }}</p>
          <p><strong>Estado:</strong> {{ pedido.estado }}</p>
          <p><strong>Total:</strong> {{ pedido.total }} €</p>

          <Link :href="route('pedidos.show', pedido.id)" class="text-green-600 underline mt-4 inline-block">
            Ver detalles
          </Link>
        </div>

        <!-- Paginación -->
        <div class="mt-6">
          <Pagination :links="pedidos.links" />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
