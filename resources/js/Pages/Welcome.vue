<script setup>
import { Head } from '@inertiajs/vue3';
import SiteHeader from '@/Site/Header.vue';
import SiteContent from '@/Site/Content.vue';
import SiteCustomer from '@/Site/Customer.vue';
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
    <SiteHeader :canLogin="canLogin" :canRegister="canRegister"></SiteHeader>
    <SiteFooter :phpVersion="phpVersion" :laravelVersion="laravelVersion"></SiteFooter>
</template>