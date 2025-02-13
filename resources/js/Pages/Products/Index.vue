<template>
    <app-layout title="Productos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Listado de Productos</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <!-- Mensaje de carga -->
                    <p v-if="loading" class="text-center text-gray-500">Cargando productos...</p>

                    <!-- Mensaje si no hay productos -->
                    <p v-else-if="!products || products.length === 0" class="text-center text-gray-500">
                        No hay productos disponibles.
                    </p>

                    <!-- Contenedor de productos en Grid -->
                    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div v-for="product in products" :key="product.id"
                            class="bg-white rounded-lg shadow-md p-4 flex flex-col justify-between">

                            <!-- Imagen del producto (placeholder si no tiene) -->
                            <img :src="product.image || defaultImage"
                                class="w-full h-40 object-cover rounded-md mb-4" alt="Imagen del producto">

                            <!-- Información del producto -->
                            <div class="flex flex-col flex-grow">
                                <h3 class="text-lg font-semibold">{{ product.name }}</h3>
                                <p class="text-gray-600 text-sm flex-grow">{{ product.description }}</p>
                                <p class="text-green-500 font-bold mt-2">${{ product.price }}</p>
                                <span class="text-xs text-gray-400">Categoría: {{ product.category?.name || 'Sin categoría' }}</span>
                            </div>

                            <!-- Acciones -->
                            <div class="mt-4 flex justify-between items-center">
                                <!-- Botón para ver detalles -->
                                <Link :href="route('productos.show', product.id)"
                                    class="text-indigo-600 hover:text-indigo-900 text-sm">Ver detalles</Link>

                                <!-- Botón de agregar al carrito -->
                                <button @click="addToCart(product.id)"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded flex items-center">
                                    <LucideShoppingCart class="w-5 h-5 mr-1" />
                                    Añadir
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import { LucideShoppingCart } from 'lucide-vue-next'; // 🔹 Ícono de carrito

export default {
    components: {
        AppLayout,
        Link,
        LucideShoppingCart, // 🔹 Importamos el ícono del carrito
    },
    props: {
        products: {
            type: Array,
            default: () => [],
        }
    },
    data() {
        return {
            loading: true,
            defaultImage: "https://via.placeholder.com/300x200?text=Producto", // Imagen por defecto si no tiene
        };
    },
    mounted() {
        console.log("Productos recibidos:", this.products);
        this.loading = false;
    },
    methods: {
        /**
         * Agrega un producto al carrito.
         */
        addToCart(id) {
            Inertia.post(route('cart.add'), { product_id: id }, {
                onSuccess: () => alert("Producto agregado al carrito 🛒"),
            });
        }
    },
};
</script>

