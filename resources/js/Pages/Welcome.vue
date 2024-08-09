<script setup>
import { Head } from '@inertiajs/vue3';
import SiteHeader from '@/Site/Header.vue';
import SiteContent from '@/Site/Content.vue';
import SiteFooter from '@/Site/Footer.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>
<template>
    <Head title="Welcome" />
    <div style="background-image: url('images/background.jpg');"
        class="w-full h-screen overflow-auto snap snap-y snap-mandatory">
        <SiteHeader :canLogin="canLogin" :canRegister="canRegister"></SiteHeader>
        <SiteContent></SiteContent>
        <SiteFooter :phpVersion="phpVersion" :laravelVersion="laravelVersion"></SiteFooter>
    </div>
</template>