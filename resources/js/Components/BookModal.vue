<script setup lang="ts">
import Modal from "./BaseModal.vue";

defineProps({
    book: {
        type: Object,
        required: true,
        default: () => ({
            id: Number,
            title: String,
            description: String,
            extendedDescription: String,
            coverImage: String,
            price: String,
            age: String,
            pages: Number,
            backgroundColor: String,
            previewImages: Array,
            materials: String,
            dimensions: String,
            manufacturingTime: String
        })
    },
    show: {
        type: Boolean,
        default: false
    }
});

defineEmits(['close']);
</script>

<template>
    <Modal :show="show" maxWidth="6xl" @close="$emit('close')" :title="book.title">
        <div class="p-6 min-h-[600px]">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Book cover -->
                <div class="lg:w-1/3">
                    <div :class="`relative p-4 ${book.backgroundColor} rounded-lg transition-all duration-300`">
                        <div class="flex justify-center">
                            <img :src="book.coverImage" :alt="book.title"
                                class="relative z-10 rounded-lg shadow-md w-full max-w-[240px] transition-transform duration-300 hover:scale-105" />
                        </div>
                    </div>
                </div>

                <!-- Book details -->
                <div class="lg:w-2/3 space-y-6">
                    <div class="flex items-center">
                        <span class="text-xl font-bold text-blue-400 mr-4">{{ book.price }}</span>
                        <span class="px-2 py-1 text-xs bg-blue-100 rounded-full text-blue-400 mr-2">
                            {{ book.age }}
                        </span>
                        <span class="px-2 py-1 text-xs bg-pink-100 rounded-full text-pink-500">
                            {{ book.pages }} páginas
                        </span>
                    </div>

                    <div class="space-y-2">
                        <h4 class="font-semibold text-blue-700">Descrição</h4>
                        <p class="text-blue-400">{{ book.description }}</p>
                        <p class="text-blue-400">{{ book.extendedDescription }}</p>
                    </div>

                    <div class="space-y-2">
                        <h4 class="font-semibold text-blue-700">Detalhes</h4>
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
                            class="object-cover w-full h-32 rounded-md transition-transform duration-300 hover:scale-105 bg-gray-200" />
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button
                            class="px-4 py-2 bg-pink-400 hover:bg-pink-500 text-white rounded-md transition-colors duration-300 ease-in-out">
                            Encomendar
                        </button>
                        <button
                            class="px-4 py-2 border border-blue-300 text-blue-400 hover:bg-blue-50 rounded-md transition-colors duration-300 ease-in-out">
                            Pedir customização
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>
