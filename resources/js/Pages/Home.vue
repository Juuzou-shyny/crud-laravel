<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'
import ProductoCard from '@/Components/ProductoCard.vue'

defineProps({
    featuredPlants: Array,
    featuredProducts: Array
})
</script>

<template>
    <AppLayout>
        <div class="py-12">

            <section class="bg-[#3D9970]/10 rounded-lg p-8 mb-12">
                <div class="max-w-3xl mx-auto text-center">
                    <h1 class="text-4xl md:text-5xl font-bold text-[#3D9970] mb-4">Bienvenido a GreenLife 🌱</h1>
                    <p class="text-lg text-[#585858] mb-6">Descubre nuestra colección de plantas y productos naturales
                        para un hogar más verde.</p>
                    <Link href="/plantas"
                        class="bg-[#3D9970] text-white px-6 py-3 rounded-lg hover:bg-[#2d7a56] transition inline-block">
                    Explorar Plantas
                    </Link>
                </div>
            </section>

            <!-- Plantas Destacadas -->
            <section class="mb-12">
                <h2 class="text-2xl font-bold text-[#3D9970] mb-6">Plantas Destacadas</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <ProductoCard v-for="plant in featuredPlants" :key="plant.id" :producto="plant" :is-planta="true" />
                </div>
            </section>

            <!-- Productos Destacados -->
            <section>
                <h2 class="text-2xl font-bold text-[#3D9970] mb-6">Productos Destacados</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <ProductoCard v-for="product in featuredProducts" :key="product.id" :producto="product"
                        :is-planta="false" />
                </div>
            </section>
        </div>
    </AppLayout>
</template>
