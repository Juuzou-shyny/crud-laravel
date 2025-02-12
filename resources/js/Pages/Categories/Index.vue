<template>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Categorías</h1>

        <!-- 📌 SECCIÓN DE CATEGORÍAS -->
        <div class="grid grid-cols-3 gap-4">
            <Link
                v-for="category in categories"
                :key="category.id"
                :href="route('categories.show', category.id)"
                class="block bg-white shadow rounded-lg overflow-hidden hover:opacity-80 transition"
            >
                <img :src="category.image" alt="Imagen de categoría" class="w-full h-40 object-cover">
                <div class="p-2 text-center font-semibold text-blue-600">{{ category.name }}</div>
            </Link>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { Link } from "@inertiajs/vue3";

const categories = ref([]);

onMounted(() => {
    axios.get("/api/categories").then((response) => {
        categories.value = response.data;
    });
});
</script>
