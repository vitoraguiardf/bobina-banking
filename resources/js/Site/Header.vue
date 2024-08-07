<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>
<template>
    <header>
        <nav v-if="canLogin" class="px-3 flex flex-1 justify-end">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] text-gray-200 dark:hover:text-white"
            >Dashboard</Link>
            <template v-else>
                <Link :href="route('login')"
                    class="rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-gray-500 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-gray-500 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >Register</Link>
            </template>
        </nav>
        <div class="text-5xl h-16 py-16">
            <h1 class="font-medium text-center text-gray-600">Bobina Banking</h1>
        </div>
    </header>
</template>