<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div v-if="$page.props.auth.user">
                        ¡Hola, {{ $page.props.auth.user.name }}!
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
