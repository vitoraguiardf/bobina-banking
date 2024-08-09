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
    <header class="snap-start">
        <div class="relative left-0 top-0 w-full">
            <nav v-if="canLogin" class="px-3 flex flex-1 justify-end">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] text-gray-500 hover:text-gray-300 dark:hover:text-white"
                >Dashboard</Link>
                <template v-else>
                    <Link :href="route('login')"
                        class="rounded-md px-3 py-2 ring-1 ring-transparent transition text-gray-500 hover:text-gray-300 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >Log in</Link>

                    <Link v-if="canRegister" :href="route('register')"
                        class="rounded-md px-3 py-2 ring-1 ring-transparent transition text-gray-500 hover:text-gray-300 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >Register</Link>
                </template>
            </nav>
            <section class="text-5xl h-screen content-center">
                <h1 class="font-medium text-center text-gray-200 py-5">Bobina Banking</h1>
                <h3 class="text-center text-2xl text-gray-400 py-5">Desbloqueando seu potencial de gerencimento</h3>
            </section>
        </div>
    </header>
</template>