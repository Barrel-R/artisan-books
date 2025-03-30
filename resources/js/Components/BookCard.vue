<script setup lang="ts">
defineProps<{
    book: {
        id: number;
        title: string;
        description: string;
        coverImage: string;
        price: string;
        age: string;
        pages: number;
        backgroundColor: string;
    };
}>();

defineEmits(['view-details']);
</script>

<template>
    <div @click="$emit('view-details')"
        class="overflow-hidden transition-all duration-300 shadow-md hover:shadow-xl rounded-lg hover:-translate-y-1 hover:scale-105 cursor-pointer">
        <!-- Image Section -->
        <div :class="`relative ${book.backgroundColor}`">
            <div class="flex justify-center h-[250px] w-full overflow-hidden">
                <img :src="book.coverImage" :alt="book.title"
                    class="relative z-10 rounded-t-lg shadow-md w-full h-full object-cover bg-blue-100 flex items-center justify-center text-pink-400 text-center p-2.5" />
            </div>
        </div>

        <!-- Title and Description Section -->
        <div class="p-4 bg-white flex flex-col min-h-[200px]">
            <h3 class="text-lg font-bold text-pink-400 min-h-7 line-clamp-1">{{ book.title }}</h3>
            <p class="mt-2 text-sm text-blue-400 flex-grow max-h-[60px] line-clamp-3 overflow-hidden">{{
                book.description }}</p>
            <div class="flex flex-wrap gap-2 mt-3">
                <span class="px-2 py-1 text-xs bg-blue-100 rounded-full text-blue-400">
                    {{ book.age }}
                </span>
                <span class="px-2 py-1 text-xs bg-pink-100 rounded-full text-pink-400">
                    {{ book.pages }} páginas
                </span>
            </div>
            <div class="flex items-center justify-between mt-4">
                <span class="text-lg font-bold text-blue-400">{{ book.price }}</span>
            </div>
        </div>
    </div>
</template>
