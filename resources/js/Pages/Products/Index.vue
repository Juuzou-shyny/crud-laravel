<template>
    <app-layout title="Productos">
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Listado de Productos
        </h2>
      </template>

      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <!-- Mensaje si no hay productos -->
            <p v-if="products.length === 0" class="text-center text-gray-500">
              No hay productos disponibles.
            </p>

            <!-- Tabla de productos -->
            <table v-else class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nombre
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Descripción
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Precio
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Categoría
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Acciones
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="product in products" :key="product.id">
                  <td class="px-6 py-4 whitespace-nowrap">{{ product.name }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ product.description }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">${{ product.price }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    {{ product.category?.name || 'Sin categoría' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <!-- Enlace para ver detalles del producto -->
                    <inertia-link
                      :href="route('productos.show', product.id)"
                      class="text-indigo-600 hover:text-indigo-900"
                    >
                      Ver
                    </inertia-link>

                    <!-- Botón para editar el producto -->
                    <button
                      @click="editProduct(product.id)"
                      class="ml-2 bg-green-500 text-white px-2 py-1 rounded"
                    >
                      Editar
                    </button>

                    <!-- Botón para eliminar el producto -->
                    <button
                      @click="deleteProduct(product.id)"
                      class="ml-2 bg-red-500 text-white px-2 py-1 rounded"
                    >
                      Eliminar
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </app-layout>
  </template>

  <script>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import { Inertia } from '@inertiajs/inertia';

  export default {
    components: {
      AppLayout,
    },
    props: {
      products: Array, // Recibe los productos desde el backend
    },
    methods: {
      /**
       * Redirige al formulario de edición del producto.
       */
      editProduct(id) {
        this.$inertia.get(route('productos.edit', id));
      },

      /**
       * Elimina un producto enviando una solicitud DELETE.
       */
      deleteProduct(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
          this.$inertia.delete(route('productos.destroy', id));
        }
      },
    },
  };
  </script>
