<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
defineProps({
    home: {
        required: true,
    }
})
</script>
<template>
    <div class="shrink-0 flex items-center">
        <Link :href="home.route">
            <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" 
            :class="{'text-red-400 dark:text-red-600': home.active}" />
        </Link>
    </div>
</template>
