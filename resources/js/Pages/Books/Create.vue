<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { FileUpload, InputText, Textarea, Checkbox, Button, FileUploadSelectEvent } from 'primevue';
import { Category } from '@/types';
import { route } from "ziggy-js";

interface Props {
    categories: Category[];
}

defineProps<Props>();

const form = useForm({
    title: '',
    description: '',
    extended_description: '',
    price: '',
    age_range: '',
    page_count: '',
    materials: '',
    dimensions: '',
    manufacturing_time: '',
    categories: [] as number[],
    images: [] as File[],
    videos: [] as File[],
});

const submit = () => {
    form.post(route('livros.store'), {
        forceFormData: true,
    });
};

const handleFileChange = (event: FileUploadSelectEvent, type: 'images' | 'videos') => {
    if (event.files) {
        form[type] = Array.isArray(event.files) ? event.files : [event.files];
    }
};
</script>

<template>

    <Head title="Criar Livro" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Criar Livro</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit" class="space-y-8">
                            <!-- Basic Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                                        <InputText v-model="form.title" placeholder="Título"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                                        <Textarea v-model="form.description" placeholder="Descrição" autoResize
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Descrição
                                            Extendida</label>
                                        <Textarea v-model="form.extended_description" placeholder="Descrição Extendida"
                                            autoResize
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Preço</label>
                                        <InputText v-model="form.price" placeholder="Preço"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                    </div>
                                </div>

                                <!-- Additional Information -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Faixa Etária</label>
                                        <InputText v-model="form.age_range" placeholder="Faixa Etária"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Número de
                                            Páginas</label>
                                        <InputText v-model="form.page_count" placeholder="Número de Páginas"
                                            type="number"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Materiais</label>
                                        <InputText v-model="form.materials" placeholder="Materiais"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Dimensões</label>
                                        <InputText v-model="form.dimensions" placeholder="Dimensões"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Tempo de
                                            Fabricação</label>
                                        <InputText v-model="form.manufacturing_time" placeholder="Tempo de Fabricação"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                    </div>
                                </div>
                            </div>

                            <!-- Categories -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Categorias</label>
                                <div class="flex flex-wrap gap-4">
                                    <div v-for="category in categories" :key="category.id"
                                        class="flex items-center gap-2">
                                        <Checkbox v-model="form.categories" :inputId="`category-${category.id}`"
                                            :value="category.id" class="focus:ring-blue-500" />
                                        <label :for="`category-${category.id}`" class="text-gray-700">{{ category.name
                                            }}</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Images -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Imagens</label>
                                <FileUpload mode="basic" name="images" accept="image/*" :multiple="true"
                                    @select="handleFileChange($event, 'images')" class="w-full" />
                            </div>

                            <!-- Videos -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Vídeos</label>
                                <FileUpload mode="basic" name="videos" accept="video/*" :multiple="true"
                                    @select="handleFileChange($event, 'videos')" class="w-full" />
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end gap-4 mt-6">
                                <Link :href="route('livros.index')"
                                    class="inline-flex items-center px-4 py-2 text-gray-700 rounded-md transition-colors duration-200">
                                Cancelar
                                </Link>
                                <Button type="submit" label="Salvar" :disabled="form.processing"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200 disabled:opacity-50" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
