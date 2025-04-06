<script setup>
import Checkbox from 'primevue/checkbox';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Log in" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <label for="email">Nome de usuário</label>

            <InputText id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                autocomplete="username" />
        </div>

        <div class="mt-4">
            <label for="senha">Senha</label>
            <InputText id="senha" type="password" class="mt-1 block w-full" v-model="form.password" required
                autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <Checkbox name="remember" v-model:checked="form.remember" />
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Lembrar de mim</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            <Button class="ml-4 px-5" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Logar
            </Button>
            <Link v-if="canResetPassword" :href="route('password.request')"
                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
            Esqueceu sua senha?
            </Link>
        </div>
    </form>
    <div class="align-middle mt-2">
        <span
            class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 reounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offser-gray-800">
            Não tem uma conta?
        </span>
        <br>
        <Link :href="route('register')" as="button">
        <Button class="ms-2 mt-1">
            Registrar
        </Button>
        </Link>
    </div>
</template>
