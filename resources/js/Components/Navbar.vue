<template>
    <nav class="bg-white shadow border-b border-[#C9A66B]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo y enlaces principales -->
                <div class="flex items-center space-x-4">
                    <Link href="/" class="text-lg font-bold text-[#3D9970]">🌿 GreenLife</Link>
                    <Link href="/plantas" class="text-[#585858] hover:text-[#3D9970]">Plantas</Link>
                    <Link href="/productos" class="text-[#585858] hover:text-[#3D9970]">Productos</Link>
                    <Link href="/carrito" class="text-[#585858] hover:text-[#3D9970]">Carrito</Link>
                    <div v-if="$page.props.auth.user">
                        {{ $page.props.auth.user.name }} - Admin? {{ $page.props.auth.user.is_admin }}
                    </div>
                </div>

                <!-- Usuario logueado -->
                <div v-if="$page.props.auth.user" class="relative flex items-center">
                    <button @click="showMenu = !showMenu" class="flex items-center focus:outline-none">
                        <img :src="$page.props.auth.user.profile_photo_url" class="w-8 h-8 rounded-full mr-2">
                        <span class="text-[#585858]">{{ $page.props.auth.user.name }}</span>
                    </button>

                    <!-- Menú desplegable -->
                    <div v-show="showMenu" class="absolute right-0 mt-10 w-48 bg-white rounded-md shadow-lg py-2 z-10">
                        <Link href="/pedidos" class="block px-4 py-2 text-gray-800 hover:bg-green-50">
                        Mis pedidos
                        </Link>

                        <!-- Solo si es admin -->
                        <Link v-if="$page.props.auth.user.is_admin" :href="route('admin.pedidos.index')"
                            class="block px-4 py-2 text-gray-800 hover:bg-green-50">
                        Todos los pedidos (Admin)
                        </Link>


                        <Link href="/logout" method="post" as="button" type="button"
                            class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-green-50">
                        Cerrar sesión
                        </Link>
                    </div>
                </div>

                <!-- Botón de login/register -->
                <div v-else>
                    <Link href="/login" class="text-[#585858] hover:text-[#3D9970]">Iniciar sesión</Link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'

const showMenu = ref(false)
</script>
