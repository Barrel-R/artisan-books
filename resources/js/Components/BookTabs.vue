<script setup lang="ts">
defineProps<{
    tabs: Array<{ label: string; value: string }>;
    activeTab: string;
}>();

defineEmits(['update:activeTab']);
</script>

<template>
    <div class="flex flex-col items-center mb-8">
        <h2 class="mb-6 text-2xl cherry-swash text-center text-blue-400 md:text-3xl">
            Nossa coleção feita à mão
        </h2>
        <div class="inline-flex h-10 items-center justify-center rounded-md bg-blue-50 p-1 text-blue-400">
            <button v-for="tab in tabs" :key="tab.value" @click="$emit('update:activeTab', tab.value)" :class="[
                'inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50',
                activeTab === tab.value ? 'bg-white text-blue-400 shadow-sm' : 'text-blue-400 hover:bg-blue-100'
            ]">
                {{ tab.label }}
            </button>
        </div>
    </div>
</template>
