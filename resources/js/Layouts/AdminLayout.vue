<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';

// PrimeVue Components
import Drawer from 'primevue/sidebar';
import Menu from 'primevue/menu';
import Button from 'primevue/button';
import Avatar from 'primevue/avatar';
import Badge from 'primevue/badge';
import ConfirmDialog from 'primevue/confirmdialog';
import { Book, Home, Tag } from 'lucide-vue-next';

const userMenu = ref();
const sidebarVisible = ref(true);
const isAuthenticated = ref(false);

const menuItems = ref([
    {
        label: 'Dashboard',
        icon: "pi pi-home",
        href: '/painel'
    },
    {
        label: 'Books',
        icon: "pi pi-book",
        href: '/livros'
    },
    {
        label: 'Categorias',
        icon: "pi pi-tag",
        href: '/categorias'
    }
]);

const toggleSidebar = () => {
    sidebarVisible.value = !sidebarVisible.value;
};


onMounted(() => {
    // For demo purposes, auto-login after 1 second
    setTimeout(() => {
        isAuthenticated.value = true;
    }, 1000);
});
</script>
<template>
    <div class="min-h-screen bg-gray-100">
        <div class="flex h-screen overflow-hidden">
            <ConfirmDialog />

            <!-- Drawer -->
            <Drawer v-model:visible="sidebarVisible" :modal="false" :showCloseIcon="false" class="p-sidebar-sm">
                <div class="flex flex-col h-full">
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex items-center justify-center">
                            <!-- <img src="/placeholder.svg?height=40&width=40" alt="Logo" class="h-10 w-10" /> -->
                            <h1 class="ml-2 text-xl font-bold text-pink-500">Livros</h1>
                        </div>
                    </div>

                    <div class="flex-grow overflow-y-auto">
                        <Menu :model="menuItems" class="border-none w-full" />
                    </div>
                </div>
            </Drawer>

            <!-- Main Content -->
            <div class="flex flex-col flex-1 w-full overflow-hidden">
                <!-- Header -->
                <header class="bg-white shadow-sm">
                    <div class="flex items-center justify-between p-4">
                        <Button @click="toggleSidebar" icon="pi pi-bars" class="p-button-text p-button-rounded" />

                        <div class="flex items-center space-x-4">
                            <span class="relative">
                                <i class="pi pi-bell text-gray-600 text-xl cursor-pointer"></i>
                            </span>

                        </div>
                    </div>
                </header>

                <!-- Main Content Area -->
                <main class="flex-1 overflow-y-auto p-4">
                    <div class="max-w-7xl mx-auto">
                        <slot />
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
