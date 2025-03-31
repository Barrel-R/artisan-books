<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Book, Category } from '@/types';

interface Props {
    categories: Category[];
    book: Book;
}

const props = defineProps<Props>();

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
    form.patch(`/livros/${props.book.id}`, {
        forceFormData: true,
    });
};

const handleFileChange = (event: Event, type: 'images' | 'videos') => {
    const input = event.target as HTMLInputElement;
    if (input.files) {
        form[type] = Array.from(input.files);
    }
};
</script>

<template>

    <Head title="Create Book" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Book</h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Basic Information -->
                                <div class="space-y-4">
                                    <div>
                                        <InputLabel for="title" value="Title" />
                                        <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full"
                                            required />
                                        <InputError class="mt-2" :message="form.errors.title" />
                                    </div>

                                    <div>
                                        <InputLabel for="description" value="Description" />
                                        <textarea id="description" v-model="form.description"
                                            class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="form.errors.description" />
                                    </div>

                                    <div>
                                        <InputLabel for="extended_description" value="Extended Description" />
                                        <textarea id="extended_description" v-model="form.extended_description"
                                            class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="form.errors.extended_description" />
                                    </div>

                                    <div>
                                        <InputLabel for="price" value="Price" />
                                        <TextInput id="price" v-model="form.price" type="number" step="0.01"
                                            class="mt-1 block w-full" required />
                                        <InputError class="mt-2" :message="form.errors.price" />
                                    </div>
                                </div>

                                <!-- Additional Information -->
                                <div class="space-y-4">
                                    <div>
                                        <InputLabel for="age_range" value="Age Range" />
                                        <TextInput id="age_range" v-model="form.age_range" type="text"
                                            class="mt-1 block w-full" required />
                                        <InputError class="mt-2" :message="form.errors.age_range" />
                                    </div>

                                    <div>
                                        <InputLabel for="page_count" value="Page Count" />
                                        <TextInput id="page_count" v-model="form.page_count" type="number"
                                            class="mt-1 block w-full" required />
                                        <InputError class="mt-2" :message="form.errors.page_count" />
                                    </div>

                                    <div>
                                        <InputLabel for="materials" value="Materials" />
                                        <TextInput id="materials" v-model="form.materials" type="text"
                                            class="mt-1 block w-full" required />
                                        <InputError class="mt-2" :message="form.errors.materials" />
                                    </div>

                                    <div>
                                        <InputLabel for="dimensions" value="Dimensions" />
                                        <TextInput id="dimensions" v-model="form.dimensions" type="text"
                                            class="mt-1 block w-full" required />
                                        <InputError class="mt-2" :message="form.errors.dimensions" />
                                    </div>

                                    <div>
                                        <InputLabel for="manufacturing_time" value="Manufacturing Time" />
                                        <TextInput id="manufacturing_time" v-model="form.manufacturing_time" type="text"
                                            class="mt-1 block w-full" required />
                                        <InputError class="mt-2" :message="form.errors.manufacturing_time" />
                                    </div>
                                </div>
                            </div>

                            <!-- Categories -->
                            <div class="mt-6">
                                <InputLabel value="Categories" />
                                <div class="mt-2 space-y-2">
                                    <div v-for="category in categories" :key="category.id" class="flex items-center">
                                        <input :id="`category-${category.id}`" v-model="form.categories" type="checkbox"
                                            :value="category.id"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                                        <label :for="`category-${category.id}`"
                                            class="ml-2 block text-sm text-gray-900">
                                            {{ category.name }}
                                        </label>
                                    </div>
                                </div>
                                <InputError class="mt-2" :message="form.errors.categories" />
                            </div>

                            <!-- Images -->
                            <div class="mt-6">
                                <InputLabel for="images" value="Images" />
                                <input id="images" type="file" multiple accept="image/*"
                                    @change="handleFileChange($event, 'images')" class="mt-1 block w-full" />
                                <InputError class="mt-2" :message="form.errors.images" />
                            </div>

                            <!-- Videos -->
                            <div class="mt-6">
                                <InputLabel for="videos" value="Videos" />
                                <input id="videos" type="file" multiple accept="video/*"
                                    @change="handleFileChange($event, 'videos')" class="mt-1 block w-full" />
                                <InputError class="mt-2" :message="form.errors.videos" />
                            </div>

                            <div class="flex items-center justify-end mt-6">
                                <Link :href="route('livros.index')" class="text-gray-600 hover:text-gray-900 mr-4">
                                Cancel
                                </Link>
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Save
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
