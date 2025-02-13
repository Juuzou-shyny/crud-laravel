<template>
    <app-layout title="Panel de Administración">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Panel de Administración
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-2xl font-semibold mb-4">Bienvenido, Administrador</h3>
                    <p class="text-gray-600">Aquí puedes gestionar la aplicación.</p>

                    <div class="mt-6 flex space-x-4">
                        <inertia-link :href="route('productos.index')" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                            Gestionar Productos
                        </inertia-link>
                        <inertia-link :href="route('categories.index')" class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-700">
                            Gestionar Categorías
                        </inertia-link>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout,
        Link
    }
};
</script>
