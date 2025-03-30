<script setup>
import { computed, onMounted, onUnmounted, watch } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    title: {
        type: String,
        default: "",
    },
});

const emit = defineEmits(['close']);

watch(
    () => props.show,
    (newVal) => {
        document.body.style.overflow = newVal ? 'hidden' : null;
    }
);

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    // document.body.style.overflow = null;
});

const maxWidthClass = computed(() => {
    return {
        sm: 'sm:max-w-sm',
        md: 'sm:max-w-md',
        lg: 'sm:max-w-lg',
        xl: 'sm:max-w-xl',
        '2xl': 'sm:max-w-2xl',
        '4xl': 'sm:max-w-4xl',
        '6xl': 'sm:max-w-6xl',
        'max': 'sm:w-full min-h-screen'
    }[props.maxWidth];
});
</script>

<template>
    <Teleport to="body">
        <!-- Outer wrapper -->
        <Transition enter-active-class="transition duration-300 ease-out" enter-from-class="opacity-0"
            enter-to-class="opacity-100" leave-active-class="transition duration-300 ease-in"
            leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-show="show" class="fixed inset-0 overflow-y-auto sm:px-0 z-50 flex items-center justify-center"
                :class="{ 'px-4 py-6': maxWidth !== 'max' }" scroll-region>
                <!-- Backdrop -->
                <Transition enter-active-class="transition duration-300 ease-out"
                    enter-from-class="opacity-0 backdrop-blur-none" enter-to-class="opacity-100 backdrop-blur-sm"
                    leave-active-class="transition duration-300 ease-in" leave-from-class="opacity-100 backdrop-blur-sm"
                    leave-to-class="opacity-0 backdrop-blur-none">
                    <div v-show="show" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm" @click="close" />
                </Transition>

                <!-- Modal content -->
                <Transition enter-active-class="transition duration-300 ease-out transform-gpu"
                    enter-from-class="opacity-0 scale-95 translate-y-4 sm:translate-y-0"
                    enter-to-class="opacity-100 scale-100 translate-y-0"
                    leave-active-class="transition duration-300 ease-in transform-gpu"
                    leave-from-class="opacity-100 scale-100 translate-y-0"
                    leave-to-class="opacity-0 scale-95 translate-y-4 sm:translate-y-0">
                    <div v-show="show" class="relative bg-white rounded-lg shadow-xl sm:w-full sm:mx-auto w-full"
                        :class="maxWidthClass">
                        <!-- Close button -->
                        <button @click="close"
                            class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 focus:outline-none transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <!-- Title -->
                        <h4 class="text-2xl font-bold text-center pt-3">{{ title }}</h4>
                        <!-- Content slot -->
                        <slot />
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>
