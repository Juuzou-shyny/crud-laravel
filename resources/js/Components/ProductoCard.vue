<script setup>
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  producto: Object,
  isPlanta: Boolean
});

const contenido = ref('');
const loading = ref(false);

// Añadir al carrito
const addToCart = () => {
  router.post(route('carrito.agregar'), {
    producto_id: props.producto.id,
    cantidad: 1
  }, {
    preserveScroll: true,
    onSuccess: () => {
      router.visit(route('carrito.index'));
    }
  });
};

const agregarComentario = () => {
  if (!contenido.value.trim()) return;

  loading.value = true;

  router.post(route('comentarios.store'), {
    producto_id: props.producto.id,
    contenido: contenido.value
  }, {
    preserveScroll: true,
    onSuccess: () => {
      contenido.value = '';
      loading.value = false;
    },
    onError: () => {
      loading.value = false;
      alert('Hubo un problema al guardar tu comentario');
    }
  });
};
</script>

<template>
  <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-md transition">
    <!-- Imagen y enlace -->
    <Link :href="`/${props.isPlanta ? 'plantas' : 'productos'}/${props.producto.id}`">
      <img :src="props.producto.imagen_url" :alt="props.producto.nombre" class="w-full h-48 object-cover">
      <div class="p-4">
        <h3 class="font-bold text-lg">{{ props.producto.nombre }}</h3>
        <p class="text-[#3D9970] font-bold mt-2">{{ props.producto.precio }} €</p>
      </div>
    </Link>

    <!-- Botón de carrito -->
    <div class="p-4 border-t border-gray-200">
      <button @click="addToCart" type="button" class="mt-2 bg-green-600 hover:bg-green-700 text-white py-1 px-3 rounded text-sm w-full">
        Añadir al carrito
      </button>
    </div>

    <!-- Comentarios - Solo si está logueado -->
    <div v-if="$page.props.auth.user" class="p-4 border-t border-gray-200">
      <form @submit.prevent="agregarComentario" class="space-y-2">
        <textarea
          v-model="contenido"
          placeholder="Escribe un comentario..."
          class="w-full p-2 border border-gray-300 rounded"
          rows="2"
          required
        ></textarea>

        <button
          type="submit"
          :disabled="loading"
          class="w-full bg-[#3D9970] hover:bg-[#2d7a56] text-white py-1 px-3 rounded disabled:opacity-50"
        >
          {{ loading ? 'Enviando...' : 'Enviar comentario' }}
        </button>
      </form>

      <!-- Mostrar comentarios -->
      <div v-if="props.producto.comentarios && props.producto.comentarios.length > 0" class="mt-4 pt-4 border-t border-gray-200">
        <h4 class="font-semibold text-sm mb-2">Comentarios:</h4>
        <div v-for="comentario in props.producto.comentarios" :key="comentario.fecha + comentario.user_id" class="text-sm mb-3">
          <strong>{{ comentario.nombre_usuario }}</strong> dice:
          <p class="mt-1">{{ comentario.contenido }}</p>
          <small class="text-gray-500">{{ comentario.fecha }}</small>
        </div>
      </div>
    </div>

    <!-- Si no está logueado -->
    <div v-else class="p-4 border-t border-gray-200 text-center text-sm text-gray-500">
      Inicia sesión para dejar un comentario
    </div>
  </div>
</template>
