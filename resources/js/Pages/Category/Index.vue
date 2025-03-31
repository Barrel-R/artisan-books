<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Category } from '@/types';
import { route } from "ziggy-js"

defineProps<{
    categorias: Category[];
    status?: string;
}>();
</script>

<template>

    <Head title="Categories" />

    <AdminLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Categorias</h2>
                <Link :href="route('categorias.create')"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Adicionar nova categoria
                </Link>
            </div>
        </template>

        <div class="py-6">
            <div v-if="status" class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
                {{ status }}
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nome</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="category in categorias" :key="category.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ category.name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <Link :href="route('categorias.edit', category.id)"
                                            class="text-blue-600 hover:text-blue-900 mr-3">
                                        Editar
                                        </Link>
                                        <Link :href="route('categorias.destroy', category.id)" method="delete"
                                            as="button" class="text-red-600 hover:text-red-900" preserve-scroll>
                                        Deletar
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
