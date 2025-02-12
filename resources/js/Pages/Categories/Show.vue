<template>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Productos en "{{ category?.name }}"</h1>
        <Link href="/categories" class="text-blue-500 hover:underline">← Volver a categorías</Link>

        <div v-if="products.length === 0" class="text-center text-gray-500">
            No hay productos en esta categoría.
        </div>

        <div class="grid grid-cols-3 gap-4 mt-4" v-else>
            <div v-for="product in products" :key="product.id" class="bg-white p-4 shadow rounded-lg">
                <img v-if="product.image" :src="product.image" alt="Imagen de producto" class="w-full h-40 object-cover rounded-lg mb-2" />
                <h2 class="font-semibold">{{ product.name }}</h2>
                <p class="text-gray-600">{{ product.description }}</p>

                <div v-if="product.caretip" class="mt-2 p-2 bg-green-100 rounded">
                    <h3 class="text-md font-bold">Cuidados:</h3>
                    <p><strong>Riego:</strong> {{ product.caretip.watering }}</p>
                    <p><strong>Luz:</strong> {{ product.caretip.sunlight }}</p>
                    <p><strong>Temperatura:</strong> {{ product.caretip.temperature }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

const page = usePage();
const category = ref(null);
const products = ref([]);

onMounted(() => {
    axios.get(`/api/categories/${page.props.id}`).then((response) => {
        category.value = response.data.category;
        products.value = response.data.products;
    });
});
</script>
