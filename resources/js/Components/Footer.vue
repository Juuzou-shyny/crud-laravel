<template>
  <footer class="bg-[#3D9970] text-white py-8">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
          <h3 class="text-xl font-bold mb-4">🌿 GreenLife</h3>
          <p class="text-sm">Tu tienda de plantas y productos naturales favorita.</p>
        </div>
        <div>
          <h4 class="font-bold mb-4">Enlaces rápidos</h4>
          <ul class="space-y-2">
            <li><Link href="/plantas" class="hover:underline">Plantas</Link></li>
            <li><Link href="/productos" class="hover:underline">Productos</Link></li>
            <li><Link href="/contacto" class="hover:underline">Contacto</Link></li>
          </ul>
        </div>
        <div>
          <h4 class="font-bold mb-4">Contacto</h4>
          <p class="text-sm">info@greenlife.com</p>
          <p class="text-sm">+34 123 456 789</p>
        </div>
      </div>
      <div class="border-t border-white/20 mt-8 pt-6 text-center text-sm">
        <p>&copy; {{ new Date().getFullYear() }} GreenLife. Todos los derechos reservados.</p>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>
