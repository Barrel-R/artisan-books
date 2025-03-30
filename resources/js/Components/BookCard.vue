<script setup lang="ts">
import { X } from 'lucide-vue-next';

defineProps<{
    book: {
        id: number;
        title: string;
        description: string;
        extendedDescription: string;
        coverImage: string;
        price: string;
        age: string;
        pages: number;
        backgroundColor: string;
        previewImages: string[];
        materials: string;
        dimensions: string;
        manufacturingTime: string;
    };
    isExpanded: boolean;
}>();

defineEmits(['toggle-expand']);
</script>

<template>
    <div class="overflow-hidden transition-all duration-300 shadow-md hover:shadow-xl rounded-lg h-full">
        <div v-if="isExpanded" class="bg-white p-6 h-full">
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-1/3">
                    <div :class="`relative pt-4 ${book.backgroundColor} rounded-lg`">
                        <div class="flex justify-center">
                            <img :src="book.coverImage" :alt="book.title"
                                class="relative z-10 rounded-lg shadow-md w-full max-w-[240px]" />
                        </div>
                    </div>
                </div>
                <div class="lg:w-2/3">
                    <div class="flex justify-between items-start">
                        <h3 class="text-2xl font-bold text-pink-500">{{ book.title }}</h3>
                        <button @click="$emit('toggle-expand')" class="text-blue-400 hover:text-blue-800">
                            <X class="h-6 w-6" />
                        </button>
                    </div>

                    <div class="flex items-center mt-2 mb-4">
                        <span class="text-xl font-bold text-blue-400 mr-4">{{ book.price }}</span>
                        <span class="px-2 py-1 text-xs bg-blue-100 rounded-full text-blue-400 mr-2">
                            {{ book.age }}
                        </span>
                        <span class="px-2 py-1 text-xs bg-pink-100 rounded-full text-pink-500">
                            {{ book.pages }} páginas
                        </span>
                    </div>

                    <div class="grid gap-6">
                        <div>
                            <h4 class="font-semibold text-blue-700 mb-2">Description</h4>
                            <p class="text-blue-400">{{ book.description }}</p>
                            <p class="text-blue-400 mt-2">{{ book.extendedDescription }}</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-blue-700 mb-2">Details</h4>
                            <ul class="list-disc list-inside text-blue-400 space-y-1">
                                <li>Número de páginas: {{ book.pages }}</li>
                                <li>Idade recomendada: {{ book.age }}</li>
                                <li>Materiais: {{ book.materials }}</li>
                                <li>Dimensões: {{ book.dimensions }}</li>
                                <li>Tempo de manufatura: {{ book.manufacturingTime }}</li>
                            </ul>
                        </div>

                        <div class="grid grid-cols-3 gap-2">
                            <img v-for="(img, index) in book.previewImages" :key="index" :src="img"
                                :alt="`${book.title} preview ${index + 1}`"
                                class="object-cover w-full h-auto rounded-md" />
                        </div>

                        <div class="flex gap-4 mt-2">
                            <button class="px-4 py-2 bg-pink-400 hover:bg-pink-500 text-white rounded-md">
                                Encomendar
                            </button>
                            <button class="px-4 py-2 border border-blue-300 text-blue-400 hover:bg-blue-50 rounded-md">
                                Pedir customização
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-else class="h-full">
            <div :class="`relative pt-4 ${book.backgroundColor}`">
                <div class="flex justify-center">
                    <img :src="book.coverImage" :alt="book.title"
                        class="relative z-10 rounded-t-lg shadow-md w-[240px] h-[300px] object-cover" />
                </div>
            </div>
            <div class="p-4 bg-white h-[calc(100%-300px-16px)] flex flex-col">
                <h3 class="text-lg font-bold text-pink-500">{{ book.title }}</h3>
                <p class="mt-2 text-sm text-blue-400 flex-grow">{{ book.description }}</p>
                <div class="flex flex-wrap gap-2 mt-3">
                    <span class="px-2 py-1 text-xs bg-blue-100 rounded-full text-blue-400">
                        {{ book.age }}
                    </span>
                    <span class="px-2 py-1 text-xs bg-pink-100 rounded-full text-pink-500">
                        {{ book.pages }} páginas
                    </span>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-lg font-bold text-blue-400">{{ book.price }}</span>
                    <button @click="$emit('toggle-expand')"
                        class="px-3 py-1 text-sm bg-pink-400 hover:bg-pink-500 text-white rounded-md">
                        Ver Detalhes
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
