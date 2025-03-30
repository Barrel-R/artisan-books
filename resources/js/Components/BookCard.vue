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
    <div
        class="overflow-hidden transition-all duration-300 shadow-md hover:shadow-xl rounded-lg h-full hover:-translate-y-1">
        <div class="h-full">
            <div :class="`relative pt-4 ${book.backgroundColor}`">
                <div class="flex justify-center">
                    <img :src="book.coverImage" :alt="book.title"
                        class="relative z-10 rounded-t-lg shadow-md w-[240px] h-[300px] object-cover transition-transform duration-300 hover:scale-105" />
                </div>
            </div>
            <div class="p-4 bg-white h-[calc(100%-300px-16px)] flex flex-col">
                <h3 class="text-lg font-bold text-pink-400">{{ book.title }}</h3>
                <p class="mt-2 text-sm text-blue-400 flex-grow">{{ book.description }}</p>
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
                    <button @click="$emit('view-details')"
                        class="px-3 py-1 text-sm bg-pink-400 hover:bg-pink-400 text-white rounded-md transition-colors duration-300">
                        Ver Detalhes
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
