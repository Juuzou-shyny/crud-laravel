<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  items: {
    type: Array,
    required: true,
    default: () => []
  },
  total: {
    type: Number,
    required: true,
    default: 0
  }
});

// Actualizar cantidad de un item
const updateQuantity = async (itemId, newQuantity) => {
  if (newQuantity < 1) return;

  await router.put(route('carrito.update', itemId), {
    cantidad: parseInt(newQuantity)
  }, {
    preserveScroll: true,
    onSuccess: () => router.reload({ only: ['items', 'total'] })
  });
};

// Eliminar item del carrito
const removeItem = async (itemId) => {
  if (!confirm('¿Estás seguro de eliminar este producto del carrito?')) return;

  await router.delete(route('carrito.destroy', itemId), {
    preserveScroll: true,
    onSuccess: () => router.reload({ only: ['items', 'total'] })
  });
};

// Calcular subtotal por producto
const itemSubtotal = (item) => {
  return (item.cantidad * item.producto.precio).toFixed(2);
};

// Formatear precio
const formatPrice = (price) => {
  return new Intl.NumberFormat('es-ES', {
    style: 'currency',
    currency: 'EUR'
  }).format(price);
};
</script>

<template>
  <AppLayout>
    <Head title="Mi Carrito de Compras" />

    <!-- Mensaje de éxito -->
    <div v-if="$page.props.flash?.message" class="bg-green-100 text-green-800 p-4 mb-6 rounded">
      {{ $page.props.flash.message }}
    </div>

    <!-- Mensaje de error -->
    <div v-if="$page.props.errors?.error" class="bg-red-100 text-red-800 p-4 mb-6 rounded">
      {{ $page.props.errors.error }}
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-8">Mi Carrito</h1>

      <!-- Carrito vacío -->
      <div v-if="items.length === 0" class="bg-white rounded-lg shadow p-6 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <h2 class="mt-4 text-lg font-medium text-gray-900">Tu carrito está vacío</h2>
        <p class="mt-1 text-gray-500">Comienza a añadir productos para continuar</p>
        <div class="mt-6">
          <Link href="/productos" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
            Ver productos
          </Link>
        </div>
      </div>

      <!-- Carrito con productos -->
      <div v-else class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="divide-y divide-gray-200">
          <!-- Listado de productos -->
          <div v-for="item in items" :key="item.id" class="p-6 flex flex-col sm:flex-row">
            <!-- Imagen del producto -->
            <div class="flex-shrink-0">
              <img :src="item.producto.imagen_url" :alt="item.producto.nombre" class="w-24 h-24 rounded-md object-cover">
            </div>

            <!-- Detalles del producto -->
            <div class="ml-4 flex-1 flex flex-col justify-between">
              <div>
                <h3 class="text-lg font-medium text-gray-900">
                  {{ item.producto.nombre }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                  {{ item.producto.categoria?.nombre }}
                </p>
              </div>

              <!-- Selector de cantidad -->
              <div class="mt-4 flex items-center">
                <label for="quantity" class="sr-only">Cantidad</label>
                <select
                  :value="item.cantidad"
                  @change="updateQuantity(item.id, $event.target.value)"
                  class="max-w-full rounded-md border border-gray-300 py-1.5 text-base leading-5 font-medium text-gray-700 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm"
                >
                  <option v-for="n in 10" :value="n">{{ n }}</option>
                </select>

                <!-- Precio y botón eliminar -->
                <div class="ml-auto flex items-center">
                  <p class="text-lg font-medium text-gray-900 mr-6">
                    {{ formatPrice(item.producto.precio * item.cantidad) }}
                  </p>
                  <button
                    @click="removeItem(item.id)"
                    type="button"
                    class="font-medium text-red-600 hover:text-red-500"
                  >
                    Eliminar
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Resumen del pedido -->
          <div class="p-6 bg-gray-50">
            <div class="flex justify-between text-base font-medium text-gray-900">
              <p>Subtotal</p>
              <p>{{ formatPrice(total) }}</p>
            </div>
            <p class="mt-0.5 text-sm text-gray-500">
              Los gastos de envío e impuestos se calculan al finalizar la compra.
            </p>
            <div class="mt-6">
              <Link
                :href="route('carrito.checkout')" method="post"
                class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700"
              >
                Finalizar compra
              </Link>
            </div>
            <div class="mt-4 flex justify-center text-sm text-center text-gray-500">
              <p>
                o <Link href="/productos" class="text-green-600 font-medium hover:text-green-500">Seguir comprando<span aria-hidden="true"> &rarr;</span></Link>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
/* Estilos personalizados si los necesitas */
</style>
