<template>
    <app-layout title="Inicio">
        <template #header>
            <h2 class="text-3xl font-bold text-gray-800">🌿 Bienvenido a la Tienda de Jardinería</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Tarjeta de Productos -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 flex flex-col items-center">
                        <img src="/images/productos.jpg" alt="Productos" class="w-full h-40 object-cover rounded-lg mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">Nuestros Productos</h3>
                        <p class="text-gray-600 text-center mb-4">Explora nuestra amplia variedad de productos para jardinería.</p>
                        <inertia-link
                            :href="route('productos.index')"
                            class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700"
                            @click.prevent="$inertia.visit(route('productos.index'))"
                        >
                            Ver Productos
                        </inertia-link>
                    </div>

                    <!-- Tarjeta de Categorías -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 flex flex-col items-center">
                        <img src="/images/categorias.jpg" alt="Categorías" class="w-full h-40 object-cover rounded-lg mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">Categorías</h3>
                        <p class="text-gray-600 text-center mb-4">Encuentra lo que necesitas explorando nuestras categorías.</p>
                        <inertia-link
                            :href="route('categories.index')"
                            class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-700"
                            @click.prevent="$inertia.visit(route('categories.index'))"
                        >
                            Ver Categorías
                        </inertia-link>
                    </div>

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout,
    },
    methods: {
        goToProducts() {
            Inertia.visit(route('productos.index'));
        },
        goToCategories() {
            Inertia.visit(route('categories.index'));
        }
    }
};
</script>

