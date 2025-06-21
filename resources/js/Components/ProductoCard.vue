<script setup>
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

defineProps({
  producto: Object,
  isPlanta: Boolean
});

const addToCart = (producto) => {
  router.post(route('carrito.agregar'), {
    producto_id: producto.id,
    cantidad: 1
  }, {
    preserveScroll: true,
    onSuccess: () => {
      router.visit(route('carrito.index')); // 👈 Fuerza recarga completa del carrito
    }
  });
};
</script>

<template>
  <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-md transition">
    <Link :href="`/${isPlanta ? 'plantas' : 'productos'}/${producto.id}`">
      <img :src="producto.imagen_url" :alt="producto.nombre" class="w-full h-48 object-cover">
      <div class="p-4">
        <h3 class="font-bold text-lg">{{ producto.nombre }}</h3>
        <p class="text-[#3D9970] font-bold mt-2">{{ producto.precio }} €</p>
      </div>
    </Link>

    <div class="p-4">
      <button @click="addToCart(producto)" type="button" class="mt-2 bg-green-600 hover:bg-green-700 text-white py-1 px-3 rounded text-sm w-full">
        Añadir al carrito
      </button>
    </div>
  </div>
</template>
