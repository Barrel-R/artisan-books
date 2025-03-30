<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { LayoutDashboard, LucideIcon, NotebookPen, Tag } from 'lucide-vue-next';
import { route, RouteName } from 'ziggy-js/src/js';
import { ref, computed } from 'vue';

interface Props {
    title?: string;
}

defineProps<Props>();

const sidebarOpen = ref(false);
const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

// Navigation items with type safety
interface NavItem {
    name: string;
    href: RouteName | string;
    icon: LucideIcon;
    current: boolean;
}

const navigation = computed<NavItem[]>(() => [
    {
        name: 'Dashboard',
        href: "/dashboard",
        icon: LayoutDashboard,
        current: route().current('admin.dashboard')
    },
    {
        name: 'Books',
        href: "/livros",
        icon: NotebookPen,
        current: route().current('books.*')
    },
    {
        name: 'Categories',
        href: "/categorias",
        icon: Tag,
        current: route().current('categories.*')
    },
]);
</script>

<template>

    <Head :title="title ? `${title} | Admin` : 'Admin'" />

    <div class="min-h-screen bg-gray-100">
        <!-- Mobile sidebar -->
        <div class="lg:hidden">
            <div class="fixed inset-0 flex z-40">
                <Transition enter-active-class="transition-opacity ease-linear duration-300"
                    enter-from-class="opacity-0" enter-to-class="opacity-100"
                    leave-active-class="transition-opacity ease-linear duration-300" leave-from-class="opacity-100"
                    leave-to-class="opacity-0">
                    <div v-show="sidebarOpen" class="fixed inset-0" @click="toggleSidebar">
                        <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                    </div>
                </Transition>

                <Transition enter-active-class="transition ease-in-out duration-300 transform"
                    enter-from-class="-translate-x-full" enter-to-class="translate-x-0"
                    leave-active-class="transition ease-in-out duration-300 transform" leave-from-class="translate-x-0"
                    leave-to-class="-translate-x-full">
                    <div v-show="sidebarOpen" class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-800">
                        <div class="absolute top-0 right-0 -mr-14 p-1">
                            <button type="button"
                                class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600"
                                @click="toggleSidebar">
                                <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                            <div class="flex-shrink-0 flex items-center px-4">
                                <h1 class="text-white text-xl font-bold">Gatinha Arteira</h1>
                            </div>
                            <nav class="mt-5 px-2 space-y-1">
                                <Link v-for="item in navigation" :key="item.name" :href="item.href"
                                    :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']">
                                {{ item.icon }}
                                {{ item.name }}
                                </Link>
                            </nav>
                        </div>
                    </div>
                </Transition>
                <div class="flex-shrink-0 w-14"></div>
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:flex lg:w-64 lg:flex-col lg:fixed lg:inset-y-0">
            <div class="flex-1 flex flex-col min-h-0 bg-gray-800">
                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <h1 class="text-white text-xl font-bold">Gatinha Arteira</h1>
                    </div>
                    <nav class="mt-5 flex-1 px-2 space-y-1">
                        <Link v-for="item in navigation" :key="item.name" :href="item.href"
                            :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'group flex items-center px-2 py-2 text-sm font-medium rounded-md']">
                        <svg v-if="item.icon" class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-300"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="item.icon" />
                        </svg>
                        {{ item.name }}
                        </Link>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="lg:pl-64 flex flex-col">
            <!-- Mobile top navigation -->
            <div class="sticky top-0 z-10 lg:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 bg-gray-100">
                <button type="button"
                    class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    @click="toggleSidebar">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Header and content -->
            <main class="flex-1">
                <!-- Header slot -->
                <div class="bg-white shadow-sm">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </div>

                <!-- Main content slot -->
                <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<style scoped>
/* Smooth transitions for sidebar */
.slide-enter-active,
.slide-leave-active {
    transition: transform 0.3s ease;
}

.slide-enter-from,
.slide-leave-to {
    transform: translateX(-100%);
}
</style>
