<template>
    <header class="relative w-full py-8 overflow-hidden bg-blue-100">
        <div class="container relative z-10 px-4 mx-auto">
            <h1 class="text-4xl heading-600 text-center text-pink-400 md:text-5xl lg:text-6xl">
                Gatinha Arteira
            </h1>
            <p class="mt-4 heading-500 text-xl text-center text-blue-400">
                Livros artesanais feitos à mão para mentes curiosas.
            </p>
        </div>

        <!-- Decorative elements -->
        <Cloud class="absolute text-white opacity-70 top-6 left-10 w-14 h-14" />
        <Cloud class="absolute text-white opacity-70 top-12 right-16 w-10 h-10" />
        <Sun class="absolute text-yellow-400 top-8 right-32 w-12 h-12" />
        <Star class="absolute text-pink-300 bottom-4 left-32 w-8 h-8" />
        <Star class="absolute text-pink-300 top-16 left-1/2 w-6 h-6" />
    </header>
</template>

<script setup lang="ts">
import { Cloud, Star, Sun } from 'lucide-vue-next';
</script>
